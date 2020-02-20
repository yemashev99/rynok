<?php


namespace frontend\controllers;


use yii\web\Controller;

class DeliveryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}