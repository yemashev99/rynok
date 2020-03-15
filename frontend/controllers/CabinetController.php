<?php


namespace frontend\controllers;


use common\models\Cart;
use common\models\Customer;
use frontend\models\Login;
use frontend\models\Signup;
use Yii;
use yii\web\Controller;

class CabinetController extends Controller
{
    public function actionIndex()
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

        $cartItems = Cart::find()
            ->where([
                'customer_id' => Yii::$app->user->identity->customer_id,
                'payed' => 'N'
            ])
            ->all();

        $total = 0;
        foreach ($cartItems as $cartItem)
        {
            $total += $cartItem->quantity * $cartItem->product->price;
        }
        $total = number_format($total, 0, '.', ' ');

        return $this->render('index', compact('customer', 'cartItems', 'total'));
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['cabinet/login']);
        }
    }

    public function actionLogin($from = null, $category = null, $subCategory = null, $display = 'block')
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
                if(!is_null($from))
                {
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
            'payed' => 'N'
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
            'payed' => 'N'
        ]);

        $quantity = $cartItem->quantity;
        if ($quantity > 1)
        {
            $quantity--;
            $cartItem->quantity = $quantity;

            if ($cartItem->save())
            {
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
            'payed' => 'N'
        ]);

        $quantity = $cartItem->quantity;
        $quantity++;
        $cartItem->quantity = $quantity;

        if ($cartItem->save())
        {
            return $this->redirect(['cabinet/index']);
        }
    }
}