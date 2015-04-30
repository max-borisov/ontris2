<?php

use yii\db\Schema;
use yii\db\Migration;

class m150430_122059_rename_activated_at_column_user_table extends Migration
{
    private $_table = 'user';

    public function up()
    {
        $this->renameColumn($this->_table, 'activated_at', 'confirmed_at');
    }

    public function down()
    {
        $this->renameColumn($this->_table, 'confirmed_at', 'activated_at');
    }
}
