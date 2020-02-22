<?php
namespace frontend\controllers;

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
        $menu = Menu::find()->all();
        return $this->render('index', compact('menu'));
    }
}
