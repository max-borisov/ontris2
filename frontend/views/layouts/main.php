<?php
use yii\helpers\Html;
use frontend\widgets\HeaderWidget;
use frontend\widgets\FooterWidget;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php
    /*// Try to get page SEO parameters
    if (!empty($this->seo)) {
    echo isset($this->seo['title']) ? CHtml::tag('title', [], $this->seo['title']) : '';
    echo isset($this->seo['description']) ? CHtml::metaTag($this->seo['description'], 'description') : '';
    }
    // Only for DEBUG mode
    if (YII_DEBUG) {
    echo CHtml::metaTag('noindex,nofollow', 'robots');
    }
    */?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?= HeaderWidget::widget() ?>
    <div class="wrapper">
        <article id="main">
            <div class="main-holder">
                <div class="main-frame">
                    <?= $content ?>
                </div>
            </div>
        </article>
        <?= FooterWidget::widget() ?>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
