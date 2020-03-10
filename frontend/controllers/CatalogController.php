<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Menu;
use common\models\Product;
use common\models\SubCategory;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
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

    public function actionItem($category, $subCategory, $sort = null, $display = 'block', $orderBy = SORT_ASC)
    {
        if (Yii::$app->request->post())
        {
            var_dump(Yii::$app->request->post()); exit();
        }

        switch ($orderBy) {
            case 'asc':
                $orderBy = SORT_ASC;
                break;
            case 'desc':
                $orderBy = SORT_DESC;
        }

        $category = Category::findOne(['url' => $category]);
        $subCategory = SubCategory::findOne(['url' => $subCategory]);
        $query = Product::find()
            ->where(['category_id' => $category->category_id])
            ->andWhere(['sub_category_id' => $subCategory->sub_category_id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 20,
            'pageSizeParam' => false,
            'forcePageParam' => false,
        ]);
        if (is_null($sort))
        {
            $products = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        } else {
            $products = $query->orderBy([$sort => $orderBy])
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        }

        $item = Product::find()->all();

        return $this->render('item', compact('category', 'subCategory', 'products', 'display', 'orderBy', 'sort', 'pages', 'item'));
    }
}