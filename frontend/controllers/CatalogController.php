<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Menu;
use common\models\Product;
use common\models\SubCategory;
use frontend\models\CartForm;
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

        $cartForm = new CartForm();
        if (Yii::$app->request->post())
        {
            $cartForm->attributes = Yii::$app->request->post('CartForm');
            if ($cartForm->validate() && $cartForm->save())
            {
                return $this->redirect(['catalog/item', 'category' => $category, 'subCategory' => $subCategory, 'display' => $display]);
            }
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
            'pageSize' => 24,
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

        return $this->render('item', compact('category', 'subCategory', 'products', 'display', 'orderBy', 'sort', 'pages', 'cartForm'));
    }

    public function actionSearch($sort = null, $display = 'block', $orderBy = SORT_ASC, $search = null)
    {
        if (Yii::$app->request->post())
        {
            $search = Yii::$app->request->post();
            $search = $search["ProductSearch"]["product"];
        }

        if ($search)
        {

            switch ($orderBy) {
                case 'asc':
                    $orderBy = SORT_ASC;
                    break;
                case 'desc':
                    $orderBy = SORT_DESC;
            }

            $query = Product::find()->where(['like', 'title', $search]);

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

            return $this->render('search', compact('products', 'display', 'orderBy', 'sort', 'pages', 'search'));
        }
        return $this->redirect(['catalog/index']);
    }
}