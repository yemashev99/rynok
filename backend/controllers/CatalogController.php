<?php


namespace backend\controllers;


use backend\models\SortForm;
use common\models\Category;
use common\models\Menu;
use common\models\Product;
use common\models\SubCategory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class CatalogController extends Controller
{
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        //сортировка по категориям
        $menu = new Menu();
        $sortForm = new SortForm();
        $category = ArrayHelper::map(
            Category::find()
                ->where('menu_id = :id', [
                    ':id' => $menu->getIdByControllerName(Yii::$app->controller->id)
                ])
                ->all(), 'category_id', 'title');
        $subCategory = [];

        //вывод товаров
        if (Yii::$app->request->post())
        {
            $sortForm->attributes = Yii::$app->request->post('SortForm');
            if (empty($sortForm->subCategoryId))
            {
                $query = Product::find()
                    ->where(['category_id' => $sortForm->categoryId]);
            } else {
                $query = Product::find()
                    ->where(['category_id' => $sortForm->categoryId])
                    ->andWhere(['sub_category_id' => $sortForm->subCategoryId]);
            }
        } else {
            $query = Product::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('category', 'sortForm', 'subCategory', 'dataProvider'));
    }

    public function actionList($id)
    {

        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $count = SubCategory::find()
            ->where(['category_id' => $id])
            ->count();
        $subCategories = SubCategory::find()
            ->where(['category_id' => $id])
            ->all();
        if ($count > 0)
        {
            echo '<option value="">Выберете подкатегорию</option>';
            foreach ($subCategories as $subCategory)
            {
                echo "<option value='".$subCategory->sub_category_id."'>".$subCategory->title."</option>";
            }
        } else {
            echo '<option value="">-</option>';
        }
    }

    public function actionCreate()
    {

        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $model = new Product();
        $menu = new Menu();
        $category = ArrayHelper::map(
            Category::find()
                ->where('menu_id = :id', [
                    ':id' => $menu->getIdByControllerName(Yii::$app->controller->id)
                ])
                ->all(), 'category_id', 'title');
        $subCategory = [];
        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {
                $model->saveImage($model->uploadImage($file));
                return $this->redirect(['catalog/index']);
            }
        }
        return $this->render('create', compact('model', 'category', 'subCategory'));
    }

    public function actionUpdate($id)
    {

        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }

        $model = Product::findOne(['product_id' => $id]);
        $menu = new Menu();
        $category = ArrayHelper::map(
            Category::find()
                ->where('menu_id = :id', [
                    ':id' => $menu->getIdByControllerName(Yii::$app->controller->id)
                ])
                ->all(), 'category_id', 'title');
        $subCategory = [];
        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {
                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }
                return $this->redirect(['catalog/index']);
            }
        }
        return $this->render('update', compact('model', 'category', 'subCategory'));
    }
}