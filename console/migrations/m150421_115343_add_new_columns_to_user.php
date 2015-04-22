<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_115343_add_new_columns_to_user extends Migration
{
    private $_table = '{{%user}}';

    public function up()
    {
        $this->addColumn($this->_table, 'country_id', Schema::TYPE_INTEGER . ' NOT NULL AFTER id');
        $this->addColumn($this->_table, 'type_id', Schema::TYPE_INTEGER . ' NOT NULL AFTER username');
        $this->addColumn($this->_table, 'bd_id', Schema::TYPE_INTEGER . ' NOT NULL AFTER type_id');
        $this->addColumn($this->_table, 'inviter_id', Schema::TYPE_INTEGER . ' NOT NULL AFTER bd_id');
        $this->addColumn($this->_table, 'phone', Schema::TYPE_STRING . ' NOT NULL AFTER inviter_id');
        $this->addColumn($this->_table, 'is_company_admin', Schema::TYPE_SMALLINT . ' NOT NULL AFTER phone');
        $this->addColumn($this->_table, 'is_site_admin', Schema::TYPE_SMALLINT . ' NOT NULL AFTER is_company_admin');
        $this->addColumn($this->_table, 'invite_msg', Schema::TYPE_STRING . ' NOT NULL AFTER is_site_admin');
        $this->addColumn($this->_table, 'login_at', Schema::TYPE_INTEGER . ' NOT NULL AFTER invite_msg');
        $this->addColumn($this->_table, 'activated_at', Schema::TYPE_INTEGER . ' NOT NULL AFTER login_at');
    }

    public function down()
    {
        $this->dropColumn($this->_table, 'activated_at');
        $this->dropColumn($this->_table, 'login_at');
        $this->dropColumn($this->_table, 'invite_msg');
        $this->dropColumn($this->_table, 'is_site_admin');
        $this->dropColumn($this->_table, 'is_company_admin');
        $this->dropColumn($this->_table, 'phone');
        $this->dropColumn($this->_table, 'inviter_id');
        $this->dropColumn($this->_table, 'bd_id');
        $this->dropColumn($this->_table, 'type_id');
        $this->dropColumn($this->_table, 'country_id');
    }
}
