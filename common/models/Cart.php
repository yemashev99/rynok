<?php

namespace common\models;

use common\models\Customer;
use common\models\Product;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cart".
 *
 * @property int $cart_id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property string $comment
 *
 * @property Order $order
 * @property Product $product
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity'], 'required'],
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['comment'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => 'Cart ID',
            'order_id' => 'Номер заказа',
            'product_id' => 'Product ID',
            'quantity' => 'Количество',
            'comment' => 'Комментарий'
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }

    public static function totalProduct($quantity, $price)
    {
        return number_format($quantity * $price, 0, '.', ' ');
    }

    public static function declensionWords($n)
    {
        $words = ['товар', 'товара', 'товаров'];
        return ($words[($n=($n=$n%100)>19?($n%10):$n)==1?0 : (($n>1&&$n<=4)?1:2)]);
    }

    public static function productCount($id)
    {
        $order = Order::getOrder($id);
        if ($order) {
            $count = Cart::find()->where(['order_id' => $order->order_id])->count();
            return $count;
        }
        return null;
    }

    public static function inCart($id)
    {
        $count = Cart::productCount($id);
        if ($count > 0)
        {
            return true;
        } else {
            return false;
        }
    }

    public static function cartPrice($id, $admin = null, $status = null, $deliveryPrice = null)
    {
        if (is_null($admin))
        {
            $order = Order::getOrder($id);
            if ($order)
            {
                $cartItems = Cart::find()
                    ->where([
                        'order_id' => $order->order_id
                    ])
                    ->all();
            } else {
                $cartItems = null;
            }
        } else {
            $order = Order::getOrder($id, $status);
            if ($order)
            {
                $cartItems = Cart::find()
                    ->where([
                        'order_id' => $order->order_id
                    ])
                    ->all();
            } else {
                $cartItems = null;
            }
        }

        $total = 0;
        if (!is_null($cartItems))
        {
            foreach ($cartItems as $cartItem)
            {
                $total += $cartItem->quantity * $cartItem->product->price;
            }
        }

        if (is_null($deliveryPrice))
        {
            $total = number_format($total, 0, '.', ' ');
        } else {
            $total += 200;
            $total = number_format($total, 0, '.', ' ');
        }
        return $total;
    }

    public function sendOrderLinkToMail()
    {
        $result = Yii::$app->mailer->compose()
            ->setFrom('noreply-rynok19@yandex.ru')
            ->setTo('resp.rynok19@gmail.com')
            ->setSubject('Новый заказ!')
            ->setHtmlBody('TEST1TEST111')
            ->send();
        return $result;
    }

    public static function getCartItems($order_id)
    {
        return $items = Cart::find()->where(['order_id' => $order_id])->all();
    }
}
