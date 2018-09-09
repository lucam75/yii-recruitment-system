<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $idCity
 * @property string $name
 * @property string $district
 * @property string $countries_idCountry
 *
 * The followings are the available model relations:
 * @property Countries $countriesIdCountry
 * @property Resumes[] $resumes
 */
class Cities extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cities the static model class
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
		return 'cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, district, countries_idCountry', 'required'),
			array('name, district', 'length', 'max'=>45),
			array('countries_idCountry', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCity, name, district, countries_idCountry', 'safe', 'on'=>'search'),
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
			'countriesIdCountry' => array(self::BELONGS_TO, 'Countries', 'countries_idCountry'),
			'resumes' => array(self::HAS_MANY, 'Resumes', 'cities_idCity'),
			'count' => array(self::STAT, 'Resumes', 'cities_idCity'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCity' => Yii::t('app','Id City'),
			'name' => Yii::t('app','Name'),
			'district' => Yii::t('app','District'),
			'countries_idCountry' => 'Countries Id Country',
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

		$criteria->compare('idCity',$this->idCity);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('countries_idCountry',$this->countries_idCountry,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}