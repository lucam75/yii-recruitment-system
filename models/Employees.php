<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $idEmployee
 * @property string $name
 * @property string $login
 * @property string $pass
 * @property int $roles_idRol
 *
 * @property Changelogstatus[] $changelogstatuses
 * @property Roles $rolesIdRol
 */
class Employees extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'login', 'pass', 'roles_idRol'], 'required'],
            [['roles_idRol'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['login', 'pass'], 'string', 'max' => 45],
            [['roles_idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['roles_idRol' => 'idRol']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEmployee' => Yii::t('app', 'Id Employee'),
            'name' => Yii::t('app', 'Name'),
            'login' => Yii::t('app', 'Login'),
            'pass' => Yii::t('app', 'Pass'),
            'roles_idRol' => Yii::t('app', 'Roles Id Rol'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangelogstatuses()
    {
        return $this->hasMany(Changelogstatus::className(), ['employees_idEmployee' => 'idEmployee', 'employees_roles_idRol' => 'roles_idRol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesIdRol()
    {
        return $this->hasOne(Roles::className(), ['idRol' => 'roles_idRol']);
    }


    // Methods related to Indentity
    public static function findIdentity($idEmployee){
        return static::findOne($idEmployee);
    }
 
    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }

    public function getId(){
        return $this->idEmployee;
    }
 
    public function getIdEmployee(){
        return $this->idEmployee;
    }
 
    public function getAuthKey(){
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }
 
    public function validateAuthKey($authKey){
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }
    public static function findByUsername($login){
        return self::findOne(['login'=>$login]);
    }
    public static function findById($id){
        return self::findOne(['idEmployee'=>$id]);
    }
 
    public function validatePassword($pass){
        return $this->pass === sha1($pass);
    }
}
