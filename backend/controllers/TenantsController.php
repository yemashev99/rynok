<?php


namespace backend\controllers;


use backend\models\TenantsSearch;
use common\models\Tenants;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class TenantsController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $searchModel = new TenantsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new Tenants();
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
                return $this->redirect(['tenants/index']);
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
        $model = Tenants::findOne(['tenants_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }

                return $this->redirect(['tenants/index']);
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
        $model = Tenants::findOne(['tenants_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->save())
            {
                return $this->redirect(['tenants/index']);
            }
        }
        return $this->render('content', compact('model'));
    }
}