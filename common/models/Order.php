<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $order_id
 * @property int $customer_id
 * @property string $payed
 * @property int $order_status_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Cart[] $carts
 * @property Customer $customer
 * @property OrderStatus $orderStatus
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'payed', 'order_status_id'], 'required'],
            [['customer_id', 'order_status_id', 'created_at', 'updated_at'], 'integer'],
            [['payed'], 'string', 'max' => 1],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['order_status_id' => 'order_status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Номер заказа',
            'customer_id' => 'Customer ID',
            'payed' => 'Payed',
            'order_status_id' => 'Order Status ID',
            'created_at' => 'Дата заказа',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['order_id' => 'order_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[OrderStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['order_status_id' => 'order_status_id']);
    }

    public static function getOrder($id, $status = null)
    {
        if (is_null($status))
        {
            return Order::find()->where(['customer_id' => $id, 'payed' => 'N', 'order_status_id' => OrderStatus::getStatusIdByTitle('cart')])->one();
        } else {
            return Order::find()->where(['customer_id' => $id, 'payed' => 'N', 'order_status_id' => OrderStatus::getStatusIdByTitle($status)])->one();
        }
    }

    public static function getNewOrders()
    {
        return Order::find()->where(['order_status_id' => OrderStatus::getStatusIdByTitle('new')])->all();
    }
}
