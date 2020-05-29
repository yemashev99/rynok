<?php


namespace backend\controllers;


use backend\models\OrderSearch;
use common\models\Cart;
use common\models\Customer;
use common\models\Order;
use common\models\OrderStatus;
use kartik\mpdf\Pdf;
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
        $order = Order::getOrder($id, $status); //получени заказа
        if ($order)
        {
            $query = Cart::find()->where(['order_id' => $order->order_id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11
            ],
        ]);
        if(!is_null($action))
        {
            $order->order_status_id = OrderStatus::getStatusIdByTitle($action);
            $order->save();
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

    public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $order = Order::getOrder($id, 'new');
        $items = Cart::find()->where(['order_id' => $order->order_id])->all();
        $content = $this->renderPartial('_reportView', compact('order', 'items'));
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_BLANK,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [

            ]
        ]);
        return $pdf->render();
    }
}