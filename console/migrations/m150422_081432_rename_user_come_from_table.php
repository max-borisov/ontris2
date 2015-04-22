<?php

use yii\db\Schema;
use yii\db\Migration;

class m150422_081432_rename_user_come_from_table extends Migration
{
    private $_tableName = 'user_come_from';
    private $_tableNewName = 'user_referrer';

    public function up()
    {
        $this->renameTable($this->_tableName, $this->_tableNewName);
    }

    public function down()
    {
        $this->renameTable($this->_tableNewName, $this->_tableName);
    }
}
