<?php
/* @var $this yii\web\View */
/* @var $model \frontend\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\LogInAsset;
use frontend\widgets\SignUpAsideWidget;
use frontend\components\Variable;

//$this->params['page'] = 'login';
//Variable::dump($this->params);

LogInAsset::register($this);
$this->title = 'Login';
$tCategory = 'sign-in';
$rememberMe = true;
?>
<section id="content">
    <div class="login-column">
        <h2><?= Yii::t($tCategory, 'page.title');?></h2>
        <?php
        // Show account activation success msg
        /*if (Yii::app()->user->hasFlash('user_activation_success')) {
            echo "<div class='flash-success'>" . Yii::app()->user->getFlash('user_activation_success') . "</div>";
        }*/
        // Show account activation error msg
        /*if (Yii::app()->user->hasFlash('user_activation_failure')) {
            echo "<div class='flash-error'>" . Yii::app()->user->getFlash('user_activation_failure') . "</div>";
        }*/
        // Show validation errors
        /*if ($model->hasErrors()) {
            echo  Html::errorSummary($model);
        }*/

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
        <?= Html::beginForm('', 'post', ['class' => 'signup-form']); ?>
        <fieldset>
            <div class="row">
                <?= Html::activeLabel($model, 'email', ['for' => 'email']); ?>
                <?= Html::activeTextInput($model, 'email', ['id' => 'email', 'class' => 'text error']); ?>
            </div>
            <div class="row">
                <?= Html::activeLabel($model, 'password', ['for' => 'password']);?>
                <?= Html::activePasswordInput($model, 'password', ['id' => 'password', 'class' => 'password']); ?>
            </div>
            <div class="row add-row">
                <?= Html::checkBox('rememberMe', $rememberMe, ['id'=>'stay-logged', 'class'=>'checkbox']); ?>
                <label for="stay-logged"><?= Yii::t($tCategory, 'msg.logged.in'); ?></label>
                <span class="remove-text"><?= Yii::t($tCategory, 'msg.shared.comp'); ?></span>
            </div>
            <div class="row add-row">
                <a href="<?= Url::to('/users/reset-password'); ?>"><?= Yii::t($tCategory, 'msg.forgot.password'); ?></a>
                <?= Html::submitButton(Yii::t($tCategory, 'form.btn.send'), ['class'=>'submit', 'name'=>'send']); ?>
            </div>
        </fieldset>
        </form>
        <?= Html::endForm(); ?>
    </div>
    <?= SignUpAsideWidget::widget(); ?>
</section>