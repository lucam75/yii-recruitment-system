<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property integer $idEmployee
 * @property string $name
 * @property string $login
 * @property string $pass
 * @property integer $roles_idRol
 *
 * The followings are the available model relations:
 * @property Changelogstatus[] $changelogstatuses
 * @property Changelogstatus[] $changelogstatuses1
 * @property Roles $rolesIdRol
 */
class Employees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employees the static model class
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
		return 'employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, login, pass, roles_idRol', 'required'),
			array('roles_idRol', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('login, pass', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEmployee, name, login, pass, roles_idRol', 'safe', 'on'=>'search'),
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
			'changelogstatuses' => array(self::HAS_MANY, 'Changelogstatus', 'employees_idEmployee'),
			'changelogstatuses1' => array(self::HAS_MANY, 'Changelogstatus', 'employees_roles_idRol'),
			'rolesIdRol' => array(self::BELONGS_TO, 'Roles', 'roles_idRol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idEmployee' => 'Id',
			'name' => Yii::t('app','Name'),
			'login' => Yii::t('app','Login'),
			'pass' => Yii::t('app','Pass'),
			'roles_idRol' => 'Roles Id Rol',
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

		$criteria->compare('idEmployee',$this->idEmployee);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('roles_idRol',$this->roles_idRol);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}