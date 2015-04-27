<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use frontend\components\Variable;
use frontend\models\MailQueue;
use frontend\components\HelperMandrill;
use frontend\components\mailer\MandrillMailer;

class SandboxController extends Controller
{
    public function actionIndex()
    {
//        Variable::dump(Yii::$app->homeUrl);
//        Yii::error(['a' => '1', 'b' => 2], 'custom');
    }

    public function actionQueue()
    {
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

    public function actionMailer()
    {
        $msg = Yii::$app->mailer->compose();
        $msg->setFrom('admin@ontris.com');
        $msg->setFromName('admin');
        $msg->setTo('max.borisov@yahoo.com');
        $msg->setToName('max borisov');
        $msg->setSubject('test subject 1234');
        $msg->setTextBody('hello');
        $msg->setHtmlBody('<h2>hello</h2>');
        $msg->setTags('');
        $msg->send();
        Variable::dump($msg);
        Variable::dump(Yii::$app->mailer->getResponse());
//        Variable::dump($msg->getResponse());
    }
}
