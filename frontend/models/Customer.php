<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property string $email
 * @property string $password
 * @property string $fio
 * @property string $postcode
 * @property string $address
 * @property string $phone
 */
class Customer extends ActiveRecord implements IdentityInterface
{

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
            ['email', 'unique', 'targetClass' => 'frontend\models\Customer'],
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
        return $this->customer_id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
}
