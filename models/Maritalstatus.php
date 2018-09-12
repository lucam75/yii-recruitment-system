<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maritalstatus".
 *
 * @property int $idMaritalStatus
 * @property string $description
 *
 * @property Resumes[] $resumes
 */
class Maritalstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maritalstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMaritalStatus', 'description'], 'required'],
            [['idMaritalStatus'], 'integer'],
            [['description'], 'string'],
            [['idMaritalStatus'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMaritalStatus' => Yii::t('app', 'Id Marital Status'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resumes::className(), ['maritalStatus_idMaritalStatus' => 'idMaritalStatus']);
    }
}
