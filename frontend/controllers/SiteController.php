<?php
namespace frontend\controllers;

use common\models\FirstPageGallery;
use common\models\FirstPageIcon;
use common\models\News;
use yii\web\Controller;

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
        $icons = FirstPageIcon::find()->orderBy(['first_page_icon_id' => SORT_ASC])->all();
        $newsItems = News::find()->orderBy(['news_id' => SORT_DESC])->limit(6)->all();
        return $this->render('index', compact('gallery', 'newsItems', 'icons'));
    }
}
