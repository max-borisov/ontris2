<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\components\Variable;

class SandboxController extends Controller
{
    public function actionIndex()
    {
        Variable::dump(Yii::$app->homeUrl);
    }
}
