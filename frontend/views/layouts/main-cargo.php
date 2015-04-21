<?php /* @var $this Controller */ ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <?php
    // Try to get page SEO parameters
    if (!empty($this->seo)) {
        echo isset($this->seo['title']) ? CHtml::tag('title', [], $this->seo['title']) : '';
        echo isset($this->seo['description']) ? CHtml::metaTag($this->seo['description'], 'description') : '';
    }
    // Only for DEBUG mode
    if (YII_DEBUG) {
        echo CHtml::metaTag('noindex,nofollow', 'robots');
    }
    ?>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
<?php
// Check if a company account has been deleted. If it is so, logout user.
Utility::checkIfCompanyAccountHasBeenDeactivated();

// Check if a user account has been deleted. If it is so, logout user.
Utility::checkIfUserAccountHasBeenDeactivated();

// Header block
$this->widget('application.widgets.HeaderBlock');

if (Utility::ifAdminLoginAsUser()) {
    $this->widget('application.widgets.AdminAsUserBlock');
}

if (!Utility::isGuestUser()) {
    $this->widget('application.widgets.LoggedUserBlock');
}

if (!Utility::isGuestUser() && ((User::isCR() || User::isFF()) && User::model()->isSuper(0, false))) {
    if (User::model()->showLoginNotification(Utility::getUserId())) {
        $this->widget('application.widgets.LogInNotificationBlock');
    }
}

// Show debug block
if ((Yii::app()->request->getQuery('debug') === '1' || YII_DEBUG === true) && !Utility::isGuestUser()) {
//if (!Utility::isGuestUser()) {
    $this->widget('application.widgets.DebugBlock');
}
?>
<div class="wrapper">
    <article id="main">
        <div class="main-holder">
            <div class="main-frame">
                <?=$content;?>
            </div>
        </div>
    </article>
	<?=$this->widget('application.widgets.FooterBlock', [], true);?>
</div>
<?php
    if (!YII_DEBUG) {
        // Set GA for prod
        $this->widget('application.widgets.GA');
    }
?>
</body>
</html>