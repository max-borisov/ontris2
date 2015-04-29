<?php
namespace frontend\models;

use Yii;
use common\models\User;
use yii\base\Model;

/**
 * SignUp form
 */
class SignUpForm extends Model
{
    public $country_id;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $type_id;
    public $ref_id;

    private $_tCategory = 'sign-up';

    // @todo Test DA language

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['country_id', 'required'],
            ['country_id', 'integer', 'integerOnly' => true],

            ['type_id', 'required'],
            ['type_id', 'integer', 'integerOnly' => true],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['ref_id', 'integer', 'integerOnly' => true],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->is_company_admin = 1;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateConfirmationToken();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => Yii::t($this->_tCategory, 'form.user.country'),
            'username' => Yii::t($this->_tCategory, 'form.user.name'),
            'email' => Yii::t($this->_tCategory, 'form.user.email'),
            'password' => Yii::t($this->_tCategory, 'form.user.password'),
            'password_repeat' => Yii::t($this->_tCategory, 'form.user.password.repeat'),
            'type_id' => Yii::t($this->_tCategory, 'form.user.account.type'),
            'ref_id' => Yii::t($this->_tCategory, 'form.user.referrer'),
        ];
    }
}
