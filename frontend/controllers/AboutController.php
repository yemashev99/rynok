<?php


namespace frontend\controllers;



use common\models\Category;
use common\models\Gallery;
use common\models\GalleryItem;
use common\models\Menu;
use common\models\News;
use Yii;
use yii\web\Controller;

class AboutController extends Controller
{
    public function actionIndex()
    {
        $menu = Menu::findOne(['controller_name' => Yii::$app->controller->id]);
        return $this->render('index', compact('menu'));
    }

    public function actionControl()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $control = Category::findOne(['url' => $path[1]]);
        return $this->render('control', compact('control'));
    }

    public function actionNews()
    {
        $newsItems = News::find()->orderBy(['news_id' => SORT_DESC])->all();
        $path = explode('/', Yii::$app->request->pathInfo);
        $category = Category::findOne(['url' => $path[1]]);
        return $this->render('news', compact('newsItems', 'category'));
    }

    public function actionNewsContent($news)
    {
        $news = News::findOne(['url' => $news]);
        $path = explode('/', Yii::$app->request->pathInfo);
        $category = Category::findOne(['url' => $path[1]]);
        return $this->render('news-content', compact('news', 'category'));
    }

    public function actionGallery()
    {
        $galleryItems = Gallery::find()->orderBy(['gallery_id' => SORT_DESC])->all();
        $path = explode('/', Yii::$app->request->pathInfo);
        $category = Category::findOne(['url' => $path[1]]);
        return $this->render('gallery', compact('galleryItems', 'category'));
    }

    public function actionGalleryContent($item)
    {
        $gallery = Gallery::findOne(['url' => $item]);
        $path = explode('/', Yii::$app->request->pathInfo);
        $category = Category::findOne(['url' => $path[1]]);
        $items = GalleryItem::find()->where(['gallery_id' => $gallery->gallery_id])->all();
        return $this->render('gallery-content', compact('gallery', 'category', 'items'));
    }

    public function actionManufacturers()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $manufacturers = Category::findOne(['url' => $path[1]]);
        return $this->render('manufacturers', compact('manufacturers'));
    }
}