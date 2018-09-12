<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $idDocument
 * @property string $description
 * @property string $document
 * @property string $type
 * @property int $resumes_idResume
 *
 * @property Resumes $resumesIdResume
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document', 'type', 'resumes_idResume'], 'required'],
            [['resumes_idResume'], 'integer'],
            [['description'], 'string', 'max' => 45],
            [['document', 'type'], 'string', 'max' => 100],
            [['resumes_idResume'], 'exist', 'skipOnError' => true, 'targetClass' => Resumes::className(), 'targetAttribute' => ['resumes_idResume' => 'idResume']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idDocument' => Yii::t('app', 'Id Document'),
            'description' => Yii::t('app', 'Description'),
            'document' => Yii::t('app', 'Document'),
            'type' => Yii::t('app', 'Type'),
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
