<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>ONTRIS</title>
    <meta name="description" content="">
    <?php
    echo CHtml::linkTag('stylesheet', 'text/css', '/frontend/css/application.css');
    ?>
</head>
<body>
    <?php $this->widget('application.widgets.HeaderBlock');?>
    <div class="wrapper">
        <?=$content;?>
    </div>
</body>
</html>