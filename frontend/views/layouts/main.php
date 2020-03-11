<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Menu;
use common\models\Category;
use common\models\Product;
use frontend\models\ProductSearch;
use kartik\typeahead\Typeahead;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

AppAsset::register($this);

//search product
$data = Product::searchItem();
$productSearchModel = new ProductSearch();


$menuItems = Menu::find()->orderBy('sort')->all();
$navItems = array();
foreach ($menuItems as $key => $menuItem)
{
    if ($menuItem->controller_name == 'catalog') {
        $navItems[] = [
            'label' => $menuItem->title,
            'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'linkOptions' => [
                'style' => 'padding-left: 79px; padding-right: 78px',
            ],
            'options' => [
                'class' => 'catalog icons_fa',
            ],
        ];
    } else {
        $navItems[] = [
            'label' => $menuItem->title,
            'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'linkOptions' => [
                'style' => 'padding-left: 29px; padding-right: 30px',
            ],
        ];
    }
}
$menu = new Menu();
$sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName(Yii::$app->controller->id)])->all();
$navSideItems = array();
foreach ($sidebarItems as $key => $sidebarItem)
{
    $navSideItems[] = [
        'label' => $sidebarItem->title,
        'url' => Url::to(['catalog/category', 'category' => $sidebarItem->url]),
        'linkOptions' => [
            'class' => 'icons_fa',
        ],
        'options' => [
            'class' => 'item',
        ],
    ];
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php Pjax::begin() ?>
<div class="wrapper front_page basket_fly colored banner_auto">
<span id="gray-fon">
    <div class="header_wrap ">
        <header id="header">
            <div class="wrapper_inner">
                <div class="top_br"></div>
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
                            </td>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="call_order">
                                                <a href="#">Заказать звонок</a>  
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
                                                    <b>+7 (913) 441-14-85</b><br>
                                                    телефон доставки<br>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="catalog_menu menu_colored">
                <div class="wrapper_inner">
                    <div class="wrapper_middle_menu wrap_menu" style="overflow: visible;">
                        <ul class="menu adaptive">
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
                                <?= Nav::widget([
                                    'options' => ['class' => 'mobile_menu'],
                                    'items' => $navItems,
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="wraps" id="content" style="min-height: 542.344px;">
        <div class="wrapper_inner front">
            <div class="left_block">
                <?= Nav::widget([
                    'options' => ['class' => 'left_menu'],
                    'items' => $navSideItems,
                ]) ?>
                <?/*TODO: news*/?>
                <div class="news_blocks front">
                    <div class="top_block">
                        <div class="title_block">Новости</div>
                        <a data="/catalog/" href="/o-rynke/novosti/">Все новости</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="info_block">
                        <div class="news_items">
                            <div id="bx_3218110189_2225" class="item box-sizing dl">
                                <div class="image">
                                    <a href="/o-rynke/novosti/2020/vnimanie_3_fevralya_na_rynke_san_den/">
                                        <img class="img-responsive" src="/upload/resize_cache/iblock/72e/60_60_2/САНИТАРНЫЙ ДЕНЬ КВАДРАТ.jpg" alt="Внимание! 3 февраля на рынке сан.день!" title="Внимание! 3 февраля на рынке сан.день!">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="date">31 Января 2020</div>
                                    <a class="name dark_link" href="/o-rynke/novosti/2020/vnimanie_3_fevralya_na_rynke_san_den/">Внимание! 3 февраля на рынке сан.день!</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bx_3218110189_2224" class="item box-sizing dl">
                                <div class="image">
                                    <a href="/o-rynke/novosti/2020/pozdravlyaem_/">
                                        <img class="img-responsive" src="/upload/resize_cache/iblock/e63/60_60_2/Шилов.png" alt="Поздравляем! " title="Поздравляем! ">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="date">9 Января 2020</div>
                                    <a class="name dark_link" href="/o-rynke/novosti/2020/pozdravlyaem_/">Поздравляем! </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bx_3218110189_2223" class="item box-sizing dl">
                                <div class="image">
                                    <a href="/o-rynke/novosti/2019/izmenilis_usloviya_dostavki/">
                                        <img class="img-responsive" src="/upload/resize_cache/iblock/248/60_60_2/1.jpg" alt="Изменились условия доставки!" title="Изменились условия доставки!">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="date">27 Декабря 2019</div>
                                    <a class="name dark_link" href="/o-rynke/novosti/2019/izmenilis_usloviya_dostavki/">Изменились условия доставки!</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right_block">
                <?=
                Breadcrumbs::widget(
                    [
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
                ) ?>
                <?=$content?>
            </div>
        </div>
    </div>
</span>
</div>
<?php Pjax::end() ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
