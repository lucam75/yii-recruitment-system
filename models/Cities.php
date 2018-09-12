<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $idCity
 * @property string $name
 * @property string $district
 * @property string $countries_idCountry
 *
 * @property Countries $countriesIdCountry
 * @property Resumes[] $resumes
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'district', 'countries_idCountry'], 'required'],
            [['name', 'district'], 'string', 'max' => 45],
            [['countries_idCountry'], 'string', 'max' => 3],
            [['countries_idCountry'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countries_idCountry' => 'idCountry']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCity' => Yii::t('app', 'Id City'),
            'name' => Yii::t('app', 'Name'),
            'district' => Yii::t('app', 'District'),
            'countries_idCountry' => Yii::t('app', 'Countries Id Country'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesIdCountry()
    {
        return $this->hasOne(Countries::className(), ['idCountry' => 'countries_idCountry']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resumes::className(), ['cities_idCity' => 'idCity']);
    }
}
