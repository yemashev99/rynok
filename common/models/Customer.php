<?php

namespace common\models;

use common\models\Cart;
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
            [['password', 'fio', 'address'], 'string', 'max' => 255],
            ['email', 'email'],
            [['postcode'], 'string', 'max' => 9],
            [['phone'], 'string', 'max' => 20],
            ['email', 'unique', 'targetClass' => 'common\models\Customer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Код клиента',
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

    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['customer_id' => 'customer_id']);
    }

    public static function getNewOrders()
    {
        $orders = Customer::find()
            ->join("INNER JOIN", "cart", "cart.customer_id = customer.customer_id")
            ->where('cart.order_status_id = 2')
            ->orderBy('cart.created_at')
            ->all();
        return $orders;
    }
}
