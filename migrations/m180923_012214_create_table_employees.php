<?php

use yii\db\Migration;

class m180923_012214_create_table_employees extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%employees}}', [
            'idEmployee' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'login' => $this->string()->notNull(),
            'pass' => $this->string()->notNull(),
            'roles_idRol' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%employees}}', ['idEmployee', 'roles_idRol']);
        $this->createIndex('fk_employees_roles1_idx', '{{%employees}}', 'roles_idRol');
        $this->addForeignKey('fk_employees_roles1', '{{%employees}}', 'roles_idRol', '{{%roles}}', 'idRol', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%employees}}');
    }
}
