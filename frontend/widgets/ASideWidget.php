<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\UserAccountType;

class ASideWidget extends Widget
{
    public function run()
    {
        $ordersCount = 0;
        return $this->render('aside', [
            'ordersCount' => $ordersCount,
            'companies' => $this->_getCompanies(),
        ]);
    }

    private function _getCompanies($limit = 3)
    {
        return (new \yii\db\Query())
            ->select('company_name, city, zip')
            ->from('basic_data bd')
            // Only companies which has prices
            ->innerJoin('transportation_prices tp', 'tp.bd_id = bd.id')
            ->where('bd.del_flag=0 AND (bd.company_type_id = :CR OR bd.company_type_id = :FF)', [':CR' => UserAccountType::CR, ':FF' => UserAccountType::FF])
            ->orderBy('bd.id DESC')
            ->limit($limit)
            ->all();
    }
}
