<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Авторизация';

?>

<h1 id="pagetitle">Авторизация</h1>

<?php $form = ActiveForm::begin() ?>

<?=$form->field($login_model, 'email')->textInput(['placeholder' => 'Введите свой E-mail'])->label(false)?>

<?=$form->field($login_model, 'password')->passwordInput(['placeholder' => 'Введите свой пароль'])->label(false)?>

<div class="row login">
    <div class="col-md-3">
        <?=Html::submitButton('Войти', ['class' => 'btn btn-success'])?>
    </div>
    <div class="col-md-3 link">
        <?=Html::a('Зарегистироваться', ['cabinet/signup'])?>
    </div>
    <div class="col-md-3 link">
        <?=Html::a('Востановить пароль', ['cabinet/restore'])?>
    </div>
</div>

<?php ActiveForm::end(); ?>
