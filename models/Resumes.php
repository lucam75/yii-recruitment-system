<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resumes".
 *
 * @property int $idResume
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $suffix
 * @property string $gender
 * @property string $birthday
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $dateApplication
 * @property string $picture
 * @property double $expectedSalary
 * @property string $profile
 * @property int $maritalStatus_idMaritalStatus
 * @property int $cities_idCity
 * @property int $statusResumes_idStatusResume
 *
 * @property Documents[] $documents
 * @property Education[] $educations
 * @property Cities $citiesIdCity
 * @property Maritalstatus $maritalStatusIdMaritalStatus
 * @property Statusresumes $statusResumesIdStatusResume
 * @property Sections[] $sections
 */
class Resumes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resumes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'suffix', 'gender', 'birthday', 'email', 'phone', 'address', 'maritalStatus_idMaritalStatus', 'cities_idCity'], 'required'],
            [['birthday', 'dateApplication'], 'safe'],
            [['expectedSalary'], 'number'],
            [['profile'], 'string'],
            [['maritalStatus_idMaritalStatus', 'cities_idCity', 'statusResumes_idStatusResume'], 'integer'],
            [['firstName', 'middleName', 'lastName', 'email', 'picture'], 'string', 'max' => 100],
            [['suffix'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 1],
            [['phone'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 200],
            [['cities_idCity'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['cities_idCity' => 'idCity']],
            [['maritalStatus_idMaritalStatus'], 'exist', 'skipOnError' => true, 'targetClass' => Maritalstatus::className(), 'targetAttribute' => ['maritalStatus_idMaritalStatus' => 'idMaritalStatus']],
            [['statusResumes_idStatusResume'], 'exist', 'skipOnError' => true, 'targetClass' => Statusresumes::className(), 'targetAttribute' => ['statusResumes_idStatusResume' => 'idStatusResume']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idResume' => Yii::t('app', 'Id Resume'),
            'firstName' => Yii::t('app', 'First Name'),
            'middleName' => Yii::t('app', 'Middle Name'),
            'lastName' => Yii::t('app', 'Last Name'),
            'suffix' => Yii::t('app', 'Suffix'),
            'gender' => Yii::t('app', 'Gender'),
            'birthday' => Yii::t('app', 'Birthday'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'dateApplication' => Yii::t('app', 'Date Application'),
            'picture' => Yii::t('app', 'Picture'),
            'expectedSalary' => Yii::t('app', 'Expected Salary'),
            'profile' => Yii::t('app', 'Profile'),
            'maritalStatus_idMaritalStatus' => Yii::t('app', 'Marital Status Id Marital Status'),
            'cities_idCity' => Yii::t('app', 'City'),
            'statusResumes_idStatusResume' => Yii::t('app', 'Status Resumes Id Status Resume'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['resumes_idResume' => 'idResume']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducations()
    {
        return $this->hasMany(Education::className(), ['resumes_idResume' => 'idResume']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitiesIdCity()
    {
        return $this->hasOne(Cities::className(), ['idCity' => 'cities_idCity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaritalStatusIdMaritalStatus()
    {
        return $this->hasOne(Maritalstatus::className(), ['idMaritalStatus' => 'maritalStatus_idMaritalStatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusResumesIdStatusResume()
    {
        return $this->hasOne(Statusresumes::className(), ['idStatusResume' => 'statusResumes_idStatusResume']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['resumes_idResume' => 'idResume']);
    }

    // Custom relations
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Sections::className(), ['resumes_idResume' => 'idResume'])->andOnCondition(['typeSection_idtypeSection' => '1']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAchievements()
    {
        return $this->hasMany(Sections::className(), ['resumes_idResume' => 'idResume'])->andOnCondition(['typeSection_idtypeSection' => '2']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHobbies()
    {
        return $this->hasMany(Sections::className(), ['resumes_idResume' => 'idResume'])->andOnCondition(['typeSection_idtypeSection' => '3']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterests()
    {
        return $this->hasMany(Sections::className(), ['resumes_idResume' => 'idResume'])->andOnCondition(['typeSection_idtypeSection' => '4']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferences()
    {
        return $this->hasMany(Sections::className(), ['resumes_idResume' => 'idResume'])->andOnCondition(['typeSection_idtypeSection' => '5']);
    }                

    public function getCompositeName(){
        return $this->suffix." ".$this->firstName." ".$this->middleName." ".$this->lastName;
    }

    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}
