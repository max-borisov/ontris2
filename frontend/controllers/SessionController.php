<?php
namespace frontend\controllers;

use Yii;
use frontend\components\HelperUser;
use frontend\models\LogInForm;
use frontend\models\SignUpForm;
use frontend\models\UserAccountType;
use frontend\models\CountryList;
use frontend\models\UserReferrer;
use common\components\HelperNotification;
use yii\helpers\Url;
use yii\filters\AccessControl;
use common\models\User;

use frontend\components\Variable;

/**
 * Session controller
 */
class SessionController extends AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['log-in', 'sign-up', 'email-confirmation'],
                        'roles' => ['?']
                    ],
                ],
            ]
        ];
    }

    // @todo Add action filter(login)
    // @todo Add Session prefix for models
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogIn()
    {
        if (!HelperUser::isGuest()) {
            return $this->goHome();
        }
        $model = new LogInForm();
        $formData = Yii::$app->request->post();
        // Set default value
        if (!isset($formData['rememberMe'])) {
            $model->rememberMe = true;
        }
        if ($model->load($formData) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('logIn', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignUp()
    {
        $model = new SignUpForm();
        // Default country
        $model->country_id = CountryList::DENMARK;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
//                Variable::dump($user);
                /*if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }*/

                Yii::$app->session->setFlash('signup_success', Yii::t('sign-up', 'message_success'), false);
                HelperNotification::sendConfirmationLink($user);
                HelperNotification::notifyAdminAboutNewUser($user);
            }
        }
        $accountList = (new UserAccountType)->getListBasedData();
        $referrerList = (new UserReferrer)->getListBasedData();
        $countryList = (new CountryList)->getListBasedData();

        return $this->render('signUp/view', [
            'model' => $model,
            'countryList' => $countryList,
            'accountList' => $accountList,
            'referrerList' => $referrerList,
        ]);
    }

    // @todo Restrict to guests only
    public function actionEmailConfirmation($token)
    {
        if (!$token) $this->goHome();
        $user = User::findByConfirmationToken($token);
        if (!$user || !$user->confirmEmail()) {
            Yii::$app->session->setFlash('email_confirmation_error', Yii::t('user', 'email.confirmation.error'));
        } else {
            Yii::$app->session->setFlash('email_confirmation_success', Yii::t('user', 'email.confirmation.success'));
        }

        return $this->goSignIn();
    }
}
