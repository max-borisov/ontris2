<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\components\Variable;
use frontend\models\MailQueue;

class SandboxController extends Controller
{
    public function actionIndex()
    {
//        Variable::dump(Yii::$app->homeUrl);
//        Yii::error(['a' => '1', 'b' => 2], 'custom');
    }

    public function actionQueue()
    {
        $res = MailQueue::add(
            'matt.borisov@gmail.com',
            'Matt Borisov',
            'Test subj',
            'Hello boy', '<strong>Hello boy</strong>'
        );
    }
}
