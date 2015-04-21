<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\components\HelperBase;
use frontend\components\HelperUser;
use yii\helpers\Html;
use yii\helpers\Url;

class TopMenuWidget extends Widget
{
    public function run()
    {
        $tCategory = 'top-menu';
        $menuLinks = HelperBase::getParam('topMenu');
        // If user is logged in remove first item with signUp link
        if (!HelperUser::isGuest()) {
            array_shift($menuLinks);
        }
        $code = '<nav class="top-nav"><ul>';

        if (!HelperUser::isGuest()) {
            $code .= '<li>' . Html::a(Yii::t($tCategory, 'link.profile'), Url::to('/company/users/view/' . HelperUser::uid())) . '</li>';
        }
        foreach ($menuLinks as $item) {
            $code .= '<li>' . Html::a(Yii::t($tCategory, $item['key']), Url::to($item['url'])) . '</li>';
        }

        // Show Sign in link if a guest user
        if (HelperUser::isGuest()) {
            $code .= '<li>' . Html::a(Yii::t($tCategory, 'link.signIn'), Url::to('/sign-in'), ['class' => 'login-link']) . '</li>';
        } else { // show Logout link
            $code .= '<li>' . Html::a(Yii::t($tCategory, 'link.log.out'), Url::to('/logout'), ['class' => 'login-link']) . '</li>';
        }
        $code .= '</ul></nav>';

        return $code;
    }
}
