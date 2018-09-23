<?php

use yii\db\Migration;

class m180923_012214_create_table_maritalstatus extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%maritalstatus}}', [
            'idMaritalStatus' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%maritalstatus}}');
    }
}
