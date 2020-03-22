<?php


namespace frontend\controllers;



use common\models\Category;
use common\models\Menu;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{
    public function actionIndex()
    {
        $menu = Menu::findOne(['controller_name' => Yii::$app->controller->id]);
        return $this->render('index', compact('menu'));
    }

    public function actionControl()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $control = Category::findOne(['url' => $path[1]]);
        return $this->render('control', compact('control'));
    }
}