<?php

use yii\db\Migration;

class m180923_012214_create_table_education extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%education}}', [
            'idEducation' => $this->primaryKey(),
            'startYear' => $this->date()->notNull(),
            'endYear' => $this->date()->notNull(),
            'place' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'resumes_idResume' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_education_resumes1_idx', '{{%education}}', 'resumes_idResume');
        $this->addForeignKey('fk_education_resumes1', '{{%education}}', 'resumes_idResume', '{{%resumes}}', 'idResume', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%education}}');
    }
}
