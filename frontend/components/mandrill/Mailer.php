<?php
namespace frontend\components\mandrill;

use Yii;
use yii\mail\BaseMailer;
use frontend\components\HelperMandrill;
use frontend\components\Variable;

class Mailer extends BaseMailer
{
    public $messageClass = 'frontend\components\mandrill\Message';

    private $_mandrill = null;
    private $_response = null;

    public function setResponse($response)
    {
        $this->_response = $response;
    }

    protected function sendMessage($message)
    {
        echo 121245;
//        Variable::dump($message);
        $mandrillMessage = $this->_createMessageObject($message);
//        Variable::dump($mandrillMessage);
        $mandrill = $this->_getMandrill();
//        $response = $mandrill->messages->send($mandrillMessage);
//        Variable::dump($response);

        try {
            $response = $mandrill->messages->send($mandrillMessage);
            $this->setResponse($response);
//            $this->_saveResponse($response, $queueObject);
            usleep(20000);
        } catch(\Mandrill_Error $e) {
//            $hasErrors = true;
            Yii::error([
                'class' => get_class($e),
                'error' => $e->getMessage(),
                'to_email' => $message['to']['email'],
                'to_name' => $message['to']['name'],
            ], 'custom');
        }
    }

    public function getResponse()
    {
        return $this->_response;
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
        if (!empty($message->tags)) {
            $mandrillMessage['tags'] = explode(',', $message->getTags());
        }

        return $mandrillMessage;
    }
}