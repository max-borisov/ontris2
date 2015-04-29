<?php

use yii\db\Schema;
use yii\db\Migration;

class m150429_081510_add_confirmation_token_to_user extends Migration
{
    private $_table = 'user';

    public function up()
    {
        $this->addColumn($this->_table, 'confirmation_token', Schema::TYPE_STRING . ' NOT NULL AFTER auth_key');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'confirmation_token');
    }
}
