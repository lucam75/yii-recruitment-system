<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "typesection".
 *
 * @property int $idtypeSection
 * @property string $nameSection
 *
 * @property Sections[] $sections
 */
class Typesection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'typesection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nameSection'], 'required'],
            [['nameSection'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtypeSection' => Yii::t('app', 'Idtype Section'),
            'nameSection' => Yii::t('app', 'Name Section'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['typeSection_idtypeSection' => 'idtypeSection']);
    }
}
