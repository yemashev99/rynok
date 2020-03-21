<?php


namespace backend\controllers;


use common\models\Category;
use common\models\Menu;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{

    public function actionIndex()
    {
        $model = Menu::findOne(['controller_name' => Yii::$app->controller->id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['about/index']);
            }
        }
        return $this->render('index', compact('model'));
    }

    public function actionControl()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $model = Category::findOne(['url' => $path[1]]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['about/index']);
            }
        }
        return $this->render('control', compact('model'));
    }

    public function actionGallery()
    {
        return $this->render('gallery');
    }
}