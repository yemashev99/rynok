<?php


namespace frontend\controllers;


use common\models\Holiday;
use Yii;
use yii\base\Controller;

class HolidaysController extends Controller
{
    public function actionIndex()
    {
        $holiday = Holiday::find()->orderBy(['holiday_id' => SORT_DESC])->all();
        return $this->render('index', compact('holiday'));
    }

    public function actionContent()
    {
        $path = explode('/', Yii::$app->request->pathInfo);
        $object = Holiday::findOne(['url' => $path[1]]);
        return $this->render('content', compact('object'));
    }
}