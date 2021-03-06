<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public function rules()
    {
        return [
            [['login', 'email'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'backend\models\User'],
            ['login', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'Код',
            'login' => 'Логин',
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
}
