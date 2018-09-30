<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property int $idSection
 * @property string $header
 * @property string $description
 * @property int $resumes_idResume
 * @property int $typeSection_idtypeSection
 *
 * @property Resumes $resumesIdResume
 * @property Typesection $typeSectionIdtypeSection
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'description', 'resumes_idResume', 'typeSection_idtypeSection', 'idSection'], 'required'],
            [['description'], 'string'],
            [['resumes_idResume', 'typeSection_idtypeSection'], 'integer'],
            [['header'], 'string', 'max' => 100],
            [['resumes_idResume'], 'exist', 'skipOnError' => true, 'targetClass' => Resumes::className(), 'targetAttribute' => ['resumes_idResume' => 'idResume']],
            [['typeSection_idtypeSection'], 'exist', 'skipOnError' => true, 'targetClass' => Typesection::className(), 'targetAttribute' => ['typeSection_idtypeSection' => 'idtypeSection']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSection' => Yii::t('app', 'Id Section'),
            'header' => Yii::t('app', 'Header'),
            'description' => Yii::t('app', 'Description'),
            'resumes_idResume' => Yii::t('app', 'Resumes Id Resume'),
            'typeSection_idtypeSection' => Yii::t('app', 'Type Section Idtype Section'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumesIdResume()
    {
        return $this->hasOne(Resumes::className(), ['idResume' => 'resumes_idResume']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeSectionIdtypeSection()
    {
        return $this->hasOne(Typesection::className(), ['idtypeSection' => 'typeSection_idtypeSection']);
    }
}
