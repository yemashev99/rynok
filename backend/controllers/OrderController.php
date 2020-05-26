<?php


namespace backend\controllers;


use backend\models\OrderPrint;
use backend\models\OrderSearch;
use backend\models\Receipt;
use common\models\Cart;
use common\models\Customer;
use common\models\OrderStatus;
use Dompdf\Dompdf;
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

    public function actionPrint($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $customer = Customer::findOne(['customer_id' => $id]);
        $count = Receipt::find()->count() + 1;
        $items = Cart::find()->where(['customer_id' => $id, 'order_status_id' => 2])->all();
        $content = $this->renderPartial('_reportView', compact('customer', 'count', 'items'));
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
        $receipt = new Receipt();
        $receipt->customer = $customer->fio;
        if ($receipt->save())
        {
            return $pdf->render();
        }
    }
}