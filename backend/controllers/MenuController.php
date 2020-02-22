<?php


namespace backend\controllers;


use common\models\Menu;
use common\models\Category;
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

    public function actionCategory($id)
    {
        $menu = Menu::findOne($id);
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()
                ->where('menu_id = :id', [
                    ':id' => $id,
                ]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('category', compact('dataProvider', 'menu'));
    }

    public function actionCategoryCreate($id)
    {
        $menu = Menu::findOne($id);
        $category = new Category();
        if ($category->load(Yii::$app->request->post()))
        {
            if ($category->save())
            {
                $this->redirect(['menu/category', 'id' => $id]);
            }
        }
        return $this->render('category-create', compact('menu', 'category'));
    }

    public function actionCategoryUpdate($id)
    {
        $category = Category::findOne($id);
        $menu = Menu::findOne($category->menu_id);
        if ($category->load(Yii::$app->request->post()))
        {
            if ($category->save())
            {
                $this->redirect(['menu/category', 'id' => $category->menu_id]);
            }
        }
        return $this->render('category-update', compact('menu', 'category'));
    }
}