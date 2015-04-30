<?php
use yii\helpers\Html;
?>
<p>A new user came to the system.</p>
<p>
    Name: <b><?= $userName ?></b><br />
    Email: <b><?= $userEmail ?></b><br />
    Profile: <?= Html::a('view', $userProfileUrl) ?>
</p>