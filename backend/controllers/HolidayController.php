<?php


namespace backend\controllers;


use backend\models\HolidaySearch;
use common\models\Holiday;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class HolidayController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $searchModel = new HolidaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new Holiday();
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
                return $this->redirect(['holiday/index']);
            }
        }
        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Holiday::findOne(['holiday_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }

                return $this->redirect(['holiday/index']);
            }
        }
        return $this->render('update', compact('model'));
    }

    public function actionContent($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Holiday::findOne(['holiday_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['holiday/index']);
            }
        }
        return $this->render('content', compact('model'));
    }
}