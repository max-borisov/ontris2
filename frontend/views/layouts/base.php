<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head lang="<?= Yii::$app->language ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <title>Nerds.dk - Hifi, Stereo &amp; Lyd</title>
<!--    <link href="/css/style.css" rel="stylesheet">-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body role="document">
<?php $this->beginBody() ?>
    <div class="container theme-showcase" role="main">
        <!-- header begin -->
        <!-- header end -->
        <?= $content ?>
        <span class="hor-line">&nbsp;</span>
        <!-- footer begin -->
        <!-- footer end -->
    </div> <!-- /container -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/ekko-lightbox-min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="js/jquery.meanmenu.min.js"></script>
    <script type="text/javascript" src="js/jquery.main.js"></script>-->
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>