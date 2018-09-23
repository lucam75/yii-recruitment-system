<?php

use yii\db\Migration;

class m180923_012214_create_table_resumes extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%resumes}}', [
            'idResume' => $this->primaryKey(),
            'firstName' => $this->string()->notNull(),
            'middleName' => $this->string(),
            'lastName' => $this->string()->notNull(),
            'suffix' => $this->string()->notNull(),
            'gender' => $this->char()->notNull(),
            'birthday' => $this->date()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'dateApplication' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'picture' => $this->string(),
            'expectedSalary' => $this->float(),
            'profile' => $this->text(),
            'maritalStatus_idMaritalStatus' => $this->integer()->notNull(),
            'cities_idCity' => $this->integer()->notNull(),
            'statusResumes_idStatusResume' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_resumes_statusResumes1_idx', '{{%resumes}}', 'statusResumes_idStatusResume');
        $this->createIndex('fk_resumes_maritalStatus1_idx', '{{%resumes}}', 'maritalStatus_idMaritalStatus');
        $this->createIndex('fk_resumes_cities1_idx', '{{%resumes}}', 'cities_idCity');
        $this->createIndex('idresumes_UNIQUE', '{{%resumes}}', 'idResume', true);
        $this->addForeignKey('fk_resumes_cities1', '{{%resumes}}', 'cities_idCity', '{{%cities}}', 'idCity', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_resumes_maritalStatus1', '{{%resumes}}', 'maritalStatus_idMaritalStatus', '{{%maritalstatus}}', 'idMaritalStatus', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_resumes_statusResumes1', '{{%resumes}}', 'statusResumes_idStatusResume', '{{%statusresumes}}', 'idStatusResume', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%resumes}}');
    }
}
