<?php

/**
 * This is the model class for table "changelogstatus".
 *
 * The followings are the available columns in table 'changelogstatus':
 * @property integer $idChangeLogStatus
 * @property integer $statusOld
 * @property integer $statusNew
 * @property string $date
 * @property integer $resumes_idResume
 * @property integer $employees_idEmployee
 * @property integer $employees_roles_idRol
 *
 * The followings are the available model relations:
 * @property Employees $employeesIdEmployee
 * @property Employees $employeesRolesIdRol
 */
class Changelogstatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Changelogstatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'changelogstatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('statusOld, statusNew, date, resumes_idResume, employees_idEmployee, employees_roles_idRol', 'required'),
			array('statusOld, statusNew, resumes_idResume, employees_idEmployee, employees_roles_idRol', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idChangeLogStatus, statusOld, statusNew, date, resumes_idResume, employees_idEmployee, employees_roles_idRol', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'thisStatusOld' => array(self::BELONGS_TO, 'Statusresumes', 'statusOld'),
			'thisStatusNew' => array(self::BELONGS_TO, 'Statusresumes', 'statusNew'),
			'employeesIdEmployee' => array(self::BELONGS_TO, 'Employees', 'employees_idEmployee'),
			'employeesRolesIdRol' => array(self::BELONGS_TO, 'Employees', 'employees_roles_idRol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idChangeLogStatus' =>'Id Change Log Status',
			'statusOld' => Yii::t('app','Status Old'),
			'statusNew' => Yii::t('app','Status New'),
			'date' => Yii::t('app','Date'),
			'resumes_idResume' => Yii::t('app','Resumes Id Resume'),
			'employees_idEmployee' => 'Employees Id Employee',
			'employees_roles_idRol' => 'Employees Roles Id Rol',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idChangeLogStatus',$this->idChangeLogStatus);
		$criteria->compare('statusOld',$this->statusOld);
		$criteria->compare('statusNew',$this->statusNew);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('resumes_idResume',$this->resumes_idResume);
		$criteria->compare('employees_idEmployee',$this->employees_idEmployee);
		$criteria->compare('employees_roles_idRol',$this->employees_roles_idRol);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}