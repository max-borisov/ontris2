<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
    public $layout = 'login-no';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function goSignIn()
    {
        return Yii::$app->getResponse()->redirect('/sign-in');
    }
}