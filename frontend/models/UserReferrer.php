<?php

namespace frontend\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_referrer".
 *
 * @property integer $id
 * @property string $title_dk
 * @property string $title_en
 * @property integer $ctime
 * @property integer $mtime
 */
class UserReferrer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_referrer';
    }

    public function getListBasedData() {
        $data = (new Query)
            ->select('id, title_en as title')
            ->from(static::tableName())
            ->orderBy('id ASC')
            ->all();
        return ArrayHelper::map($data, 'id', 'title');
    }
}
