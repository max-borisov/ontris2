<?php
use yii\helpers\Html;
use frontend\components\HelperBase;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<?php

$siteUrl = HelperBase::getParam('siteUrl');
$imagePath = $siteUrl . '/images/';
$userName = 'TEST USERNAME';
$infoEmail = HelperBase::getParam('fromEmail');
$infoPhone = HelperBase::getParam('contactPhone');
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type="text/css">
        * {
            -webkit-text-size-adjust: none;
            -webkit-text-resize: 100%;
            text-resize: 100%;
        }
        #outlook a {padding:0;}
        body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
        .ExternalClass {width:100%; display:block !important;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}

        img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 1em 0;}

        h1, h2, h3, h4, h5, h6 {color: black !important;}
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}
        h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {color: red !important;}
        h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {color: purple !important;}

        table td {border-collapse: collapse;}
        a {color: orange;}

        @media only screen and (max-device-width: 480px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: black;
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: orange !important;
                pointer-events: auto;
                cursor: default;
            }
        }
        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: blue;
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: orange !important;
                pointer-events: auto;
                cursor: default;
            }
        }
        @media only screen and (-webkit-min-device-pixel-ratio: 2) {}
        @media only screen and (-webkit-device-pixel-ratio:.75) {}
        @media only screen and (-webkit-device-pixel-ratio:1) {}
        @media only screen and (-webkit-device-pixel-ratio:1.5) {}
    </style>
    <!--[if IEMobile 7]>
    <style type="text/css">
    </style>
    <![endif]-->
    <!--[if gte mso 9]>
    <style>
    </style>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body bgcolor="#E2E2E2" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<?php $this->beginBody() ?>
<table  bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="width:100%; padding-right:10px; padding-left:10px; border-bottom:1px solid #ADADAD;">
    <tbody>
    <tr>
        <td width="50%">&nbsp;</td>
        <td width="600">
            <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: 16px; font-family:Arial, Helvetica, sans-serif; color: rgb(0, 0, 0);">
                <tbody>
                <tr>
                    <td style="font-size:0; line-height:0;">
                        <img style="display:block;" src="none.gif" width="600" height="1" alt="image description">
                    </td>
                </tr>
                <tr>
                    <td height="10" style="font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="font-size:0; line-height:0;">
                                    <a target="_blank" href="<?= $siteUrl ?>"><img style="display:block;" src="<?= $imagePath ?>logo.png" width="200" height="51" alt="<?= Yii::t('common', 'motto') ?>"></a>
                                </td>
                                <td width="100" style="font-size:0; line-height:0;">&nbsp;</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20" style="font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </td>
        <td width="50%">&nbsp;</td>
    </tr>
    </tbody>
</table>
<table  bgcolor="#E2E2E2" cellpadding="0" cellspacing="0" style="width:100%; padding-right:10px; padding-left:10px;">
    <tbody>
    <tr>
        <td width="50%">&nbsp;</td>
        <td width="600">
            <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; line-height: 16px; font-family:Arial, Helvetica, sans-serif; color: rgb(0, 0, 0);">
                <tbody>
                <tr>
                    <td bgcolor="#E2E2E2" height="20" style="font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:0; line-height:0;">
                        <img style="display:block;" src="<?= $imagePath ?>bg-top.gif" width="600" height="7" alt="image description">
                    </td>
                </tr>
                <tr>
                    <td height="10" style="font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td >
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td width="10" style="font-size:0; line-height:0;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td style=" font-size: 22px; line-height: 21px; font-family:Arial, Helvetica, sans-serif; color:#F48B07;">
                                                <div style="display:inline; line-height:26px;">
                                                    <?= Yii::t('common', 'email.hi'), ' ', $userName ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20" style="font-size:0; line-height:0;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style=" font-size: 14px; line-height: 13px; font-family:Arial, Helvetica, sans-serif; color:#404040;">
                                                <div style="display:inline; line-height:19px;">
                                                    <?= $content ?>
                                                    <p><?= Yii::t('common', 'email.no.reply') ?></p>
                                                    <p><?= Yii::t('common', 'email.get.in.touch', ['infoEmail' => $infoEmail, 'infoPhone' => $infoPhone]) ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20" style="font-size:0; line-height:0;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style=" font-size: 14px; line-height: 13px; font-family:Arial, Helvetica, sans-serif; color:#404040;">
                                                <div style="display:inline; line-height:19px;">
                                                    <?= Yii::t('common', 'email.regards') ?>,<br />
                                                    <a target="_blank" style="color:#F48B07; text-decoration:none;" href="<?= $siteUrl ?>">ONTRIS</a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="10" style="font-size:0; line-height:0;">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:0; line-height:0;">
                        <img style="display:block;" src="<?= $imagePath ?>bg-bottom.gif" width="600" height="32" alt="image description">
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#E2E2E2" height="30" style="font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:0; line-height:0;">
                        <img style="display:block;" src="<?= $imagePath ?>bg-top.gif" width="600" height="7" alt="image description">
                    </td>
                </tr>
                <tr>
                    <td height="15" style="font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td >
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td width="20" style="font-size:0; line-height:0;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td style="font-size:0; line-height:0;">
                                                <a target="_blank" href="<?= $siteUrl ?>"><img style="display:block;" src="<?= $imagePath ?>logo.png" width="120" height="31" alt="<?= Yii::t('common', 'motto') ?>"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="15" style="font-size:0; line-height:0;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style=" font-size: 12px; line-height: 11px; font-family:Arial, Helvetica, sans-serif; color:#404040;">
                                                <div style="display:inline; line-height:16px;">
                                                    Randersvej 27<br />
                                                    6700 Esbjerg<br />
                                                    <?= Yii::t('footer', 'phone.label'), ' ', $infoPhone ?><br />
                                                    <?= Yii::t('footer', 'email.label') ?> <a target="_blank" style="text-decoration:none; color:#F48B07;" href="mailto:<?= $infoEmail ?>"><?= $infoEmail ?></a><br />
                                                    CVR: <?= HelperBase::getParam('CVR') ?>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="60" style="font-size:0; line-height:0;">&nbsp;</td>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-size:0; line-height:0;">
                                                            <a target="_blank" href=""><img style="display:block;" src="<?= $imagePath ?>icon_fb.jpg" width="25" height="25" alt="image description"></a>
                                                        </td>
                                                        <td width="4" style="font-size:0; line-height:0;">&nbsp;</td>
                                                        <td style="font-size:0; line-height:0;">
                                                            <a target="_blank" href=""><img style="display:block;" src="<?= $imagePath ?>icon_tw.jpg" width="25" height="25" alt="image description"></a>
                                                        </td>
                                                        <td width="4" style="font-size:0; line-height:0;">&nbsp;</td>
                                                        <td style="font-size:0; line-height:0;">
                                                            <a target="_blank" href=""><img style="display:block;" src="<?= $imagePath ?>icon_g.jpg" width="25" height="25" alt="image description"></a>
                                                        </td>
                                                        <td width="4" style="font-size:0; line-height:0;">&nbsp;</td>
                                                        <td style="font-size:0; line-height:0;">
                                                            <a target="_blank" href=""><img style="display:block;" src="<?= $imagePath ?>icon_rss.jpg" width="25" height="25" alt="image description"></a>
                                                        </td>
                                                        <td width="4" style="font-size:0; line-height:0;">&nbsp;</td>
                                                        <td style="font-size:0; line-height:0;">
                                                            <a target="_blank" href=""><img style="display:block;" src="<?= $imagePath ?>icon_in.jpg" width="25" height="25" alt="image description"></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td height="25" style="font-size:0; line-height:0;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style=" font-size: 13px; line-height: 12px; font-family:Arial, Helvetica, sans-serif; color:#404040;">
                                                <div style="display:inline; line-height:16px;">
                                                    <?= Yii::t('footer', 'we.accept.label') ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="10" style="font-size:0; line-height:0;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0; line-height:0;">
                                                <img style="display:block;" src="<?= $imagePath ?>icon_card-img.jpg" width="127" height="35" alt="image description">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="60" style="font-size:0; line-height:0;">&nbsp;</td>
                                <td >
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td style=" font-size: 12px; line-height: 11px; font-family:Arial, Helvetica, sans-serif; color:#404040;">
                                                <div style="display:inline; line-height:18px;">
                                                    <a target="_blank" style="color:#404040; text-decoration:none;" href="<?= $siteUrl ?>/suggest-member.html"><?= Yii::t('footer', 'suggest.member.link') ?></a> <span style="font-size:10px;">&#9658;</span> <br />
                                                    <a target="_blank" style="color:#404040; text-decoration:none;" href="<?= $siteUrl ?>/privacy-policy.html"><?= Yii::t('footer', 'privacy.link') ?></a> <span style="font-size:10px;">&#9658;</span> <br />
                                                    <a target="_blank" style="color:#404040; text-decoration:none;" href="<?= $siteUrl ?>/cookies.html"><?= Yii::t('footer', 'cookies.link') ?></a> <span style="font-size:10px;">&#9658;</span> <br />
                                                    <a target="_blank" style="color:#404040; text-decoration:none;" href="<?= $siteUrl ?>/feedback.html"><?= Yii::t('footer', 'feedback.link') ?></a> <span style="font-size:10px;">&#9658;</span> <br />
                                                    <a target="_blank" style="color:#404040; text-decoration:none;" href="<?= $siteUrl ?>/support.html"><?= Yii::t('footer', 'support.link') ?></a> <span style="font-size:10px;">&#9658;</span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:0; line-height:0;">
                        <img style="display:block;" src="<?= $imagePath ?>bg-bottom.gif" width="600" height="32" alt="image description">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td width="50%">&nbsp;</td>
    </tr>
    </tbody>
</table>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>