<?php

/**
 * This is the model class for table "resumes".
 *
 * The followings are the available columns in table 'resumes':
 * @property integer $idResume
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $suffix
 * @property string $gender
 * @property string $birthday
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $dateApplication
 * @property string $picture
 * @property double $expectedSalary
 * @property string $profile
 * @property integer $maritalStatus_idMaritalStatus
 * @property integer $cities_idCity
 * @property integer $statusResumes_idStatusResume
 *
 * The followings are the available model relations:
 * @property Changelogstatus[] $changelogstatuses
 * @property Documents[] $documents
 * @property Education[] $educations
 * @property Maritalstatus $maritalStatusIdMaritalStatus
 * @property Cities $citiesIdCity
 * @property Statusresumes $statusResumesIdStatusResume
 * @property Sections[] $sections
 */
class Resumes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resumes the static model class
	 */
	public $verifyCode;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resumes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstName, lastName, suffix, gender, birthday, email, phone, address, maritalStatus_idMaritalStatus, cities_idCity, statusResumes_idStatusResume', 'required'),
			array('maritalStatus_idMaritalStatus, cities_idCity, statusResumes_idStatusResume', 'numerical', 'integerOnly'=>true),
			array('expectedSalary', 'numerical'),
			array('firstName, middleName, lastName, email', 'length', 'max'=>100),
			array('suffix', 'length', 'max'=>20),
			array('gender', 'length', 'max'=>1),
			array('phone', 'length', 'max'=>45),
			array('address', 'length', 'max'=>200),
			array('profile', 'safe'),
			//personal rules
			array('email','email'),
			// array('birthday','date'),
			// array('picture','file','maxSize'=>3*1024),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			array('birthday', 'type', 'type' => 'date', 'message' => '{attribute}: is not a valid date', 'dateFormat' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idResume, firstName, middleName, lastName, suffix, gender, birthday, email, phone, address, dateApplication, picture, expectedSalary, profile, maritalStatus_idMaritalStatus, cities_idCity, statusResumes_idStatusResume', 'safe', 'on'=>'search'),
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
			'changelogstatuses' => array(self::HAS_MANY, 'Changelogstatus', 'resumes_idResume'),
			'documents' => array(self::HAS_MANY, 'Documents', 'resumes_idResume'),
			'educations' => array(self::HAS_MANY, 'Education', 'resumes_idResume'),
			'maritalStatusIdMaritalStatus' => array(self::BELONGS_TO, 'Maritalstatus', 'maritalStatus_idMaritalStatus'),
			'citiesIdCity' => array(self::BELONGS_TO, 'Cities', 'cities_idCity'),
			'statusResumesIdStatusResume' => array(self::BELONGS_TO, 'Statusresumes', 'statusResumes_idStatusResume'),
			'sections' => array(self::HAS_MANY, 'Sections', 'resumes_idResume'),
			'experiences' => array(self::HAS_MANY, 'Sections', 'resumes_idResume','condition'=>'typeSection_idtypeSection=1'),
			'achievements' => array(self::HAS_MANY, 'Sections', 'resumes_idResume','condition'=>'typeSection_idtypeSection=2'),
			'hobbies' => array(self::HAS_MANY, 'Sections', 'resumes_idResume','condition'=>'typeSection_idtypeSection=3'),
			'interests' => array(self::HAS_MANY, 'Sections', 'resumes_idResume','condition'=>'typeSection_idtypeSection=4'),
			'references' => array(self::HAS_MANY, 'Sections', 'resumes_idResume','condition'=>'typeSection_idtypeSection=5'),
			'new' => array(self::STAT,'Resumes','idResume','condition'=>'statusResumes_idStatusResume = 1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idResume' => 'Id Resume',
			'firstName' => Yii::t('app','First Name'),
			'middleName' => Yii::t('app','Middle Name'),
			'lastName' => Yii::t('app','Last Name'),
			'suffix' => Yii::t('app','Suffix'),
			'gender' => Yii::t('app','Gender'),
			'birthday' => Yii::t('app','Birthday'),
			'email' => Yii::t('app','Email'),
			'phone' => Yii::t('app','Phone'),
			'address' => Yii::t('app','Address'),
			'dateApplication' => Yii::t('app','Date Application'),
			'picture' => Yii::t('app','Picture'),
			'expectedSalary' => Yii::t('app','Expected Salary'),
			'profile' => Yii::t('app','Profile'),
			'maritalStatus_idMaritalStatus' => Yii::t('app','Marital Status'),
			'cities_idCity' => Yii::t('app','City'),
			'statusResumes_idStatusResume' => Yii::t('app','Status Resume'),
			'verifyCode'=>Yii::t('app','Validation code'),
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

		$criteria->compare('idResume',$this->idResume);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('middleName',$this->middleName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('suffix',$this->suffix,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('dateApplication',$this->dateApplication,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('expectedSalary',$this->expectedSalary);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('maritalStatus_idMaritalStatus',$this->maritalStatus_idMaritalStatus);
		$criteria->compare('cities_idCity',$this->cities_idCity);
		$criteria->compare('statusResumes_idStatusResume',$this->statusResumes_idStatusResume);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	// protected function afterFind()
	// {
	// 	$this->dateApplication=date('d/m/Y H:i:s', strtotime($this->dateApplication));
	// 	$this->birthday=date('d/m/Y', strtotime($this->birthday));
	// 	return TRUE;
	// }
	// protected function beforeSave(){

	// 	$this->birthday = implode('-',array_reverse(explode('/',$this->birthday)));
	// 	return TRUE;
	// }
}