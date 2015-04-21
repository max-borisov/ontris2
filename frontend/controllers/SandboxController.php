<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\components\Variable;

class SandboxController extends Controller
{
    public function actionIndex()
    {
        Variable::dump(Yii::$app->db);

        $rows = (new \yii\db\Query())
        ->select(['id'])
        ->from('user')
        ->limit(10)
        ->all();
        Variable::dump($rows);
    }
}
