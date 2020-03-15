<?php

use common\models\Cart;
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
            <div class="form_title">
                <h3>Ваша корзина</h3>
            </div>
            <div class="bx-basket bx-blue bx-step-opacity" style="opacity: 1;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="basket-checkout-container">
                            <div class="basket-checkout-section">
                                <div class="basket-checkout-section-inner">
                                    <div class="basket-checkout-block basket-checkout-block-total">
                                        <div class="basket-checkout-block-total-inner">
                                            <div class="basket-checkout-block-total-title">
                                                Итого:
                                            </div>
                                            <div class="basket-checkout-block-total-description">
                                                Сумма НДС: 0 ₽
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basket-checkout-block basket-checkout-block-total-price">
                                        <div class="basket-checkout-block-total-price-inner">
                                            <div class="basket-coupon-block-total-price-current">
                                                <?=$total?> ₽
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basket-checkout-block basket-checkout-block-btn">
                                        <button class="btn btn-lg btn-default basket-btn-checkout">
                                            Оформить заказ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="basket-items-list-wrapper basket-items-list-wrapper-height-fixed">
                            <div class="basket-items-list-header">
                                <div class="basket-items-list-header-filter">
                                    <a class="basket-items-list-header-filter-item active">В корзине <?=count($cartItems)?> <?=Cart::declensionWords(count($cartItems))?></a>
                                </div>
                            </div>
                            <div class="basket-items-list-container">
                                <table class="basket-items-list-table">
                                    <tbody>
                                        <?php foreach ($cartItems as $cartItem) : ?>
                                            <tr class="basket-items-list-item-container">
                                                <td class="basket-items-list-item-descriptions">
                                                    <div class="basket-items-list-item-descriptions-inner">
                                                        <div class="basket-item-block-image">
                                                            <a href="" class="basket-item-image-link">
                                                                <?=Html::img(Yii::getAlias('@web').'/'.$cartItem->product->image, [
                                                                        'class' => 'basket-item-image',
                                                                        'alt' => $cartItem->product->title
                                                                ])?>
                                                            </a>
                                                        </div>
                                                        <div class="basket-item-block-info">
                                                            <span class="basket-item-actions-remove visible-xs"></span>
                                                            <h2 class="basket-item-info-name">
                                                                <?=Html::a('<span>'.$cartItem->product->title.'</span>', '#', ['class' => 'basket-item-info-name-link'])?>
                                                            </h2>
                                                            <div class="basket-item-block-properties">
                                                                <div class="basket-item-property-custom basket-item-property-custom-text">
                                                                    <div class="basket-item-property-custom-name">
                                                                        Тип цены
                                                                    </div>
                                                                    <div class="basket-item-property-custom-value">
                                                                        Розничная цена
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="basket-items-list-item-price basket-items-list-item-price-for-one hidden-xs">
                                                    <div class="basket-item-block-price">
                                                        <div class="basket-item-price-current">
                                                            <span class="basket-item-price-current-text">
                                                                <?=$cartItem->product->price?> ₽
                                                            </span>
                                                        </div>
                                                        <div class="basket-item-price-title">
                                                            цена за 1 <?=$cartItem->product->measure?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="basket-items-list-item-amount">
                                                    <div class="basket-item-block-amount">
                                                        <?=Html::a('', ['cabinet/down', 'product_id' => $cartItem->product_id], ['class' => 'basket-item-amount-btn-minus'])?>
                                                        <div class="basket-item-amount-filed-block">
                                                            <?=Html::input('text', 'quantity', $cartItem->quantity, ['class' => 'basket-item-amount-filed', 'readonly' => 'readonly'])?>
                                                        </div>
                                                        <?=Html::a('', ['cabinet/up', 'product_id' => $cartItem->product_id], ['class' => 'basket-item-amount-btn-plus'])?>
                                                        <div class="basket-item-amount-field-description">
                                                            <?=$cartItem->product->measure?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="basket-items-list-item-price">
                                                    <div class="basket-item-block-price">
                                                        <div class="basket-item-price-current">
                                                            <span class="basket-item-price-current-text">
                                                               <?=Cart::totalProduct($cartItem->quantity, $cartItem->product->price)?> ₽
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="basket-items-list-item-remove hidden-xs">
                                                    <div class="basket-item-block-actions">
                                                        <?=Html::a('', ['cabinet/delete', 'product_id' => $cartItem->product_id], ['class' => 'basket-item-actions-remove'])?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="content2">
        <div class="my-tabs-tab">
            <div class="form_title">
                <h3>Все заказы</h3>
            </div>
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