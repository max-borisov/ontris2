<?php
/* @var $model CModel */
/* @var $this Controller */

$tCategory = 'signIn';
?>
<section id="content">
    <div class="login-column">
        <h2><?=Yii::t($tCategory, 'page.title');?></h2>
        <?php
        // Show account activation success msg
        if (Yii::app()->user->hasFlash('user_activation_success')) {
            echo "<div class='flash-success'>" . Yii::app()->user->getFlash('user_activation_success') . "</div>";
        }
        // Show account activation error msg
        if (Yii::app()->user->hasFlash('user_activation_failure')) {
            echo "<div class='flash-error'>" . Yii::app()->user->getFlash('user_activation_failure') . "</div>";
        }
        // Show validation errors
        if ($model->hasErrors()) {
            echo CHtml::errorSummary($model);
        }

        // If user's account have nit been activated
        if (!$model->isActivatedAccount()) {
            /*echo "<div class='flash-success'>Please follow the <a href='" . Utility::url('users/activate-account') . '?email=' . $model['email'] . "'>link</a> to activate your account.</div>";

            echo "<div class='flash-success'>If you have not recieved email with activation account link you can re-send it by following the link below.<br/><a href='#'>Activate account</a></div>";*/

            /*echo "<div class='flash-success'>If you have not activated your account yet, please, try it again by following the link below.<br/><br /><a href='" . Utility::url('users/reactivate-account') . '?email=' . $model['email'] . "'>Activate account</a></div>";*/

            echo "<div class='flash-success'> " . Yii::t($tCategory, 'msg.reactivation.needed', ['{link}' => CHtml::link(Yii::t($tCategory, 'link.reactivate.account'), Utility::url('users/reactivate-account') . '?email=' . $model['email'])]) . "</div>";
        }
        ?>
        <span class="column-heading"><?=Yii::t($tCategory, 'msg.enter.email.pass')?></span>
        <?=CHtml::beginForm('', 'post', array('class' => 'signup-form')); ?>
            <fieldset>
                <div class="row">
                    <?=CHtml::activeLabel($model, 'email', array('for' => 'email', 'required'=>true));?>
                    <?=CHtml::activeTextField($model, 'email', array('id' => 'email', 'class' => 'text')); ?>
                </div>
                <div class="row">
                    <?=CHtml::activeLabel($model, 'password', array('for' => 'password', 'required'=>true));?>
                    <?=CHtml::activePasswordField($model, 'password', array('id' => 'password', 'class' => 'password')); ?>
                </div>
                <div class="row add-row">
                    <?=CHtml::checkBox('stayLoggedFlag', $stayLoggedFlag, ['id'=>'stay-logged', 'class'=>'checkbox']);?>
                    <label for="stay-logged"><?=Yii::t($tCategory, 'msg.logged.in')?></label>
                    <span class="remove-text"><?=Yii::t($tCategory, 'msg.shared.comp')?></span>
                </div>
                <div class="row add-row">
                    <a href="<?=Utility::url('users/reset-password');?>"><?=Yii::t($tCategory, 'msg.forgot.password')?></a>
                    <?=CHtml::submitButton(Yii::t($tCategory, 'form.btn.send'), array('class'=>'submit', 'name'=>'send'));?>
                </div>
            </fieldset>
        </form>
        <?=CHtml::endForm();?>
    </div>
    <?=$this->renderPartial('../_blocks/signUpIntro');?>
</section>