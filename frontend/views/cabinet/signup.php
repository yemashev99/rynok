<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Регистрация';

?>

<h1 id="pagetitle">Регистрация</h1>

<?php $form = ActiveForm::begin() ?>
<div class="form_title">
    <h3>Данные для входа</h3>
</div>

<?=$form->field($model, 'email')->textInput(['placeholder' => 'E-mail *'])->label(false)?>

<?=$form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль *'])->label(false)?>

<div class="form_title" style="margin-top: 5%">
    <h3>Контактные данные</h3>
</div>

<?=$form->field($model, 'fio')->textInput(['placeholder' => 'Ф.И.О. *'])->label(false)?>

<?=$form->field($model, 'postcode')->textInput(['placeholder' => 'Индекс'])->label(false)?>

<?=$form->field($model, 'address')->textInput(['placeholder' => 'Адрес *'])->label(false)?>

<?=$form->field($model, 'phone')->textInput(['placeholder' => 'Контактный телефон *'])->label(false)?>

<?=$form->field($model, 'personalData')->checkbox(['label' => ' Нажимая на кнопку, вы даете согласие на обработку своих персональных данных'])?>

<?=Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end(); ?>
