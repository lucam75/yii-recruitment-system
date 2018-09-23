<?php

use yii\db\Migration;

class m180923_012214_create_table_countries extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%countries}}', [
            'idCountry' => $this->string()->notNull()->append('PRIMARY KEY'),
            'name' => $this->string()->notNull(),
            'continent' => $this->string()->notNull(),
            'region' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%countries}}');
    }
}
