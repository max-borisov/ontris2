<?php
namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\helpers\VarDumper;

class Variable extends Component
{
    /**
     * Print variable
     * @param mixed $data Number/string/array/object to be printed
     * @param bool $terminate Whether terminate app or not
     */
    public static function dump($data, $terminate = false)
    {
        echo '<pre>';
        VarDumper::dump($data, 10, true);
        echo '</pre>';

        if (true === $terminate) {
            HelperBase::end();
        }
    }
}