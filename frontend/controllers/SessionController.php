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

use frontend\components\Variable;
use yii\helpers\VarDumper;

/**
 * Session controller
 */
class SessionController extends AppController
{
    // @todo Add action filter(login)
    // @todo Add Session prefix for models
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
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

    public function actionSignup()
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

                HelperNotification::sendConfirmationLink($user);

                exit();
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
}
