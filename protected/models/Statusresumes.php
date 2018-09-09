<?php

/**
 * This is the model class for table "statusresumes".
 *
 * The followings are the available columns in table 'statusresumes':
 * @property integer $idStatusResume
 * @property string $state
 * @property string $templateEmail
 *
 * The followings are the available model relations:
 * @property Resumes[] $resumes
 */
class Statusresumes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Statusresumes the static model class
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
		return 'statusresumes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state, templateEmail', 'required'),
			array('state', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idStatusResume, state, templateEmail', 'safe', 'on'=>'search'),
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
			'resumes' => array(self::HAS_MANY, 'Resumes', 'statusResumes_idStatusResume'),
			'count'=>array(self::STAT,'Resumes','statusResumes_idStatusResume'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idStatusResume' => Yii::t('app','Id Status Resume'),
			'state' => Yii::t('app','State'),
			'templateEmail' => Yii::t('app','Template Email'),
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

		$criteria->compare('idStatusResume',$this->idStatusResume);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('templateEmail',$this->templateEmail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}