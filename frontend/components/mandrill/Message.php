<?php
namespace frontend\components\mandrill;

use Yii;
use yii\mail\BaseMessage;
use yii\base\Exception;

class Message extends BaseMessage
{
    private $_htmlBody;
    private $_textBody;
    private $_cc;
    private $_bcc;
    private $_subject;
    private $_charset;
    private $_from;
    private $_fromName;
    private $_to;
    private $_toName;
    private $_replyTo;
    private $_tags;

    public function setFrom($from = '')
    {
        $this->_from = $from;
    }

    public function getFrom()
    {
        return $this->_from;
    }

    public function setFromName($fromName = '')
    {
        $this->_fromName = $fromName;
    }

    public function getFromName()
    {
        return $this->_fromName;
    }

    public function setTo($to = '')
    {
        $this->_to = $to;
    }

    public function getTo()
    {
        return $this->_to;
    }

    public function setToName($toName = '')
    {
        $this->_toName = $toName;
    }

    public function getToName()
    {
        return $this->_toName;
    }

    public function setReplyTo($replyTo = '')
    {
        $this->_replyTo = $replyTo;
    }

    public function getReplyTo()
    {
        return $this->_replyTo;
    }

    public function setHtmlBody($html = '')
    {
        $this->_htmlBody = $html;
    }

    public function getHtmlBody()
    {
        return $this->_htmlBody;
    }

    public function setTextBody($text = '')
    {
        $this->_textBody = $text;
    }

    public function getTextBody()
    {
        return $this->_textBody;
    }

    public function setCc($cc)
    {
        $this->_cc = $cc;
    }

    public function getCc()
    {
        return $this->_cc;
    }

    public function setBcc($bcc)
    {
        $this->_bcc = $bcc;
    }

    public function getBcc()
    {
        return $this->_bcc;
    }

    public function setSubject($subject = '')
    {
        $this->_subject = $subject;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function setCharset($charset = '')
    {
        $this->_charset = $charset;
    }

    public function getCharset()
    {
        return $this->_charset;
    }

    public function setTags($tags = '')
    {
        $this->_tags = $tags;
    }

    public function getTags()
    {
        return $this->_tags;
    }

    public function attachContent($content = '', array $options = [])
    {
        throw new Exception('Method is not implemented yet');
    }

    public function toString()
    {
//        return $this->_htmlBody;
//        exit();

//        return $code = '<html><head></head><body><h2>OK OK</h2></body></html>';
        return '<h3>toString() method. Must be implemented.</h3>';
//        throw new Exception('Method is not implemented yet');
    }

    public function attach($fileName = '', array $options = [])
    {
        throw new Exception('Method is not implemented yet');
    }

    public function embed($fileName = '', array $options = [])
    {
        throw new Exception('Method is not implemented yet');
    }

    public function embedContent($content = '', array $options = [])
    {
        throw new Exception('Method is not implemented yet');
    }
}