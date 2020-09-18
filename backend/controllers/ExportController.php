<?php


namespace backend\controllers;


use backend\models\Export1C;
use common\models\Cart;
use common\models\Category;
use common\models\Customer;
use common\models\Order;
use common\models\Product;
use yii\web\Controller;

class ExportController extends Controller
{
    public function actionDownload($offers = false)
    {
        $model = new Export1C();
        $products = Product::find()->all();
        $categories = Category::find()->all();
        if ($offers)
        {
            $orders = Order::getNewOrders();
        } else {
            $orders = null;
        }
        try {
            $model->export($products, $orders, $categories);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function actionTest()
    {
        $model = Product::find()->all();
        foreach ($model as $item)
        {
            if (is_null($item->count))
            {
                $item->count = 1;
                $item->save();
            }
        }
        return true;
    }
}