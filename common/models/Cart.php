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
 * @property int $customer_id
 * @property int $product_id
 * @property int $quantity
 * @property string $comment
 * @property string $payed
 * @property int $created_at
 * @property int $updated_at
 * @property int $order_status_id
 *
 * @property Customer $customer
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
            [['customer_id', 'product_id', 'quantity', 'payed'], 'required'],
            [['customer_id', 'product_id', 'quantity', 'order_status_id'], 'integer'],
            [['comment'], 'string', 'max' => 255],
            [['payed'], 'string', 'max' => 1],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
            [['order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['order_status_id' => 'order_status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => 'Cart ID',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'quantity' => 'Количество',
            'comment' => 'Комментарий',
            'payed' => 'Payed',
            'created_at' => 'Создан',
            'updated_at' => 'Updated At',
        ];
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
        $count = Cart::find()->where(['customer_id' => $id, 'order_status_id' => 1])->count();
        return $count;
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

    public static function cartPrice($id, $admin = null, $status = null)
    {
        if (is_null($admin))
        {
            $cartItems = Cart::find()
                ->where([
                    'customer_id' => $id,
                    'order_status_id' => 1
                ])
                ->all();
        } else {
            $cartItems = Cart::find()
                ->where([
                    'customer_id' => $id,
                    'order_status_id' => $status
                ])
                ->all();
        }

        $total = 0;
        foreach ($cartItems as $cartItem)
        {
            $total += $cartItem->quantity * $cartItem->product->price;
        }
        $total = number_format($total, 0, '.', ' ');
        return $total;
    }

    public function sendOrderLinkToMail()
    {
        $result = Yii::$app->mailer->compose()
            ->setFrom('noreply-rynok19@mail.ru')
            ->setTo('resp.rynok19@gmail.com')
            ->setSubject('Новый заказ!')
            ->setHtmlBody('TEST1TEST111')
            ->send();
        return $result;
    }

    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['order_status_id' => 'order_status_id']);
    }
}
