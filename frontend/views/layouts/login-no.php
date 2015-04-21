<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\ASideWidget;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <?php echo $content; ?>
    <aside id="aside">
        <?php
            //$this->widget('application.widgets.AsideBlock');
        ?>
        <?= ASideWidget::widget() ?>
    </aside>
<?php $this->endContent(); ?>