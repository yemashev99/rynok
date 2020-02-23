<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Menu;
use Yii;
use yii\web\Controller;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $menu = new Menu;
        $categories = Category::find()
            ->where(['menu_id' => $menu->getIdByControllerName(Yii::$app->controller->id)])
            ->all();
        return $this->render('index', compact('categories'));
    }
}