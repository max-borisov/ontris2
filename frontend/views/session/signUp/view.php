<?php
//use Yii;
use yii\helpers\Html;
use frontend\assets\SignUpAsset;

/* @var $this yii\web\View */
/* @var $model \frontend\models\SignUpForm */

SignUpAsset::register($this);
$this->title = 'Sign up';
$tCategory = 'sign-up';
$uAccountList = $uFromList = [];
?>
<section id="content" class="signup-content">
    <h2><?= Yii::t($tCategory, 'form.title') ?></h2>
    <div class="sign-up-left">
    <?php
    if ($model->hasErrors()) {
        echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
    }
//    if (Yii::$app->session->hasFlash('signup_success')) {
    if ($successMessage = Yii::$app->session->getFlash('signup_success')) {
        echo "<div class='flash-success'>", $successMessage, "</div>";
    } else {
        echo $this->render('_form', [
            'model'        => $model,
            'accountList'  => $accountList,
            'countryList'  => $countryList,
            'referrerList' => $referrerList,
        ]);
    }
    /*
    // Show error msg
    if (Yii::app()->user->hasFlash('user_signUp_failure')) {
        echo "<div class='flash-error'>" . Yii::app()->user->getFlash('user_signUp_failure') . "</div>";
    }*/
    ?>
    </div>
    <!--    Right block-->
    <div class="sign-up-right">
        <?= $this->render('_aside') ?>
    </div>
</section>