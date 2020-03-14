<?php


namespace frontend\models;


use common\models\Customer;
use yii\base\Model;

class Signup extends Model
{
    public $email;
    public $password;
    public $fio;
    public $postcode;
    public $address;
    public $phone;
    public $personalData;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'fio', 'address', 'phone'], 'required'],
            [['email', 'password', 'fio', 'address'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 9],
            [['phone'], 'string', 'max' => 20],
            ['personalData', 'integer',
                'when' => function () {
                    if ($this->personalData == 0){
                        $this->addError('personalData', 'Необходимо дать согласие на обработку персональных данных.');
                    }
                }
            ],
            ['email', 'unique', 'targetClass' => 'common\models\Customer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'email' => 'Email',
            'password' => 'Пароль',
            'fio' => 'Ф.И.О.',
            'postcode' => 'Индекс',
            'address' => 'Адрес',
            'phone' => 'Контактный телефон',
        ];
    }

    public function signup()
    {
        $customer = new Customer();
        $customer->email = $this->email;
        $customer->setPassword($this->password);
        $customer->fio = $this->fio;
        $customer->postcode = $this->postcode;
        $customer->address = $this->address;
        $customer->phone = $this->phone;
        return $customer->save();
    }
}