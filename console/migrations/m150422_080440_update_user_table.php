<?php

use yii\db\Schema;
use yii\db\Migration;

class m150422_080440_update_user_table extends Migration
{
    private $_table = 'user_come_from';

    public function up()
    {
        $this->delete($this->_table, 'id = 5');
        $this->delete($this->_table, 'id = 6');
    }

    public function down()
    {
        echo 'Operation is not possible.';
    }
}
