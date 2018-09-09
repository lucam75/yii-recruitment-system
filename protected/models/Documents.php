<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $idDocument
 * @property string $description
 * @property string $document
 * @property string $type
 * @property integer $resumes_idResume
 *
 * The followings are the available model relations:
 * @property Resumes $resumesIdResume
 */
class Documents extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return 'documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document, type, resumes_idResume', 'required'),
			array('resumes_idResume', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>45),
			array('document, type', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idDocument, description, document, type, resumes_idResume', 'safe', 'on'=>'search'),
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
			'idDocument' => Yii::t('app','Id Document'),
			'description' => Yii::t('app','Description'),
			'document' => Yii::t('app','Document'),
			'type' => 'Type',
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

		$criteria->compare('idDocument',$this->idDocument);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('resumes_idResume',$this->resumes_idResume);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}