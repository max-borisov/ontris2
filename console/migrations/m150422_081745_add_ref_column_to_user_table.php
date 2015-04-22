<?php

use yii\db\Schema;
use yii\db\Migration;

class m150422_081745_add_ref_column_to_user_table extends Migration
{
    private $_table = 'user';

    public function up()
    {
        $this->addColumn($this->_table, 'ref_id', Schema::TYPE_SMALLINT . ' NOT NULL AFTER invite_msg');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'ref_id');
    }
}
