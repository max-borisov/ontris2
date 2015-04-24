<?php

namespace console\controllers;

use Yii;
use yii\base\Exception;
use yii\console\Controller;
use frontend\models\MailQueue;
use frontend\components\HelperMandrill;

use frontend\components\Variable;

// @todo Add comments
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
        $mandrill = HelperMandrill::init();
        foreach($queue as $queueObject) {
            $message = $this->_createMessageObject($queueObject);
            try {
                $response = $mandrill->messages->send($message);
                $this->_saveResponse($response, $queueObject);
                usleep(20000);
            } catch(\Mandrill_Error $e) {
                Yii::error([
                    'class' => get_class($e),
                    'error' => $e->getMessage(),
                    'to_email' => $message['to']['email'],
                    'to_name' => $message['to']['name'],
                ], 'custom');
            }
        }
        // @todo Show result messages
        //
//        $this->_displayFinishMessage($hasErrors);
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

    private function _getQueueObjects($priority)
    {
        return MailQueue::find()
            ->where([
                'status' => MailQueue::STATUS_PENDING,
                'priority' => $priority
            ])
            ->orderBy('created_at ASC')
            ->limit(1)
            ->all();
    }

    /**
     * @var $queueObject \frontend\models\MailQueue
     * @param $queueObject
     * @return array
     */
    private function _createMessageObject($queueObject)
    {
        // Email message object
        $message = [
            'html'          => $queueObject->message_html,
            'text'          => $queueObject->message_plain,
            'subject'       => $queueObject->subject,
            'from_email'    => $queueObject->from_email,
            'from_name'     => $queueObject->from_name,
            'to' => [
                [
                    'email' => $queueObject->to_email,
                    'name'  => $queueObject->to_name,
                    'type'  => 'to'
                ]
            ],
        ];
        if (!empty($queueObject->tags)) {
            $message['tags'] = explode(',', $queueObject->tags);
        }

        return $message;
    }

    /**
     *
     * @var $queueObject \frontend\models\MailQueue
     * @param $response
     * @param $queueObject
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
}
?>