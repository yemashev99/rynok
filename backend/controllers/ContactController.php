<?php


namespace backend\controllers;


use common\models\Menu;
use Yii;
use yii\web\Controller;

class ContactController extends Controller
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
                return $this->redirect(['contact/index']);
            }
        }
        return $this->render('index', compact('model'));
    }
}