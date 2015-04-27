<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use frontend\components\Variable;
use frontend\models\MailQueue;
use frontend\components\HelperMandrill;

class SandboxController extends Controller
{
    public function actionIndex()
    {
//        Variable::dump(Yii::$app->homeUrl);
//        Yii::error(['a' => '1', 'b' => 2], 'custom');
    }

    public function actionQueue()
    {
//        $str = 'test';
//        Variable::dump(explode(',', $str));
//        $mandrill = HelperMandrill::init();
//        Variable::dump($mandrill);

//        return false;
        $res = MailQueue::add([
            'to_email'  => 'matt.borisov@gmail.com',
            'to_name'   => 'Matt Borisov',
            'from_email'  => 'max.test@gmail.com',
            'from_name'   => 'Max Test',
            'subject'   => 'Test subj',
            'message_plain' => 'Hello boy',
            'message_html'  => '<strong>Hello boy</strong>',
        ]);
    }
}
