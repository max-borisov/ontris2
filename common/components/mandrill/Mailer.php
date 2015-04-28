<?php
namespace common\components\mandrill;

use Yii;
use yii\mail\BaseMailer;
use frontend\components\HelperMandrill;

class Mailer extends BaseMailer
{
    public $messageClass = 'common\components\mandrill\Message';

    private $_mandrill = null;
    private $_response = null;

    public function setResponse($response)
    {
        $this->_response = $response;
    }

    public function getResponse()
    {
        return $this->_response;
    }

    protected function sendMessage($message)
    {
        $mandrillMessage = $this->_createMessageObject($message);
        $mandrill = $this->_getMandrill();
        try {
            $response = $mandrill->messages->send($mandrillMessage);
            $this->setResponse($response);
            usleep(2000);
        } catch(\Mandrill_Error $e) {
            Yii::error([
                'class' => get_class($e),
                'error' => $e->getMessage(),
                'to_email' => $message['to']['email'],
                'to_name' => $message['to']['name'],
            ], 'custom');
        }
    }

    private function _getMandrill()
    {
        if (is_null($this->_mandrill)) {
            $this->_mandrill = HelperMandrill::init();
        }

        return $this->_mandrill;
    }

    /**
     * Compile mandrill message object
     *
     * @return array
     */
    private function _createMessageObject($message)
    {
        // Email message object
        $mandrillMessage = [
            'html'          => $message->getHtmlBody(),
            'text'          => $message->getTextBody(),
            'subject'       => $message->getSubject(),
            'from_email'    => $message->getFrom(),
            'from_name'     => $message->getFromName(),
            'to' => [
                [
                    'email' => $message->getTo(),
                    'name'  => $message->getToName(),
                    'type'  => 'to'
                ]
            ],
        ];
        if (!empty($message->tags) && is_array($message->tags)) {
            $mandrillMessage['tags'] = $message->getTags();
        }

        return $mandrillMessage;
    }
}