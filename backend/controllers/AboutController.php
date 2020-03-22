<?php


namespace backend\controllers;


use backend\models\NewsSearch;
use common\models\Category;
use common\models\Menu;
use common\models\News;
use Yii;
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
        return $this->render('gallery');
    }
}