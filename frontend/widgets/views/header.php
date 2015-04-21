<?php
use yii\helpers\Html;
use frontend\widgets\LangMenuWidget;
use frontend\widgets\TopMenuWidget;

$title = \Yii::t('common', 'title');
?>
<header id="header">
    <div class="header-holder">
        <h1 class="logo">
            <?= Html::a($title, '/', ['title' => $title]);?>
        </h1>
        <div class="nav-holder">
            <?= LangMenuWidget::widget() ?>
            <?= TopMenuWidget::widget() ?>
        </div>
    </div>
</header>