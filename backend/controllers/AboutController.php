<?php


namespace backend\controllers;


use backend\models\GallerySearch;
use backend\models\ManufacturersSearch;
use backend\models\NewsSearch;
use common\models\Category;
use common\models\Gallery;
use common\models\GalleryItem;
use common\models\Manufacturer;
use common\models\Menu;
use common\models\News;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class AboutController extends Controller
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
                return $this->redirect(['about/index']);
            }
        }
        return $this->render('index', compact('model'));
    }

    public function actionControl()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $path = explode('/', Yii::$app->request->pathInfo);
        $model = Category::findOne(['url' => $path[1]]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['about/control']);
            }
        }
        return $this->render('control', compact('model'));
    }

    public function actionManufacturers()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $searchModel = new ManufacturersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('manufacturers', compact('dataProvider', 'searchModel'));
    }

    public function actionManufacturersCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new Manufacturer();
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');
            $model->date = date('d.m.Y');

            if ($model->save())
            {
                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }
                return $this->redirect(['about/manufacturers']);
            }
        }
        return $this->render('manufacturers-create', compact('model'));
    }

    public function actionManufacturersUpdate($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Manufacturer::findOne(['manufacturer_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }

                return $this->redirect(['about/manufacturers']);
            }
        }
        return $this->render('manufacturers-update', compact('model'));
    }

    public function actionManufacturersContent($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Manufacturer::findOne(['manufacturer_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['about/manufacturers']);
            }
        }
        return $this->render('manufacturers-content', compact('model'));
    }

    public function actionNews()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('news', compact('dataProvider', 'searchModel'));
    }

    public function actionNewsCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new News();
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');
            $model->date = date('d.m.Y');

            if ($model->save())
            {
                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }
                return $this->redirect(['about/news']);
            }
        }
        return $this->render('news-create', compact('model'));
    }

    public function actionNewsUpdate($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = News::findOne(['news_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }

                return $this->redirect(['about/news']);
            }
        }
        return $this->render('news-update', compact('model'));
    }

    public function actionNewsContent($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = News::findOne(['news_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['about/news']);
            }
        }
        return $this->render('news-content', compact('model'));
    }

    public function actionGallery()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('gallery', compact('dataProvider', 'searchModel'));
    }

    public function actionGalleryCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new Gallery();
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {
                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }
                return $this->redirect(['about/gallery']);
            }
        }
        return $this->render('gallery-create', compact('model'));
    }

    public function actionGalleryUpdate($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Gallery::findOne(['gallery_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }

                return $this->redirect(['about/gallery']);
            }
        }
        return $this->render('gallery-update', compact('model'));
    }

    public function actionGalleryContent($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Gallery::findOne(['gallery_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['about/gallery']);
            }
        }
        $query = GalleryItem::find()->where(['gallery_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11
            ],
            'sort' => [
                'defaultOrder' => ['gallery_item_id' => SORT_DESC]
            ]
        ]);
        return $this->render('gallery-content', compact('model', 'dataProvider'));
    }

    public function actionGalleryItemCreate($id, $type)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new GalleryItem();
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveContent($model->uploadImage($file));
                }

                return $this->redirect(['about/gallery-content', 'id' => $id]);
            }
        }
        $gallery = Gallery::findOne(['gallery_id' => $id]);
        return $this->render('gallery-item-create', compact('model', 'gallery', 'type'));
    }

    public function actionGalleryItemUpdate($id, $type, $item_id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = GalleryItem::findOne(['gallery_item_id' => $item_id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveContent($model->uploadImage($file));
                }

                return $this->redirect(['about/gallery-content', 'id' => $id]);
            }
        }
        $gallery = Gallery::findOne(['gallery_id' => $id]);
        return $this->render('gallery-item-update', compact('model', 'gallery', 'type'));
    }

    public function action1Floor()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        return $this->render('1-floor');
    }

    public function action2Floor()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        return $this->render('2-floor');
    }
}