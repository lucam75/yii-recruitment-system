<?php

/**
 * This is the model class for table "typesection".
 *
 * The followings are the available columns in table 'typesection':
 * @property integer $idtypeSection
 * @property string $nameSection
 *
 * The followings are the available model relations:
 * @property Sections[] $sections
 */
class Typesection extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Typesection the static model class
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
		return 'typesection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nameSection', 'required'),
			array('nameSection', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idtypeSection, nameSection', 'safe', 'on'=>'search'),
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
			'sections' => array(self::HAS_MANY, 'Sections', 'typeSection_idtypeSection'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtypeSection' => Yii::t('app','Idtype Section'),
			'nameSection' => Yii::t('app','Name Section'),
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

		$criteria->compare('idtypeSection',$this->idtypeSection);
		$criteria->compare('nameSection',$this->nameSection,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}