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
use yii\web\Controller;

class CatalogController extends Controller
{
    public function actionIndex()
    {
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
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', compact('category', 'sortForm', 'subCategory', 'dataProvider'));
    }

    public function actionList($id)
    {
        $count = SubCategory::find()
            ->where(['category_id' => $id])
            ->count();
        $subCategories = SubCategory::find()
            ->where(['category_id' => $id])
            ->all();
        if ($count > 0)
        {
            echo '<option>Выберете подкатегорию</option>';
            foreach ($subCategories as $subCategory)
            {
                echo "<option value='".$subCategory->sub_category_id."'>".$subCategory->title."</option>";
            }
        } else {
            echo '<option>-</option>';
        }
    }

    public function actionCreate()
    {
        $model = new Product();
        $menu = new Menu();
        $category = ArrayHelper::map(
            Category::find()
                ->where('menu_id = :id', [
                    ':id' => $menu->getIdByControllerName(Yii::$app->controller->id)
                ])
                ->all(), 'category_id', 'title');
        $subCategory = [];
        return $this->render('create', compact('model', 'category', 'subCategory'));
    }
}