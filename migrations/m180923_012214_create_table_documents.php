<?php

use yii\db\Migration;

class m180923_012214_create_table_documents extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%documents}}', [
            'idDocument' => $this->primaryKey(),
            'description' => $this->string(),
            'document' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'resumes_idResume' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_documents_resumes1_idx', '{{%documents}}', 'resumes_idResume');
        $this->addForeignKey('fk_documents_resumes1', '{{%documents}}', 'resumes_idResume', '{{%resumes}}', 'idResume', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%documents}}');
    }
}
