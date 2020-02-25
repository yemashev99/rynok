<?php


namespace backend\controllers;


use common\models\SubCategory;
use common\models\Menu;
use common\models\Category;
use himiklab\sortablegrid\SortableGridAction;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

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
                'pageSize' => 10,
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
                'pageSize' => 9,
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

            $file = UploadedFile::getInstance($category, 'file');

            if ($category->save())
            {
                $category->saveImage($category->uploadImage($file));
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

            $file = UploadedFile::getInstance($category, 'file');

            if ($category->save())
            {
                $category->saveImage($category->uploadImage($file));
                $this->redirect(['menu/category', 'id' => $category->menu_id]);
            }
        }
        return $this->render('category-update', compact('menu', 'category'));
    }

    public function actionSubCategory($id)
    {
        $category = Category::findOne($id);
        $menu = Menu::findOne($category->menu_id);
        $dataProvider = new ActiveDataProvider([
            'query' => SubCategory::find()
                ->where('category_id = :id', [
                    ':id' => $id,
                ]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('sub-category', compact('dataProvider', 'menu', 'category'));
    }

    public function actionSubCategoryCreate($id)
    {
        $category = Category::findOne($id);
        $menu = Menu::findOne($category->menu_id);
        $subCategory = new SubCategory();
        if ($subCategory->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($subCategory, 'file');

            if ($subCategory->save())
            {
                $subCategory->saveImage($category->uploadImage($file));
                $this->redirect(['menu/sub-category', 'id' => $id]);
            }
        }
        return $this->render('sub-category-create', compact('menu', 'category', 'subCategory'));
    }

    public function actionSubCategoryUpdate($id)
    {
        $subCategory = SubCategory::findOne($id);
        $category = Category::findOne($subCategory->category_id);
        $menu = Menu::findOne($category->menu_id);
        if ($subCategory->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($subCategory, 'file');

            if ($subCategory->save())
            {
                $subCategory->saveImage($category->uploadImage($file));
                $this->redirect(['menu/sub-category', 'id' => $subCategory->category_id]);
            }
        }
        return $this->render('sub-category-update', compact('menu', 'category', 'subCategory'));
    }
}