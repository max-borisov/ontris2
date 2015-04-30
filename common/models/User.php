<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use frontend\models\ActiveRecord;
use yii\db\Query;

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
 * @property integer $confirmed_at
 * @property string $auth_key
 * @property string $confirmation_token
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
    const STATUS_NOT_CONFIRMED = 2;

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
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_NOT_CONFIRMED]],
            ['status', 'default', 'value' => self::STATUS_NOT_CONFIRMED],
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
     * @param $confirmation_token Token that was send to user in order to verify email address
     * @return null|static
     */
    public static function findByConfirmationToken($confirmation_token)
    {
        return static::findOne(['confirmation_token' => $confirmation_token, 'status' => self::STATUS_NOT_CONFIRMED]);
    }

    /**
     * Set email as confirmed
     *
     * @return bool
     */
    public function confirmEmail()
    {
        $this->status = static::STATUS_ACTIVE;
        $this->confirmation_token = '';
        $this->confirmed_at = time();

        return $this->save(false);
    }

    /**
     * Generates email confirmation token
     */
    public function generateConfirmationToken()
    {
        $this->confirmation_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeConfirmationToken()
    {
        $this->confirmation_token = null;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
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
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Check if a user has email confirmed
     *
     * @return bool
     */
    public function hasConfirmedEmail()
    {
        return $this->status == static::STATUS_ACTIVE ? true : false;
    }

    /**
     * Get list of admins. Site admin has access to admin panel.
     *
     * @return array
     */
    public static function getAdmins()
    {
        return (new Query())
            ->select('id, username, email')
            ->from(static::tableName())
            ->where('is_site_admin = 1 AND status = :status', [':status' => static::STATUS_ACTIVE])
            ->orderBy('id ASC')
            ->all();
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
            'confirmed_at' => 'Confirmed At',
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
