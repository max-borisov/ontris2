<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_055356_rename_column_success_for_mail_queue_table extends Migration
{
    private $_table = 'mail_queue';

    public function up()
    {
        $this->renameColumn($this->_table, 'success', 'status');
    }

    public function down()
    {
        $this->renameColumn($this->_table, 'status', 'success');
    }
}
