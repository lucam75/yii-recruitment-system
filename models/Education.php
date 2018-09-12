<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property int $idEducation
 * @property string $startYear
 * @property string $endYear
 * @property string $place
 * @property string $title
 * @property string $description
 * @property int $resumes_idResume
 *
 * @property Resumes $resumesIdResume
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['startYear', 'endYear', 'place', 'title', 'resumes_idResume'], 'required'],
            [['startYear', 'endYear'], 'safe'],
            [['description'], 'string'],
            [['resumes_idResume'], 'integer'],
            [['place'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 200],
            [['resumes_idResume'], 'exist', 'skipOnError' => true, 'targetClass' => Resumes::className(), 'targetAttribute' => ['resumes_idResume' => 'idResume']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEducation' => Yii::t('app', 'Id Education'),
            'startYear' => Yii::t('app', 'Start Year'),
            'endYear' => Yii::t('app', 'End Year'),
            'place' => Yii::t('app', 'Place'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'resumes_idResume' => Yii::t('app', 'Resumes Id Resume'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumesIdResume()
    {
        return $this->hasOne(Resumes::className(), ['idResume' => 'resumes_idResume']);
    }
}
