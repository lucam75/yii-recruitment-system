<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "changelogstatus".
 *
 * @property int $idChangeLogStatus
 * @property int $statusOld
 * @property int $statusNew
 * @property string $date
 * @property int $resumes_idResume
 * @property int $employees_idEmployee
 * @property int $employees_roles_idRol
 *
 * @property Employees $employeesIdEmployee
 */
class Changelogstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'changelogstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statusOld', 'statusNew', 'resumes_idResume', 'employees_idEmployee', 'employees_roles_idRol'], 'required'],
            [['statusOld', 'statusNew', 'resumes_idResume', 'employees_idEmployee', 'employees_roles_idRol'], 'integer'],
            [['date'], 'safe'],
            [['employees_idEmployee', 'employees_roles_idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employees_idEmployee' => 'idEmployee', 'employees_roles_idRol' => 'roles_idRol']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idChangeLogStatus' => Yii::t('app', 'Id Change Log Status'),
            'statusOld' => Yii::t('app', 'Status Old'),
            'statusNew' => Yii::t('app', 'Status New'),
            'date' => Yii::t('app', 'Date'),
            'resumes_idResume' => Yii::t('app', 'Resumes Id Resume'),
            'employees_idEmployee' => Yii::t('app', 'Employees Id Employee'),
            'employees_roles_idRol' => Yii::t('app', 'Employees Roles Id Rol'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeesIdEmployee()
    {
        return $this->hasOne(Employees::className(), ['idEmployee' => 'employees_idEmployee', 'roles_idRol' => 'employees_roles_idRol']);
    }
}
