<?php


namespace frontend\controllers;


use frontend\models\Login;
use frontend\models\Signup;
use Yii;
use yii\web\Controller;

class CabinetController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['cabinet/login']);
        }

        return $this->render('index');
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $login_model = new Login();

        if (Yii::$app->request->post())
        {
            $login_model->attributes = Yii::$app->request->post('Login');

            if($login_model->validate())
            {
                Yii::$app->user->login($login_model->getCustomer());
                return $this->redirect(['cabinet/index']);
            }
        }

        return $this->render('login', compact('login_model'));
    }

    public function actionSignup()
    {
        $model = new Signup();

        if (Yii::$app->request->post())
        {
            $model->attributes = Yii::$app->request->post('Signup');

            if ($model->validate() && $model->signup())
            {
                return $this->redirect(['cabinet/login']);
            }
        }

        return $this->render('signup', compact('model'));
    }
}