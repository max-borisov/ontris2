<?php

namespace frontend\models;

use Yii;
use yii\base\Exception;
use frontend\components\HelperBase;

/**
 * This is the model class for table "mail_queue".
 *
 * @property integer $id
 * @property string $from_name
 * @property string $from_email
 * @property string $to_name
 * @property string $to_email
 * @property string $subject
 * @property string $message_html
 * @property string $message_plain
 * @property string $tags
 * @property integer $max_attempts
 * @property integer $attempts
 * @property integer $status
 * @property integer $priority
 * @property string $mandrill_status
 * @property string $mandrill_reject_reason
 * @property string $mandrill_id
 * @property integer $ctime
 * @property integer $mtime
 * @property integer $atime
 * @property integer $stime
 */
class MailQueue extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_SUCCESS = 1;
    const PRIORITY_HIGH = 1;
    const PRIORITY_LOW = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * Add email to queue
     *
     * @param $to_email
     * @param $to_name
     * @param $subj
     * @param $msg_plain
     * @param $msg_html
     * @param array $tags
     * @param int $priority
     * @param string $from_name
     * @param string $from_email
     * @return bool
     * @throws Exception
     */
    public static function add($to_email, $to_name, $subj, $msg_plain, $msg_html, $tags = [], $priority = 0, $from_name = '', $from_email = '')
    {
        $queue = new self;
        if ($from_name && $from_email) {
            $queue->from_name = $from_name;
            $queue->from_email = $from_email;
        } else {
            // Default params
            $queue->from_email = HelperBase::getParam('fromEmail');
            $queue->from_name = HelperBase::getParam('fromName');
        }
        $queue->to_email = $to_email;
        $queue->to_name = $to_name;
        $queue->subject = $subj;
        $queue->message_plain = $msg_plain;
        $queue->message_html = $msg_html;
        if ($tags) {
            // Tags should be an array
            if (!is_array($tags)) {
                throw new Exception('Failed to add new mail to queue. Tags must be an array.');
            }
            // Convert tags array into string
            $queue->tags = implode(',', $tags);
        }
        $queue->status = static::STATUS_PENDING;
        $queue->priority = $priority || self::PRIORITY_LOW;
        if (!$queue->save(false)) {
            Yii::error("Failed to add new message to queue. Email: $to_email, name: $to_name", 'custom');
            throw new Exception('Could not add new email to queue. Email ' . $to_email);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'to_name' => 'To Name',
            'to_email' => 'To Email',
            'subject' => 'Subject',
            'message_html' => 'Message Html',
            'message_plain' => 'Message Plain',
            'tags' => 'Tags',
            'max_attempts' => 'Max Attempts',
            'attempts' => 'Attempts',
            'success' => 'Success',
            'priority' => 'Priority',
            'mandrill_status' => 'Mandrill Status',
            'mandrill_reject_reason' => 'Mandrill Reject Reason',
            'mandrill_id' => 'Mandrill ID',
            'ctime' => 'Ctime',
            'mtime' => 'Mtime',
            'atime' => 'Atime',
            'stime' => 'Stime',
        ];
    }
}
