<?php
/**
 * Class MailqueueCommand
 * Console command to start sending emails waiting in a queue
 */
class MailqueueCommand extends CConsoleCommand
{
    public function actionSend($priority = '')
    {
        set_time_limit(0);

        // If queue is empty
        if (!$queueList = $this->_getMailQueue($priority)) {
//            Logging queue status
//            Utility::fileLogger('Mail queue is empty. No active emails.');
            return 0;
        }

        // Init mandrill component
        $mandrill = MandrillHelper::initComponent();
        // Mandrill error log
        $mandrillErrorLog = $this->_getMandrillErrorLogFile();
        // Errors while sending emails
        $hasErrors = false;
        /* @var $queueItem MailQueue */
        foreach ($queueList as $queueItem)
        {
            $message = $this->_compileEmailMessageObject($queueItem);
            $message = $this->_addEmailTags($message, $queueItem);

            // Send email with Mandrill. Check result.
            if ((!$result = $mandrill->messages->send($message)) || empty($result[0])) {
                Utility::fileLogger('Mandrill could not send email. Null was returned.', ['to_email' => $message['to'][0]['email']], false, $mandrillErrorLog);
                throw new CException('Mandrill service could not send email. Null was returned.');
            }

            $result = $result[0];
            if ($this->_saveResultParams($result, $queueItem) === false && $hasErrors === false) {
                $hasErrors = true;
            }
            // delay
            usleep(20000);
        }
        $this->_displayFinishMessage($hasErrors);
    }

    private function _getMandrillErrorLogFile()
    {
        return Utility::getConfig('mandrillLogFile');
    }

    private function _getMailQueue($priority)
    {
        $criteria = new CDbCriteria();
        // Get emails
        $criteria->condition = 'success=0';
        // Emails with top priority should be send first
        if ($priority === 'top') {
            $criteria->addCondition('priority=1');
            $criteria->order = 'ctime ASC';
        } else {
            $criteria->addCondition('priority>1');
            $criteria->order = 'priority ASC, ctime ASC';
        }

        return MailQueue::model()->findAll($criteria);
    }

    private function _compileEmailMessageObject($queueItem)
    {
        // Email message object
        $message = [
            'html'          => $queueItem->message_html,
            'text'          => $queueItem->message_plain,
            'subject'       => $queueItem->subject,
            'from_email'    => $queueItem->from_email,
            'from_name'     => $queueItem->from_name,
            'to' => [
                [
                    'email' => $queueItem->to_email,
                    'name'  => $queueItem->to_name,
                    'type'  => 'to'
                ]
            ],
        ];

        return $message;
    }

    private function _addEmailTags($message, $queueItem)
    {
        // Add tags to the email
        if ($queueItem['tags']) {
            // Several tags are divided by comma
            $tagsHasCommas = strpos($queueItem['tags'], ',') !== false;
            $message['tags'] = $tagsHasCommas ? explode(',', $queueItem['tags']) : [$queueItem['tags']];
        }

        return $message;
    }

    private function _saveResultParams($result, $queueItem)
    {
        $mandrillErrorLog = $this->_getMandrillErrorLogFile();
        // Mandrill response
        $queueItem->mandrill_status = $result['status'];
        // Reason if a mail was rejected
        $queueItem->mandrill_reject_reason = is_null($result['reject_reason']) ? '' : $result['reject_reason'];
        // message id
        $queueItem->mandrill_id = $result['_id'];
        // Attempt counter
        $queueItem->attempts += 1;
        // Attempt time
        $queueItem->atime = time();

        // If email has been sent
        if (!in_array($queueItem->mandrill_status, [MandrillHelper::$RECIPIENT_STATUS_REJECTED, MandrillHelper::$RECIPIENT_STATUS_INVALID])) {
            $queueItem->success = 1;
            // Send time
            $queueItem->stime = time();
        }

        if (!$queueItem->save()) {
            Utility::fileLogger('Could not update mail params', ['model' => $queueItem->attributes], false, $mandrillErrorLog);
            return false;
        }

        return true;
    }

    private function _displayFinishMessage($hasErrors)
    {
        $successMsg = "Emails have been sent\r\n";
        $errorMsg = "Errors while sending emails\r\n";
        echo $hasErrors ? $errorMsg : $successMsg;
    }
}
?>