<?php

namespace frontend\widgets;

use yii\base\Widget;

class SignUpAsideWidget extends Widget
{
    public function run()
    {
        return $this->render('signup-aside');
    }
}
