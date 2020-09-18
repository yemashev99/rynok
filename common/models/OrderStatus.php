<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_status".
 *
 * @property int $order_status_id
 * @property string $title
 *
 * @property Cart[] $carts
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_status_id' => 'Order Status ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['order_status_id' => 'order_status_id']);
    }

    public static function getStatusIdByTitle($status)
    {
        $id = OrderStatus::findOne(['status' => $status]);
        return $id->order_status_id;
    }
}
