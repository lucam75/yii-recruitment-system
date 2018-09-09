<?php

/**
 * This is the model class for table "education".
 *
 * The followings are the available columns in table 'education':
 * @property integer $idEducation
 * @property string $startYear
 * @property string $endYear
 * @property string $place
 * @property string $title
 * @property string $description
 * @property integer $resumes_idResume
 *
 * The followings are the available model relations:
 * @property Resumes $resumesIdResume
 */
class Education extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Education the static model class
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
		return 'education';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('startYear, endYear, place, title, resumes_idResume', 'required'),
			array('resumes_idResume', 'numerical', 'integerOnly'=>true),
			array('startYear, endYear', 'length', 'max'=>4),
			array('startYear, endYear','numerical','min'=>1,'integerOnly'=>true),
			array('endYear','compare','compareAttribute'=>'startYear','operator'=>'>=','message'=>'Start Year must be less than End Year'),
			array('startYear','compare','compareAttribute'=>'endYear','operator'=>'<=','message'=>'Start Year must be less than End Year'),
			array('place', 'length', 'max'=>100),
			array('title', 'length', 'max'=>200),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEducation, startYear, endYear, place, title, description, resumes_idResume', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idEducation' => Yii::t('app','Id Education'),
			'startYear' => Yii::t('app','Start Year'),
			'endYear' => Yii::t('app','End Year'),
			'place' => Yii::t('app','Place'),
			'title' => Yii::t('app','Title'),
			'description' => Yii::t('app','Description'),
			'resumes_idResume' => 'Resumes Id Resume',
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

		$criteria->compare('idEducation',$this->idEducation);
		$criteria->compare('startYear',$this->startYear,true);
		$criteria->compare('endYear',$this->endYear,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('resumes_idResume',$this->resumes_idResume);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}