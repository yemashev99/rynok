<?php


namespace backend\models;


use backend\models\User;
use yii\base\Model;

class Signup extends Model
{
    public $login;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['login', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'backend\models\User'],
            ['login', 'string'],
            ['password', 'string', 'min' => 3, 'max' => 21],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->login = $this->login;
        $user->email = $this->email;
        $user->setPassword($this->password);
        return $user->save();
    }
}