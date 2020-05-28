<?php


namespace frontend\controllers;


use common\models\Cart;
use common\models\Customer;
use common\models\Order;
use common\models\OrderStatus;
use frontend\models\Login;
use frontend\models\Signup;
use Yii;
use yii\web\Controller;

class CabinetController extends Controller
{
    public function actionIndex($cabinet = 'cart')
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['cabinet/login']);
        }

        $customer = Customer::findOne(['customer_id' => Yii::$app->user->identity->customer_id]);

        if ($customer->load(Yii::$app->request->post()))
        {
            if ($customer->save())
            {
                return $this->redirect(['cabinet/index']);
            }
        }

        $order = Order::getOrder(Yii::$app->user->identity->customer_id);
        if ($order) {
            $cartItems = Cart::find()
                ->where(['order_id' => $order->order_id])
                ->all();
        } else {
            $cartItems = [];
        }
        $ordersInProcessing = Order::getOrder(Yii::$app->user->identity->customer_id, 'new');
        if ($ordersInProcessing)
        {
            $inProcessingCartItems = Cart::find()
                ->where(['order_id' => $ordersInProcessing->order_id])
                ->all();
        } else {
            $inProcessingCartItems = null;
        }
        $ordersDone = Order::getOrder(Yii::$app->user->identity->customer_id, 'done');
        if ($ordersDone)
        {
            $doneCartItems = Cart::find()
                ->where(['order_id' => $ordersDone->order_id])
                ->all();
        } else {
            $doneCartItems = null;
        }

        return $this->render('index', compact('customer', 'cartItems', 'cabinet', 'inProcessingCartItems', 'doneCartItems'));
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['cabinet/login']);
        }
    }

    public function actionLogin($from = null, $category = null, $subCategory = null, $item = null, $display = 'block')
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $login_model = new Login();

        if (Yii::$app->request->post())
        {
            $login_model->attributes = Yii::$app->request->post('Login');

            if($login_model->validate())
            {
                Yii::$app->user->login($login_model->getCustomer());
                if(!is_null($from) && !is_null($item))
                {
                    return $this->redirect(['catalog/view', 'category' => $category, 'subCategory' => $subCategory, 'item' => $item]);
                } elseif(!is_null($from)){
                    return $this->redirect(['catalog/item', 'display' => $display, 'category' => $category, 'subCategory' => $subCategory]);
                } else {
                    return $this->redirect(['cabinet/index']);
                }
            }
        }

        return $this->render('login', compact('login_model'));
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new Signup();

        if (Yii::$app->request->post())
        {
            $model->attributes = Yii::$app->request->post('Signup');

            if ($model->validate() && $model->signup())
            {
                return $this->redirect(['cabinet/login']);
            }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionDelete($product_id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        $cartItem = Cart::findOne([
            'product_id' => $product_id,
            'customer_id' => Yii::$app->user->identity->customer_id,
            'order_status_id' => 1
        ]);
        $cartItem->delete();
        return $this->redirect(['cabinet/index']);
    }

    public function actionDown($product_id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $cartItem = Cart::findOne([
            'product_id' => $product_id,
            'customer_id' => Yii::$app->user->identity->customer_id,
            'order_status_id' => 1
        ]);

        $quantity = $cartItem->quantity;
        if ($quantity > 1)
        {
            $quantity--;
            $cartItem->quantity = $quantity;

            if ($cartItem->save())
            {
                //return $quantity;
                return $this->redirect(['cabinet/index']);
            }
        } else {
            $this->actionDelete($product_id);
        }
        return false;
    }

    public function actionUp($product_id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $cartItem = Cart::findOne([
            'product_id' => $product_id,
            'customer_id' => Yii::$app->user->identity->customer_id,
            'order_status_id' => 1
        ]);

        $quantity = $cartItem->quantity;
        $quantity++;
        $cartItem->quantity = $quantity;

        if ($cartItem->save())
        {
            //return $quantity;
            return $this->redirect(['cabinet/index']);
        }
    }

    public function actionSaveComment($comment, $product_id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $cartItem = Cart::findOne([
            'product_id' => $product_id,
            'customer_id' => Yii::$app->user->identity->customer_id,
            'order_status_id' => 1
        ]);
        $cartItem->comment = $comment;
        $cartItem->save();
    }

    public function actionOrder()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        return $this->render('send');
    }

    public function actionSendMail()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $order = Order::getOrder(Yii::$app->user->identity->customer_id);
        if ($order)
        {
            $order->order_status_id = OrderStatus::getStatusIdByTitle('new');
            $order->save();
        } else {
            return false;
        }

        $model = new Cart();
        if($model->sendOrderLinkToMail())
        {
            return $this->redirect(['cabinet/order']);
        }
        return false;
    }
}