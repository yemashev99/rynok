<?php


namespace frontend\controllers;


use common\models\Callback;
use common\models\Tenants;
use common\models\TenantsDoc;
use Yii;
use yii\web\Controller;

class TenantsController extends Controller
{
    public function actionIndex()
    {
        $tenants = Tenants::find()->orderBy(['tenants_id' => SORT_DESC])->all();
        return $this->render('index', compact('tenants'));
    }

    public function actionContent($tenant)
    {
        $object = Tenants::findOne(['url' => $tenant]);
        return $this->render('content', compact('object'));
    }

    public function actionDocs()
    {
        $firstDocs = TenantsDoc::find()->orderBy(['doc_id' => SORT_ASC])->limit(2)->all();
        $secondDocs = TenantsDoc::find()->orderBy(['doc_id' => SORT_ASC])->offset(2)->all();
        return $this->render('docs', compact('firstDocs', 'secondDocs'));
    }

    public function actionCallback()
    {
        $callback = new Callback();
        if ($callback->load(Yii::$app->request->post()))
        {
            $callback->date = date('d-m-Y');
            $callback->processed = 'N';
            $callback->type = 'rent';
            if ($callback->save())
            {
                return $this->redirect(['tenants/index']);
            }
        }
        return $this->render('callback', compact('callback'));
    }
}