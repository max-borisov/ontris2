<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use frontend\models\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $username
 * @property integer $type_id
 * @property integer $bd_id
 * @property integer $inviter_id
 * @property string $phone
 * @property integer $is_company_admin
 * @property integer $is_site_admin
 * @property string $invite_msg
 * @property integer $login_at
 * @property integer $activated_at
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_NOT_ACTIVE]],

            /*[['country_id', 'username', 'type_id', 'bd_id', 'inviter_id', 'phone', 'is_company_admin', 'is_site_admin', 'invite_msg', 'login_at', 'activated_at', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['country_id', 'type_id', 'bd_id', 'inviter_id', 'is_company_admin', 'is_site_admin', 'login_at', 'activated_at', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'phone', 'invite_msg', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32]*/
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'username' => 'Username',
            'type_id' => 'Type ID',
            'bd_id' => 'Bd ID',
            'inviter_id' => 'Inviter ID',
            'phone' => 'Phone',
            'is_company_admin' => 'Is Company Admin',
            'is_site_admin' => 'Is Site Admin',
            'invite_msg' => 'Invite Msg',
            'login_at' => 'Login At',
            'activated_at' => 'Activated At',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
