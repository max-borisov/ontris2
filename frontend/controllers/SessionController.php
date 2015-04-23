<?php
namespace frontend\controllers;

use Yii;
use frontend\components\HelperUser;
use frontend\models\LogInForm;
use frontend\models\SignUpForm;
use frontend\models\UserAccountType;
use frontend\models\CountryList;

use frontend\components\Variable;

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
        /*if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }*/

        // Get the list of possible user types (e.g. customer, transporter)
        $accountList = (new UserAccountType)->getListBasedData();
        // List of options where from a user know about the site
//        $uFromList = UserComeFrom::model()->getListBasedData($this->appLanguage);
        $countryList = (new CountryList)->getListBasedData();
//        Variable::dump($countryList);

        return $this->render('signUp/view', [
            'model' => $model,
            'countryList' => $countryList,
            'accountList' => $accountList,
        ]);
    }
}
