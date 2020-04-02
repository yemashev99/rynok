<?php


namespace frontend\controllers;


use common\models\Category;
use common\models\Tenants;
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
}