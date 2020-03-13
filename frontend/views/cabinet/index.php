<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Личный кабинет';

?>

<h1 id="pagetitle">Личный кабинет</h1>

<main class="my-tabs">

    <input id="tab1" type="radio" name="tabs" checked>
    <label for="tab1">Ваша корзина</label>

    <input id="tab2" type="radio" name="tabs">
    <label for="tab2">Все заказы</label>

    <input id="tab3" type="radio" name="tabs">
    <label for="tab3">Контактные данные</label>

    <input id="tab4" type="radio" name="tabs">
    <label for="tab4">Данные для входа</label>

    <section id="content1">
        <div class="my-tabs-tab">
            Ваша корзина
        </div>
    </section>

    <section id="content2">
        <div class="my-tabs-tab">
            Все заказы
        </div>
    </section>

    <section id="content3">
        <div class="my-tabs-tab">
            <?php $form = ActiveForm::begin() ?>

            <div class="form_title">
                <h3>Контактные данные</h3>
            </div>

            <?=$form->field($customer, 'fio')->textInput(['placeholder' => 'Ф.И.О. *'])->label(false)?>

            <?=$form->field($customer, 'postcode')->textInput(['placeholder' => 'Индекс'])->label(false)?>

            <?=$form->field($customer, 'address')->textInput(['placeholder' => 'Адрес *'])->label(false)?>

            <?=$form->field($customer, 'phone')->textInput(['placeholder' => 'Контактный телефон *'])->label(false)?>

            <?=Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>

            <?php ActiveForm::end(); ?>
        </div>
    </section>

    <section id="content4">
        <div class="my-tabs-tab">
            <?php $form = ActiveForm::begin() ?>

            <div class="form_title">
                <h3>Данные для входа</h3>
            </div>

            <?=$form->field($customer, 'email')->textInput(['placeholder' => 'E-mail (логин)*'])->label(false)?>

            <?=$form->field($customer, 'password')->passwordInput(['placeholder' => 'Пароль *'])->label(false)?>

            <?=Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>

            <?php ActiveForm::end(); ?>
        </div>
    </section>

</main>