<?php

namespace frontend\widgets;

use yii\base\Widget;

class LangMenuWidget extends Widget
{
    public function run()
    {
        if (YII_DEBUG) {
            $code = '
		    <ul class="country-nav">
			    <li><a class="deutch-ico" href="/">deutch</a></li>
			    <li><a class="english-ico" href="/">english</a></li>
			    <li><a class="germany-ico" href="/">germany</a></li>
            </ul>';
        } else {
            $code = '<div class="country-nav"></div>';
        }

        return $code;
    }
}
