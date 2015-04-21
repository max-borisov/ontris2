<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\components\HelperBase;

$tCategory = 'footer';
$email = HelperBase::encodeEmail(HelperBase::getParam('contactEmail'));
?>
<!-- footer begin -->
<footer id="footer">
    <section class="address-box">
        <strong class="footer-logo"><a href="#">ONTRIS find den bedste fragtrips</a></strong>
        <address>Randersvej 32<br />6700 Esbjerg</address>
        <dl>
            <dt><?= Yii::t($tCategory, 'phone.label') ?></dt>
            <dd><?= HelperBase::getParam('contactPhone') ?></dd>
            <dt><?= Yii::t($tCategory, 'email.label') ?></dt>
            <dd><a href="mailto:<?= $email ?>"><?= $email ?></a></dd>
            <dt>CVR:</dt>
            <dd><?= HelperBase::getParam('CVR') ?></dd>
        </dl>
    </section>
    <section class="ico-section">
        <ul class="social-ico">
            <li><a class="facebook-ico" href="#">facebook</a></li>
            <li><a class="twitter-ico" href="#">twitter</a></li>
            <li><a class="google-ico" href="#">google +</a></li>
            <li><a class="rss-ico" href="#">rss</a></li>
            <li><a class="linkedin-ico" href="#">linkked in</a></li>
        </ul>
        <div class="pay-box">
            <span><?= Yii::t($tCategory, 'we.accept.label') ?></span>
            <ul class="pay-ico">
                <li><a href="#"><img src="<?= '/images/pay-ico01.jpg'?>" width="26" height="14" alt="image description"></a></li>
                <li><a href="#"><img src="<?= '/images/pay-ico02.jpg'?>" width="26" height="14" alt="image description"></a></li>
                <li><a href="#"><img src="<?= '/images/pay-ico03.jpg'?>" width="26" height="14" alt="image description"></a></li>
                <li><a href="#"><img src="<?= '/images/pay-ico04.jpg'?>" width="26" height="14" alt="image description"></a></li>
                <li><a href="#"><img src="<?= '/images/pay-ico05.jpg'?>" width="26" height="14" alt="image description"></a></li>
                <li><a href="#"><img src="<?= '/images/pay-ico06.jpg'?>" width="26" height="14" alt="image description"></a></li>
                <li><a href="#"><img src="<?= '/images/pay-ico07.jpg'?>" width="26" height="14" alt="image description"></a></li>
            </ul>
        </div>
    </section>
    <ul class="footer-link-list">
        <li><?=Html::a(Yii::t($tCategory, 'carrier.link'), Url::to('carrier')) ?></li>
        <li><?=Html::a(Yii::t($tCategory, 'freight.forwarder.link'), Url::to('freight-forwarder')) ?></li>
        <li><?= Html::a(Yii::t($tCategory, 'suggest.member.link'), Url::to('suggest-member')) ?></li>
        <li>&nbsp;</li>
        <li><?= Html::a(Yii::t($tCategory, 'privacy.link'), Url::to('privacy-policy')) ?></li>
        <li><?= Html::a(Yii::t($tCategory, 'cookies.link'), Url::to('cookies')) ?></li>
        <li><?= Html::a(Yii::t($tCategory, 'feedback.link'), Url::to('feedback')) ?></li>
        <li><?= Html::a(Yii::t($tCategory, 'support.link'), Url::to('support')) ?></li>
    </ul>
    <ul class="mobile-link-list">
        <li><a href="#"><img src="<?= '/images/app_mac.png'?>" width="150" height="44" alt="Apple"></a></li>
        <li><a href="#"><img src="<?= '/images/app_android.png'?>" width="150" height="49" alt="Android"></a></li>
    </ul>
</footer>
<!-- footer end -->