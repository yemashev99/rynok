<?php


namespace backend\controllers;


use backend\models\OrderSearch;
use common\models\Cart;
use common\models\Customer;
use common\models\OrderStatus;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionNew()
    {

        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'new');
        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($id, $status, $action = null)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $customer = Customer::findOne(['customer_id' => $id]);

        switch ($status)
        {
            case 'new':
                $query = Cart::find()->where(['customer_id' => $id, 'order_status_id' => 2]);
                break;
            case 'delivered':
                $query = Cart::find()->where(['customer_id' => $id, 'order_status_id' => 3]);
                break;
            case 'done':
                $query = Cart::find()->where(['customer_id' => $id, 'order_status_id' => 4]);
                break;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11
            ],
        ]);
        if(!is_null($action))
        {
            $orders = $query->all();
            foreach ($orders as $order)
            {
                $order->order_status_id = OrderStatus::getStatusIdByTitle($action);
                $order->save();
            }
            return $this->redirect(['order/'.$action]);
        }
        return $this->render('view', compact('customer', 'dataProvider', 'status'));
    }

    public function actionDelivered()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'delivered');
        return $this->render('delivered', compact('dataProvider', 'searchModel'));
    }

    public function actionDone()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'done');
        return $this->render('done', compact('dataProvider', 'searchModel'));
    }
}