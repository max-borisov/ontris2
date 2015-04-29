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
 * @property string $tags
 * @property integer $max_attempts
 * @property integer $attempts
 * @property integer $status
 * @property integer $priority
 * @property string $mandrill_status
 * @property string $mandrill_reject_reason
 * @property string $mandrill_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sent_at
 */
class MailQueue extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_SENT = 1;
    const PRIORITY_HIGH = 1;
    const PRIORITY_LOW = 10;
    const MAX_ATTEMPTS = 3;

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
//    public static function add($to_email, $to_name, $subj, $msg_plain, $msg_html, $tags = [], $priority = 0, $from_name = '', $from_email = '')

    /**
     * Add email to queue
     *
     * @param array $params Email params
     * @return bool
     * @throws Exception
     */
    public static function add($params = [])
    {
        static::_validateParams($params);
        $queue = new self;
        $queue->max_attempts = static::MAX_ATTEMPTS;
        $queue->from_name = !empty($params['from_name']) ? $params['from_name'] : HelperBase::getParam('fromName');
        $queue->from_email = !empty($params['from_email']) ? $params['from_email'] : HelperBase::getParam('fromEmail');
        $queue->to_email = $params['to_email'];
        $queue->to_name = $params['to_name'];
        $queue->subject = $params['subject'];
        $queue->message_html = $params['message_html'];
        if (!empty($params['tags'])) {
            // Tags should be an array
            if (!is_array($params['tags'])) {
                throw new Exception('Failed to add new mail to queue. Tags must be an array.');
            }
            // Convert tags array into string
            $queue->tags = implode(',', $params['tags']);
        }
        $queue->status = static::STATUS_PENDING;
        $queue->priority = !empty($params['priority']) ? $params['priority'] : self::PRIORITY_LOW;
        if (!$queue->save(false)) {
            Yii::error("Failed to add new message to queue. Email: {$params['to_email']}, name: {$params['to_name']}", 'custom');
            throw new Exception('Could not add new email to queue. Email ' . $params['to_email']);
        }

        return true;
    }

    private static function _validateParams($params = [])
    {
        if (empty($params)) {
            throw new Exception('Mailing params must be set.');
        }
        if (empty($params['to_email'])
            || empty($params['to_name'])
            || empty($params['subject'])
            || empty($params['message_html'])
        ) {
            throw new Exception('Some required fields are missed.');
        }
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
