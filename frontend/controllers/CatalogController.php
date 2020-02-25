<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Menu;
use common\models\Product;
use common\models\SubCategory;
use Yii;
use yii\web\Controller;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $menuModel = new Menu(); $categoryModel = new Category();
        $menu = Menu::findOne(['controller_name' => Yii::$app->controller->id]);
        $categories = Category::find()
            ->where(['menu_id' => $menuModel->getIdByControllerName(Yii::$app->controller->id)])
            ->all();
        return $this->render('index', compact('categories', 'menu', 'categoryModel'));
    }

    public function actionCategory($category)
    {
        $category = Category::findOne(['url' => $category]);
        $subCategories = SubCategory::find()
            ->where(['category_id' => $category->category_id])
            ->all();
        return $this->render('category', compact('subCategories', 'category'));
    }

    public function actionItem($category, $subCategory)
    {
        $category = Category::findOne(['url' => $category]);
        $subCategory = SubCategory::findOne(['url' => $subCategory]);
        return $this->render('item', compact('category', 'subCategory'));
    }
}