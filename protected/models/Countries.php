<?php

/**
 * This is the model class for table "countries".
 *
 * The followings are the available columns in table 'countries':
 * @property string $idCountry
 * @property string $name
 * @property string $continent
 * @property string $region
 *
 * The followings are the available model relations:
 * @property Cities[] $cities
 */
class Countries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Countries the static model class
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
		return 'countries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCountry, name, continent, region', 'required'),
			array('idCountry', 'length', 'max'=>3),
			array('name', 'length', 'max'=>52),
			array('continent', 'length', 'max'=>13),
			array('region', 'length', 'max'=>26),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCountry, name, continent, region', 'safe', 'on'=>'search'),
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
			'cities' => array(self::HAS_MANY, 'Cities', 'countries_idCountry'),
			'count'=>array(self::STAT,'Cities','countries_idCountry'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCountry' => 'Id Country',
			'name' => Yii::t('app','Name'),
			'continent' => Yii::t('app','Continent'),
			'region' => Yii::t('app','Region'),
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

		$criteria->compare('idCountry',$this->idCountry,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('continent',$this->continent,true);
		$criteria->compare('region',$this->region,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}