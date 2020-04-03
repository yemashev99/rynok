<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Menu;
use Yii;
use yii\web\Controller;

class DeliveryController extends Controller
{
    public function actionIndex()
    {
        $menu = Menu::findOne(['controller_name' => Yii::$app->controller->id]);
        return $this->render('index', compact('menu'));
    }

    public function actionPayment()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $payment = Category::findOne(['url' => $path[1]]);
        return $this->render('payment', compact('payment'));
    }

    public function actionTerms()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $terms = Category::findOne(['url' => $path[1]]);
        return $this->render('terms', compact('terms'));
    }

    public function actionWarranty()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $category = Category::findOne(['url' => $path[1]]);
        return $this->render('warranty', compact('category'));
    }

    public function actionReturn()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $category = Category::findOne(['url' => $path[1]]);
        return $this->render('warranty', compact('category'));
    }
}