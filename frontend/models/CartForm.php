<?php


namespace frontend\models;


use common\models\Cart;
use common\models\Customer;
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
        $cart = new Cart();
        $cart->customer_id = $this->customer_id;
        $cart->product_id = $this->product_id;
        $cart->quantity = $this->quantity;
        $cart->payed = $this->payed;
        $cart->order_status_id = $this->order_status_id;
        $cart->comment = $this->comment;
        return $cart->save();
    }

}