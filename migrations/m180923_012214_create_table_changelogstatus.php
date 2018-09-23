<?php

use yii\db\Migration;

class m180923_012214_create_table_changelogstatus extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%changelogstatus}}', [
            'idChangeLogStatus' => $this->primaryKey(),
            'statusOld' => $this->integer()->notNull(),
            'statusNew' => $this->integer()->notNull(),
            'date' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'resumes_idResume' => $this->integer()->notNull(),
            'employees_idEmployee' => $this->integer()->notNull(),
            'employees_roles_idRol' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_changeLogStatus_employees1_idx', '{{%changelogstatus}}', ['employees_idEmployee', 'employees_roles_idRol']);
        $this->addForeignKey('fk_changeLogStatus_employees1', '{{%changelogstatus}}', ['employees_idEmployee', 'employees_roles_idRol'], '{{%employees}}', ['idEmployee', 'roles_idRol'], 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%changelogstatus}}');
    }
}
