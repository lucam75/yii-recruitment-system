<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statusresumes".
 *
 * @property int $idStatusResume
 * @property string $state
 * @property string $templateEmail
 *
 * @property Resumes[] $resumes
 */
class Statusresumes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statusresumes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'templateEmail'], 'required'],
            [['templateEmail'], 'string'],
            [['state'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idStatusResume' => Yii::t('app', 'Id Status Resume'),
            'state' => Yii::t('app', 'State'),
            'templateEmail' => Yii::t('app', 'Template Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resumes::className(), ['statusResumes_idStatusResume' => 'idStatusResume']);
    }
}
