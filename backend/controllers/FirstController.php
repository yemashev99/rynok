<?php


namespace backend\controllers;


use common\models\FirstPageGallery;
use richardfan\sortable\SortableAction;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class FirstController extends Controller
{

    public function actions(){
        return [
            'sortItem' => [
                'class' => SortableAction::className(),
                'activeRecordClassName' => FirstPageGallery::className(),
                'orderColumn' => 'sort',
            ],
            // your other actions
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => FirstPageGallery::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'=> ['defaultOrder' => ['sort' => SORT_ASC]]
        ]);
        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = new FirstPageGallery();
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'file');

            if ($model->save())
            {

                if (!is_null($file))
                {
                    $model->saveImage($model->uploadImage($file));
                }

                return $this->redirect(['first/index']);
            }
        }
        return $this->render('create', compact('model'));
    }
}