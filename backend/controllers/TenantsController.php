<?php


namespace backend\controllers;


use backend\models\TenantsSearch;
use common\models\Tenants;
use common\models\TenantsDoc;
use Yii;
use yii\data\ActiveDataProvider;
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

    public function actionDocs()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => TenantsDoc::find(),
            'pagination' => [
                'pageSize' => 11
            ],
            'sort' => [
                'defaultOrder' => ['doc_id' => SORT_DESC]
            ]
        ]);
        return $this->render('docs', compact('dataProvider'));
    }

    public function actionDocCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new TenantsDoc();
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {
                if (!is_null($file))
                {
                    $model->saveFile($model->uploadFile($file, $model->title));
                }
                return $this->redirect(['tenants/docs']);
            }
        }
        return $this->render('doc-create', compact('model'));
    }

    public function actionDocUpdate($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = TenantsDoc::findOne(['doc_id' => $id]);
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {
                if (!is_null($file))
                {
                    $model->saveFile($model->uploadFile($file, $model->title));
                }
                return $this->redirect(['tenants/docs']);
            }
        }
        return $this->render('doc-update', compact('model'));
    }

    public function actionDocDelete($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = TenantsDoc::findOne(['doc_id' => $id]);
        if ($model->delete())
        {
            return $this->redirect(['tenants/docs']);
        }
    }
}