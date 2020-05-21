<?php


namespace backend\controllers;


use backend\models\Export1C;
use common\models\Customer;
use common\models\Product;
use yii\web\Controller;

class ExportController extends Controller
{
    public function actionDownload($offers = false)
    {
        $model = new Export1C();
        $products = Product::find()->all();
        $orders = null;
        if ($offers)
        {
            $orders = Customer::getNewOrders();
        }
        try {
            $model->export($products, $orders);
        } catch (\Exception $e) {
            return false;
        }
    }
}