<?php

namespace console\controllers;

use Yii;
use yii\base\Exception;
use yii\console\Controller;
use frontend\models\MailQueue;
use frontend\components\HelperMandrill;

use frontend\components\Variable;

class MailqueueController extends Controller
{
    public function actionSend($priority = 'HIGH_PRIORITY')
    {
        set_time_limit(0);
        $priority = $this->_priorityToNumber($priority);
        // If queue is empty
        if (!$queue = $this->_getQueueObjects($priority)) {
            return Controller::EXIT_CODE_NORMAL;
        }

        $hasErrors = false;
        $mandrillMailer = Yii::$app->mailer;
        /* @var $queueObject \frontend\models\MailQueue */
        foreach($queue as $queueObject) {
            try {
                $message = $mandrillMailer->compose();
                $message->setFrom($queueObject->from_email);
                $message->setFromName($queueObject->from_name);
                $message->setTo($queueObject->to_email);
                $message->setToName($queueObject->to_name);
                $message->setSubject($queueObject->subject);
                $message->setHtmlBody($queueObject->message_html);
                if (!empty($queueObject->tags)) {
                    $message->setTags(explode(',', $queueObject->tags));
                }
                $message->send();
                $this->_saveResponse($mandrillMailer->getResponse(), $queueObject);
                $mandrillMailer->setResponse(null);
                usleep(20000);
            } catch(\Mandrill_Error $e) {
                $hasErrors = true;
                Yii::error([
                    'class' => get_class($e),
                    'error' => $e->getMessage(),
                    'to_email' => $message['to']['email'],
                    'to_name' => $message['to']['name'],
                ], 'custom');
            }
        }
        $this->_displayFinishMessage($hasErrors);
    }

    private function _priorityToNumber($priority)
    {
        $list = [
            'HIGH_PRIORITY' => MailQueue::PRIORITY_HIGH,
            'LOW_PRIORITY' => MailQueue::PRIORITY_LOW,
        ];
        if (!array_key_exists($priority, $list)) {
            throw new Exception('Incorrect mail priority param.');
        }

        return $list[$priority];
    }

    /**
     * Get objects from queue
     *
     * @param $priority Email priority
     * @return array|\yii\db\ActiveRecord[]
     */
    private function _getQueueObjects($priority)
    {
        return MailQueue::find()
            ->where([
                'status' => MailQueue::STATUS_PENDING,
                'priority' => $priority
            ])
            ->orderBy('created_at ASC')
            ->limit(1)
//            ->limit()
            ->all();
    }

    /**
     * Save response from mandrill
     *
     * @var $queueObject \frontend\models\MailQueue
     * @param $response Response object
     * @param $queueObject Email queue object to be send
     * @return bool
     */
    private function _saveResponse($response, &$queueObject)
    {
        $response = $response[0];
        $queueObject->mandrill_status = $response['status'];
        $queueObject->mandrill_reject_reason = $response['reject_reason'];
        $queueObject->mandrill_id = $response['_id'];
        $queueObject->attempts += 1;
        $queueObject->sent_at = time();
        if (!in_array($queueObject->mandrill_status, [HelperMandrill::$RECIPIENT_STATUS_REJECTED, HelperMandrill::$RECIPIENT_STATUS_INVALID])) {
            $queueObject->status = MailQueue::STATUS_SENT;
        }
        if (!$queueObject->save(false)) {
            Yii::t($queueObject->attributes, 'custom');
            return false;
        }

        return true;
    }

    private function _displayFinishMessage($hasErrors)
    {
        $successMsg = "Operation OK\t\r\n";
        $errorMsg = "Operation ERROR\r\n";
        echo $hasErrors ? $errorMsg : $successMsg;
    }
}
?>