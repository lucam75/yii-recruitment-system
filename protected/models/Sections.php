<?php

/**
 * This is the model class for table "sections".
 *
 * The followings are the available columns in table 'sections':
 * @property integer $idSection
 * @property string $header
 * @property string $description
 * @property integer $resumes_idResume
 * @property integer $typeSection_idtypeSection
 *
 * The followings are the available model relations:
 * @property Resumes $resumesIdResume
 * @property Typesection $typeSectionIdtypeSection
 */
class Sections extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sections the static model class
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
		return 'sections';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('header, description, resumes_idResume, typeSection_idtypeSection', 'required'),
			array('resumes_idResume, typeSection_idtypeSection', 'numerical', 'integerOnly'=>true),
			array('header', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSection, header, description, resumes_idResume, typeSection_idtypeSection', 'safe', 'on'=>'search'),
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
			'resumesIdResume' => array(self::BELONGS_TO, 'Resumes', 'resumes_idResume'),
			'typeSectionIdtypeSection' => array(self::BELONGS_TO, 'Typesection', 'typeSection_idtypeSection'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idSection' => Yii::t('app','Id Section'),
			'header' => Yii::t('app','Header'),
			'description' => Yii::t('app','Description'),
			'resumes_idResume' => 'Resumes Id Resume',
			'typeSection_idtypeSection' => 'Type Section Idtype Section',
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

		$criteria->compare('idSection',$this->idSection);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('resumes_idResume',$this->resumes_idResume);
		$criteria->compare('typeSection_idtypeSection',$this->typeSection_idtypeSection);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}