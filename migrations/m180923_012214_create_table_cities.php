<?php

use yii\db\Migration;

class m180923_012214_create_table_cities extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cities}}', [
            'idCity' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'district' => $this->string()->notNull(),
            'countries_idCountry' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_cities_countries1_idx', '{{%cities}}', 'countries_idCountry');
        $this->addForeignKey('fk_cities_countries1', '{{%cities}}', 'countries_idCountry', '{{%countries}}', 'idCountry', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%cities}}');
    }
}
