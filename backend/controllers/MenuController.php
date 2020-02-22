<?php


namespace backend\controllers;


use common\models\Menu;
use himiklab\sortablegrid\SortableGridAction;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MenuController extends Controller
{

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Menu::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort'=> ['defaultOrder' => ['sort' => SORT_ASC]]
        ]);
        return $this->render('index', compact('dataProvider'));
    }

    public function actionUpdate($id)
    {
        $model = Menu::findOne($id);

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                $this->redirect(['menu/index']);
            }
        }

        return $this->render('update', compact('model'));
    }
}