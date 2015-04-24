<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_071348_rename_ctime_mtime_column_for_mail_queue_table extends Migration
{
    private $_table = 'mail_queue';

    public function safeUp()
    {
        $this->renameColumn($this->_table, 'ctime', 'created_at');
        $this->renameColumn($this->_table, 'mtime', 'updated_at');
        $this->renameColumn($this->_table, 'stime', 'sent_at');
        $this->dropColumn($this->_table, 'atime');
    }
    
    public function safeDown()
    {
        $this->addColumn($this->_table, 'atime', Schema::TYPE_INTEGER . ' NOT NULL');
        $this->renameColumn($this->_table, 'sent_at', 'stime');
        $this->renameColumn($this->_table, 'updated_at', 'mtime');
        $this->renameColumn($this->_table, 'created_at', 'ctime');
    }
}
