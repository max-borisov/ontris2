<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use frontend\components\HelperBase;

/**
 * LogIn form
 */
class LogInForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;
    private $_tCategory = 'sign-in';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['email', 'checkEmailConfirmation'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * User must confirm email address before login
     *
     * @param $attribute
     * @param $params
     */
    public function checkEmailConfirmation($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user && !$user->hasConfirmedEmail()) {
                $this->addError($attribute, Yii::t('sign-in', 'msg.activation.needed'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? HelperBase::getParam('rememberMeDuration') : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t($this->_tCategory, 'form.user.email'),
            'password' => Yii::t($this->_tCategory, 'form.user.password'),
            'rememberMe' => Yii::t($this->_tCategory, 'msg.remember.me'),
        ];
    }
}
