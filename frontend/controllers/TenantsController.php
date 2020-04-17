<?php


namespace frontend\controllers;


use common\models\Tenants;
use common\models\TenantsDoc;
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

    }
}