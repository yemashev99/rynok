<?php


namespace frontend\models;


use common\models\Cart;
use common\models\Customer;
use common\models\Order;
use common\models\OrderStatus;
use common\models\Product;
use yii\base\Model;

class CartForm extends Model
{

    public $customer_id;
    public $product_id;
    public $quantity;
    public $payed = 'N';
    public $order_status_id = 1;
    public $comment = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'quantity', 'order_status_id'], 'integer'],
            [['payed'], 'string', 'max' => 1],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
            [['order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['order_status_id' => 'order_status_id']],
        ];
    }

    public function save()
    {
        $order_id = $this->getOrder($this->customer_id);
        if ($order_id)
        {
            $cart = new Cart();
            $cart->order_id = $order_id;
            $cart->product_id = $this->product_id;
            $cart->quantity = $this->quantity;
            $cart->comment = $this->comment;
            return $cart->save();
        }
        return false;
    }

    private function getOrder($customer_id)
    {
        $order = Order::find()
            ->where(['customer_id' => $customer_id])
            ->andWhere(['payed' => 'N'])
            ->andWhere(['order_status_id' => OrderStatus::getStatusIdByTitle('cart')])
            ->one();
        if ($order)
        {
            return $order->order_id;
        } else {
            $model = new Order();
            $model->customer_id = $this->customer_id;
            $model->payed = $this->payed;
            $model->order_status_id = $this->order_status_id;
            if ($model->save())
            {
                return $model->order_id;
            }
        }
        return false;
    }

}