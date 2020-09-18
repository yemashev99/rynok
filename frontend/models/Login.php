<?php


namespace frontend\models;


use common\models\Customer;
use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getCustomer();

            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Пароль или пользователь введены неверно');
            }
        }
    }

    public function getCustomer()
    {
        return Customer::findOne(['email'=>$this->email]);
    }
}