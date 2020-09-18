<?php


namespace backend\controllers;


use common\models\Category;
use common\models\Menu;
use Yii;
use yii\web\Controller;

class DeliveryController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Menu::findOne(['controller_name' => Yii::$app->controller->id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['delivery/index']);
            }
        }
        return $this->render('index', compact('model'));
    }

    public function actionPayment()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $path = explode('/', Yii::$app->request->pathInfo);
        $model = Category::findOne(['url' => $path[1]]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['delivery/payment']);
            }
        }
        return $this->render('payment', compact('model'));
    }

    public function actionTerms()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $path = explode('/', Yii::$app->request->pathInfo);
        $model = Category::findOne(['url' => $path[1]]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['delivery/terms']);
            }
        }
        return $this->render('terms', compact('model'));
    }

    public function actionWarranty()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $path = explode('/', Yii::$app->request->pathInfo);
        $model = Category::findOne(['url' => $path[1]]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['delivery/warranty']);
            }
        }
        return $this->render('warranty', compact('model'));
    }

    public function actionReturn()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $path = explode('/', Yii::$app->request->pathInfo);
        $model = Category::findOne(['url' => $path[1]]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['delivery/return']);
            }
        }
        return $this->render('return', compact('model'));
    }
}