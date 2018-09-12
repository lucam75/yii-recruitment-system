<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property string $idCountry
 * @property string $name
 * @property string $continent
 * @property string $region
 *
 * @property Cities[] $cities
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCountry', 'name', 'continent', 'region'], 'required'],
            [['continent'], 'string'],
            [['idCountry'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 52],
            [['region'], 'string', 'max' => 26],
            [['idCountry'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCountry' => Yii::t('app', 'Id Country'),
            'name' => Yii::t('app', 'Name'),
            'continent' => Yii::t('app', 'Continent'),
            'region' => Yii::t('app', 'Region'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['countries_idCountry' => 'idCountry']);
    }
}
