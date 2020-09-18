<?php


namespace backend\controllers;


use backend\models\CallbackSearch;
use common\models\Callback;
use Yii;
use yii\web\Controller;

class CallbackController extends Controller
{
    public function actionIndex($type)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $searchModel = new CallbackSearch($type);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('dataProvider', 'searchModel', 'type'));
    }

    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Callback::findOne(['callback_id' => $id]);
        if ($model->delete())
        {
            $this->redirect(['callback/index']);
        }
        return false;
    }

    public function actionProcessed($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $model = Callback::findOne(['callback_id' => $id]);
        $model->processed = "Y";
        if ($model->save())
        {
            $this->redirect(['callback/'.$model->type]);
        }
        return false;
    }
}