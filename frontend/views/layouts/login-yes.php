<?php
/* @var $this Controller */
$this->beginContent('//layouts/main');
// Set js variable for logged users
Utility::registerScript(['isLoggedUserFlag', 'isLoggedUser', 1]);
echo $content;
?>
<aside id="aside">
    <?php $this->widget('application.widgets.AsideMenu');?>
</aside>
<?php $this->endContent(); ?>