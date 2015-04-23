<?php
/* @var $this yii\web\View */
/* @var $model \frontend\models\SignupForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$tCategory = 'sign-up';
$form = ActiveForm::begin([
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
    'options' => ['class' => 'signup-form'],
    'fieldConfig' => ['template' => "{label}\n{input}"]
])
?>
<fieldset>
<div class='country-msg-tpl'>Thank you for visiting our page and for wanting to become a member. Our primary focus at this point is Denmark, but we would like to expand to {country}. If you know someone who is interested in obtaining a license to run ONTRIS in {country} please have them contact us.</div>
<div class='flash-info country-msg'></div>

<div class="row text-row">
    <?= $form->field($model, 'country_id')->dropDownList($countryList, ['id' => 'country_id', 'class' => 'text']) ?>
</div>
<div class="row text-row">
    <?= $form->field($model, 'username')->textInput(['id' => 'full_name', 'class' => 'text']) ?>
</div>
<div class="row text-row">
    <?= $form->field($model, 'email')->input('email', ['id' => 'email', 'class' => 'text', 'placeholder'=>'exmaple@mail.dk']) ?>
</div>
<div class="row text-row">
    <?= $form->field($model, 'password')->passwordInput(['id' => 'password', 'class' => 'text', 'autocomplete' => 'off', 'value' => '']) ?>
</div>
<div class="row text-row">
    <?= $form->field($model, 'password_repeat')->passwordInput(['id' => 'password_repeat', 'class' => 'text']) ?>
</div>
<div class="radio-btn-holder">
    <h3><?= Yii::t($tCategory, 'form.user.account.type') ?></h3>
    <?php
    $prefix = 'type_id_';
    echo $form->field($model, 'type_id', ['template' => '{input}'])->radioList($accountList, [
        'separator' => '',
        'item' => getActiveRadioItem($prefix),
    ]);
    ?>
</div>
<div class="radio-btn-holder user-from-section">
    <h3><?= Yii::t($tCategory, 'form.user.referrer') ?></h3>
    <?php
    $prefix = 'ref_id_';
    echo $form->field($model, 'ref_id', ['template' => '{input}',])->radioList($referrerList, [
        'separator' => '',
        'item' => getActiveRadioItem($prefix),
    ]);
    ?>
</div>
</fieldset>
<br />
<div class="row">
    <?= Html::submitButton('send', [
        'name' => 'send',
        'class' => 'submit',
        'value' => Yii::t($tCategory, 'form.create.account')
    ]) ?>
</div>
<?php ActiveForm::end(); ?>

<?php
/**
 * Generate radio buttons.
 *
 * @param $prefix Prefix for id attribute
 * @return callable
 */
function getActiveRadioItem($prefix) {
    return function($index, $label, $name, $checked, $value) use ($prefix){
        $id = $prefix . $index;
        $checkedAttr = $checked ? 'checked="checked"' : '';
        return $code = <<<EEE
                    <div class="radio-holder">
                        <input type="radio" class="radio" name="$name" value="$value" $checkedAttr id="$id" />
                        <label for="$id">$label</label>
                        </div>
EEE;
    };
}
?>