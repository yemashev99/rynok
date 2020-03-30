<?php
namespace frontend\controllers;

use common\models\FirstPageGallery;
use common\models\Menu;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $gallery = FirstPageGallery::find()->orderBy(['sort' => SORT_ASC])->all();
        return $this->render('index', compact('gallery'));
    }
}
