<?php
use yii\helpers\Html;
use yii\helpers\Url;

$tCategory = 'sign-up';
?>
<div class="signup-column">
    <h2><?= Yii::t($tCategory, 'sign.up.block.title'); ?></h2>
    <span class="column-heading"><?= Yii::t($tCategory, 'sign.up.block.label.1'); ?></span>
    <?= Html::a(Yii::t($tCategory, 'sign.up.block.create'), Url::to('/signup'), ['class'=>'more-link']); ?>
    <ul class="bullet-list">
        <li><?= Yii::t($tCategory, 'sign.up.block.text.1'); ?></li>
        <li><?= Yii::t($tCategory, 'sign.up.block.text.2'); ?></li>
        <li><?= Yii::t($tCategory, 'sign.up.block.text.3'); ?></li>
    </ul>
    <p><?= Yii::t($tCategory, 'sign.up.block.label.2'); ?></p>
    <ul class="bullet-list">
        <li><?= Yii::t($tCategory, 'sign.up.block.text.4'); ?></li>
        <li><?= Yii::t($tCategory, 'sign.up.block.text.5'); ?></li>
        <li><?= Yii::t($tCategory, 'sign.up.block.text.6'); ?></li>
    </ul>
</div>
