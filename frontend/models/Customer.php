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
