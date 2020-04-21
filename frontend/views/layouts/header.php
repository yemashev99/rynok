<?php

use common\models\FreePlace;
use frontend\models\Site;
use kartik\typeahead\Typeahead;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="header_wrap ">
    <header id="header">
        <div class="wrapper_inner">
            <div class="top_br">
                <table style="width: 100%;">
                    <tbody>
                    <tr class="header_info">
                        <td style="width: 28%">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            Республика Хакасия<br>Абакан, Тельмана, 92к
                        </td>
                        <td style="width: 20%">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <b>8 (800) 444-39-38</b><br>
                            телефон доставки<br>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <table class="middle-h-row">
                <tbody>
                <tr>
                    <td class="logo_wrapp" style="/*width:220px;*/display: block;text-align: center;">
                        <div class="logo nofill_y">
                            <a href='<?=Url::to(['site/index'])?>'>
                                <img src="<?=Yii::getAlias('@web').'/img/logo.png'?>" alt="РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК" title="РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК">
                            </a>
                            <a data="1" href="<?=Url::to(['site/index'])?>" class="logo-mobile">
                                <img src="<?=Yii::getAlias('@web').'/img/logo.png'?>" alt="РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК" title="РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК">
                            </a>
                        </div>
                    </td>
                    <td class="text_wrapp">
                        <div class="slogan">
                            <div class="h2" style="color: green; line-height: 1.15;">РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК</div>
                        </div>
                        <div class="rent-places">
                            <a href="<?=Url::to(['tenants/index'])?>" style="color: #888888;">Свободных мест для аренды: <span style="border-bottom: 1px dashed;"><?=FreePlace::getFreePlaces()?></span></a>
                        </div>
                    </td>
                    <td class="header_search">
                        <table>
                            <tbody>
                            <tr>
                                <td class="call_order">
                                    <a href="#" id="open-button">Заказать звонок</a>
                                </td>
                                <td>
                                    <div class="d1">
                                        <?php
                                        $template = '<div><p class="repo-language">{{price}}</p>' .
                                            '<p class="repo-name">{{title}}</p>' .
                                            '<p class="repo-description">{{description}}</p></div>';
                                        ?>
                                        <?php $form = ActiveForm::begin(['action' => Url::to(['catalog/search'])]) ?>
                                        <?=$form->field($productSearchModel, 'product')->widget(Typeahead::className(), [
                                            'name' => 'country_1',
                                            'options' => ['placeholder' => 'Поиск по товарам ...'],
                                            'scrollable' => true,
                                            'pluginOptions' => ['highlight'=>true],
                                            'dataset' => [
                                                [
                                                    'local' => $data,
                                                    'limit' => 10,
                                                    'templates' => [
                                                        'notFound' => '<div class="text-danger" style="padding:0 8px">Ничего не найдено.</div>',
                                                    ],
                                                ],
                                            ]
                                        ])->label(false)?>
                                        <?=Html::submitButton('', ['type' => 'submit'])?>
                                        <?php ActiveForm::end() ?>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="work-time">
                            <table style="width: 100%;">
                                <tbody>
                                <tr class="header_info">
                                    <td style="width: 20%">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        Ежедневно<br>09:00 - 19:00
                                    </td>
                                    <td style="width: 28%">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        Республика Хакасия<br>Абакан, Тельмана, 92к
                                    </td>
                                    <td style="width: 30%">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <b>8 (800) 444-39-38</b><br>
                                        телефон доставки<br>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <?php if(Site::isMobile()) :?>
                        <?php $cart = Site::count(); ?>
                        <td class="mobile-cart">
                            <a href="<?=Url::to(['cabinet/index'])?>" class="cart" style="display: inline;">
                                <p class="cart-img">
                                    <span class="count"><?=$cart['count']?></span>
                                </p>

                                <p class="cart-text">
                                    <span class="cart-title">Ваша корзина</span>
                                    <span> <span class="cart-sum"><?=$cart['price']?></span> руб.</span>
                                </p>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="catalog_menu menu_colored">
            <div class="wrapper_inner">
                <div class="wrapper_middle_menu wrap_menu" style="overflow: visible;">
                    <ul class="menu adaptive" id="mobile-menu" style="margin-bottom: 0px;">
                        <li class="menu_opener">
                            <div class="text">
                                Меню
                            </div>
                        </li>
                    </ul>
                    <div class="inc_menu">
                        <?= Nav::widget([
                            'options' => ['class' => 'menu top menu_top_block catalogfirst'],
                            'items' => $navItems,
                        ]) ?>
                        <div class="mobile_menu_wrapper">
                            <?= dmstr\widgets\Menu::widget([
                                'options' => ['class' => 'mobile_menu sidebar-menu tree', 'style' => 'display: none', 'data-widget' => 'tree'],
                                'items' => $mobileNavItems,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
