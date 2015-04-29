<?php

use yii\db\Schema;
use yii\db\Migration;

class m150429_125612_drop_plain_column_from_mail_queue extends Migration
{
    private $_table = 'mail_queue';

    public function up()
    {
        $this->dropColumn($this->_table, 'message_plain');
    }

    public function down()
    {
        $this->addColumn($this->_table, 'message_plain', Schema::TYPE_STRING . ' NOT NULL AFTER message_html');
    }
}
