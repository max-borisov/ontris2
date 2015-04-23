<?php

namespace frontend\models;

use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_account_type".
 *
 * The followings are the available columns in table 'user_account_type':
 * @property integer $id
 * @property string $title_dk
 * @property string $desc_dk
 * @property string $title_en
 * @property string $desc_en
 * @property string $abbr
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class UserAccountType extends ActiveRecord
{
	// Transportation buyer
    const TB = 1;
	// Carrier
    const CR = 2;
	// Freight forwarder
    const FF = 3;

    /**
     * @inheritdoc
     */
	public static function tableName()
	{
		return 'user_account_type';
	}

    /**
     * @inheritdoc
     */
	public function rules()
	{
		return [];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title_dk' => 'Title Dk',
			'title_en' => 'Title En',
		];
	}

    /*public function lang($lang)
    {
        $this->getDbCriteria()->mergeWith(array(
            'select'=>'id, title_' . $lang,
        ));
        return $this;
    }*/

    /**
     * Get list of User account types
     * @param string $lang
     * @return array|CDbDataReader
     */
    /*public function getListByLang($lang = 'en') {
        return $this->getDbConnection()->createCommand()
            // Select id, title, desc, abbr fields
            ->select('id, abbr, title_' . $lang . ' as title, desc_' . $lang . ' as desc')
            ->from($this->tableName())
            ->order('id ASC')
            ->queryAll();
    }*/

	/**
	 * Get cached data
	 * @param string $lang
	 * @return array
	 * @throws CException
	 */
	/*public function getCachedList($lang = 'en') {
		if (empty($lang)) throw new CException("Empty lang identifier");

		// CacheId prefix
		$prefix = 'UserAccountTypeList_';
		$cacheId = $prefix . $lang;
        $cacheComponent = Yii::app()->fileCache;
		$cacheData = $cacheComponent->get($cacheId);
		// If cache is empty
        if (empty($cacheData)) {
			// If could not save chache
            if (!$cacheComponent->set($cacheId, self::getListByLang($lang))) {
				throw new CException("Could not save cached users account data");
			}
		}
		// Read from cache
        if (!$cacheData = $cacheComponent->get($cacheId)) {
			throw new CException("Could not get cached users account data");
		}
		return $cacheData;
	}*/

    /**
     * Prepare data for radio buttons list
     * @param string $lang
     * @param bool $fromCache
     * @return array
     * @throws CException
     */
    /*public function getListBasedData($lang='en', $fromCache=true) {
        $data = $fromCache ? $this->getCachedList($lang) : $this->getListByLang($lang);
        if (empty($data)) throw new CException("Could not get data with lang " . $lang);
        return CHtml::listData($data, 'id', 'title');
    }*/

    public function getListBasedData() {
        $data = (new Query)
            ->select('id, title_en as title')
            ->from(static::tableName())
            ->orderBy('id ASC')
            ->all();
        return ArrayHelper::map($data, 'id', 'title');
    }
}