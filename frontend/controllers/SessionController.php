<?php
namespace frontend\controllers;

use Yii;
use frontend\components\HelperUser;
use frontend\models\LoginForm;

/**
 * Session controller
 */
class SessionController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!HelperUser::isGuest()) {
            return $this->goHome();
        }
        $model = new LoginForm();
        $formData = Yii::$app->request->post();
        // Set default value
        if (!isset($formData['rememberMe'])) {
            $model->rememberMe = true;
        }
        if ($model->load($formData) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}
