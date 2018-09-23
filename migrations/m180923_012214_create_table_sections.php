<?php

use yii\db\Migration;

class m180923_012214_create_table_sections extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sections}}', [
            'idSection' => $this->primaryKey(),
            'header' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'resumes_idResume' => $this->integer()->notNull(),
            'typeSection_idtypeSection' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_sections_typeSection1_idx', '{{%sections}}', 'typeSection_idtypeSection');
        $this->createIndex('fk_sections_resumes1_idx', '{{%sections}}', 'resumes_idResume');
        $this->addForeignKey('fk_sections_resumes1', '{{%sections}}', 'resumes_idResume', '{{%resumes}}', 'idResume', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_sections_typeSection1', '{{%sections}}', 'typeSection_idtypeSection', '{{%typesection}}', 'idtypeSection', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%sections}}');
    }
}
