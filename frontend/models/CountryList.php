<?php

namespace frontend\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "country_list".
 *
 * @property integer $id
 * @property string $code
 * @property string $name_en
 */
class CountryList extends ActiveRecord
{
    const DENMARK = 89;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country_list';
    }

    /**
     * Generates the data suitable for list-based HTML elements
     *
     * @return array
     */
    public function getListBasedData()
    {
        $data = (new Query())
            ->select('id, name_en as title')
            ->from(static::tableName())
            ->orderBy('title ASC')
            ->all();
        return ArrayHelper::map($data, 'id', 'title');
    }
}
