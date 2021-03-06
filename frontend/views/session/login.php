<?php
/* @var $this yii\web\View */
/* @var $model \frontend\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\LogInAsset;
use frontend\widgets\SignUpAsideWidget;
use yii\widgets\ActiveForm;
use frontend\components\Variable;

LogInAsset::register($this);
$this->title = 'Login page';
$tCategory = 'sign-in';
?>
<section id="content">
    <div class="login-column">
        <h2><?= Yii::t($tCategory, 'page.title');?></h2>
        <?php
        if ($messageSuccess = Yii::$app->session->getFlash('email_confirmation_success')) {
            echo "<div class='flash-success'>", $messageSuccess ,"</div>";
        }
        if ($messageError = Yii::$app->session->getFlash('email_confirmation_error')) {
            echo "<div class='flash-error'>", $messageError, "</div>";
        }
        // Show validation errors
        if ($model->hasErrors()) {
            echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
        }

        // If user's account have nit been activated
//        if (!$model->isActivatedAccount()) {
            /*echo "<div class='flash-success'>Please follow the <a href='" . Utility::url('users/activate-account') . '?email=' . $model['email'] . "'>link</a> to activate your account.</div>";

            echo "<div class='flash-success'>If you have not recieved email with activation account link you can re-send it by following the link below.<br/><a href='#'>Activate account</a></div>";*/

            /*echo "<div class='flash-success'>If you have not activated your account yet, please, try it again by following the link below.<br/><br /><a href='" . Utility::url('users/reactivate-account') . '?email=' . $model['email'] . "'>Activate account</a></div>";*/

            /*echo "<div class='flash-success'> " . Yii::t($tCategory, 'msg.reactivation.needed', ['{link}' =>  Html::link(Yii::t($tCategory, 'link.reactivate.account'), Utility::url('users/reactivate-account') . '?email=' . $model['email'])]) . "</div>";
        }*/
        ?>
        <span class="column-heading"><?= Yii::t($tCategory, 'msg.enter.email.pass')?></span>
        <?php
        $form = ActiveForm::begin(['action' => '', 'method' => 'post', 'options' => ['class' => 'signup-form'], 'fieldConfig' => ['template' => "{label}\n{input}"]]);
        ?>
        <fieldset>
            <div class="row">
                <?= $form->field($model, 'email')->input('email', ['id' => 'email', 'class' => 'text', 'required' => true]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'password')->passwordInput(['id' => 'password', 'class' => 'password']) ?>
            </div>
            <div class="row add-row">
                <?= $form->field($model, 'rememberMe')->checkbox(['id'=>'stay-logged', 'class'=>'checkbox']) ?>
                <span class="remove-text"><?= Yii::t($tCategory, 'msg.shared.comp'); ?></span>
            </div>
            <div class="row add-row">
                <a href="<?= Url::to('/users/reset-password'); ?>"><?= Yii::t($tCategory, 'msg.forgot.password'); ?></a>
                <?= Html::submitButton(Yii::t($tCategory, 'form.btn.send'), ['class'=>'submit', 'name'=>'send']); ?>
            </div>
        </fieldset>
        <?php ActiveForm::end(); ?>
    </div>
    <?= SignUpAsideWidget::widget(); ?>
</section>