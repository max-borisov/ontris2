<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers;

class SigninController extends AppController
{
    /*public function filters()
    {
        return array(
            // If user is logged in, redirect one to front page
            array('application.filters.IsUserLoggedFilter'),
        );
    }*/

    // @todo Add REST support
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {

            $user = new User();
            $user->name = $model->name;
            $user->email = $model->email;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->confirmation_hash = HelperUser::getHash();





        return $this->render('view');
    }

    /*public function actionIndex()
	{
        $this->layout = 'loggedNo';

        // Set page SEO parameters
        if (!empty($SEOParams = Utility::getSEOParams('sign-in'))) {
            $this->seo = $SEOParams;
        }

        // Pass to javascript the app language
        Utility::registerScript(['_appLanguage', 'appLanguage', $this->appLanguage]);
        // 'Stay logged in' after sign in.
        $stayLoggedFlag = true;
        $model = new User('signIn');
        if (isset($_POST['send'])) {
            if (empty($_POST['stayLoggedFlag'])) {
                $stayLoggedFlag = false;
            }
            $model->setAttributes($_POST['User']);
            if ($model->validate()) {
                $duration = $stayLoggedFlag ? Utility::getConfig('autoLoginExpires') : 0;
                if (Yii::app()->user->login($model->getUserIdentity(), $duration)) {
					$model->updateLoginTime($model->getUserIdentity()->id);
                    // Get user id
                    if (empty($uid = $model->getUserIdentity()->id)) throw new CException('Could not get user id from userIdentity');
                    // Fetch user model
                    if (!$user = User::model()->loadModel($uid)) throw new CException('Could not get user with id ' . $uid);
                    // Update user state
                    Utility::getWebUser()->updateUserState($user);
				}
				// returnUrl doesn't fit. If use came from 'Recovery password' page, he will be redirected there...
                // specify app language
                $this->redirect(Utility::setDomainLang(Utility::getHomeUrl(), Utility::getAppLang()));
            }
        }
        Yii::app()->clientScript->registerPackage('signInPage');
        $this->render('view', ['model' => $model, 'stayLoggedFlag'=>$stayLoggedFlag]);
	}*/
}