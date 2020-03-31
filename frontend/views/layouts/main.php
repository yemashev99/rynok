<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Cart;
use common\models\Menu;
use common\models\Category;
use common\models\News;
use common\models\Product;
use frontend\models\ProductSearch;
use kartik\typeahead\Typeahead;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
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
switch (Yii::$app->controller->id) {
    case 'about':
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['about/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
}
$newsItems = News::find()->orderBy(['news_id' => SORT_DESC])->limit(3)->all();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
                <div id="main-left-0">
                    <b>
                        <a class="main-link" href="<?=Url::to(['about/gallery'])?>">Видео: ярмарки, производители, новости</a>
                    </b>
                </div>
                <div id="main-left-1">
                    <iframe width="195" height="110" src="https://www.youtube.com/embed/ppsYaWWtod8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                </div>
                <?/*TODO: news*/?>
                <?php if (!in_array('news', explode('/', Yii::$app->request->pathInfo))) : ?>
                    <div class="news_blocks front">
                        <div class="top_block">
                            <div class="title_block">Новости</div>
                            <a href="<?=Url::to(['about/news'])?>">Все новости</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="info_block">
                            <div class="news_items">
                                <?php foreach ($newsItems as $item) : ?>
                                    <div id="<?=$item->news_id?>" class="item box-sizing dl">
                                        <div class="image">
                                            <a href="<?=Url::to(['about/news-content', 'news' => $item->url])?>">
                                                <img class="img-responsive" src="<?=Yii::getAlias('@web').'/'.$item->image?>" alt="<?=$item->title?>" title="<?=$item->title?>">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <div class="date"><?=$item->date?></div>
                                            <a class="name dark_link" href="<?=Url::to(['about/news-content', 'news' => $item->url])?>"><?=$item->title?></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                 <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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

<footer id="footer">
    <div class="footer_inner no_fill">

        <div class="wrapper_inner">
            <div class="footer_bottom_inner">
                <div class="left_block">
                    <div class="copyright">
                        2020 © Рынок "Михайловский"</div>
                    <span class="pay_system_icons">
	<i title="MasterCard" class="mastercard"></i>
<i title="Visa" class="visa"></i>
<i title="Yandex" class="yandex_money"></i>
<i title="WebMoney" class="webmoney"></i>
<i title="Qiwi" class="qiwi"></i></span>
                    <div id="bx-composite-banner">
                        <a href="/policy/">Политика конфиденциальности</a>
                        <a href="/polzovatelskoe-soglashenie/">Пользовательское соглашение</a>
                        <div class="artena">
                            <span>Продвижение сайта</span>
                            <a href="https://www.artena.ru/" target="_blank" title="Продвижение сайта"><img src="/bitrix/templates/aspro_optimus/images/artena.png" alt="Продвижение сайта - Артена"></a>
                        </div>
                    </div>
                </div>
                <div class="right_block">
                    <div class="middle">
                        <div class="rows_block">
                            <div class="item_block col-75 menus">
                                <div class="submenu_top rows_block">
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="/o-rynke/" class="dark_link">О рынке</a></div>
                                    </div>
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="/arendatoram/" class="dark_link">Арендаторам</a></div>
                                    </div>
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="/kak-kupit/" class="dark_link">Как купить</a></div>
                                    </div>
                                </div>
                                <div class="rows_block">
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <li class="menu_item"><a href="/o-rynke/1-etazh/" class="dark_link">1 этаж</a></li>
                                            <li class="menu_item"><a href="/o-rynke/2-etazh/" class="dark_link">2 этаж</a></li>
                                            <li class="menu_item"><a href="/o-rynke/novosti/" class="dark_link">Новости</a></li>
                                            <li class="menu_item"><a href="/o-rynke/video/" class="dark_link">Видео</a></li>
                                            <li class="menu_item"><a href="/kontakti/sotrudniki/" class="dark_link">Сотрудники</a></li>
                                        </ul>											</div>
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <li class="menu_item"><a href="/arendatoram/arenda/" class="dark_link">Аренда</a></li>
                                            <li class="menu_item"><a href="/arendatoram/reklama/" class="dark_link">Реклама</a></li>
                                        </ul>											</div>
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <li class="menu_item"><a href="/kak-kupit/zakazat/" class="dark_link">Как заказать</a></li>
                                            <li class="menu_item"><a href="/kak-kupit/oplata/" class="dark_link">Как оплатить</a></li>
                                            <li class="menu_item"><a href="/kak-kupit/dostavka/" class="dark_link">Доставка продукции</a></li>
                                            <li class="menu_item"><a href="/kak-kupit/garantii/" class="dark_link">Гарантии</a></li>
                                            <li class="menu_item"><a href="/kak-kupit/vozvrat/" class="dark_link">Возврат товара</a></li>
                                        </ul>											</div>
                                </div>
                            </div>
                            <div class="item_block col-4 soc">
                                <div class="soc_wrapper">
                                    <div class="phones">
                                        <div class="phone_block">
													<span class="phone_wrap">
														<span class="icons fa fa-phone"></span>
														<span>
															<span style="font-size: 14pt;"><span><b>+7 (3452) 99-56-59</b></span></span><br>
 телефон доставки<br>
 <a style="font-size: 10pt; color: #7ba02e;" href="mailto:administrator@rynok72.ru">administrator@rynok72.ru</a>														</span>
													</span>
                                            <span class="order_wrap_btn">
														<span class="callback_btn">Заказать звонок</span>
													</span>
                                        </div>
                                    </div>
                                    <div class="social_wrapper">
                                        <div class="social">

                                            <div class="small_title">Мы в социальных сетях:</div>
                                            <div class="links rows_block soc_icons">
                                                <div class="item_block">
                                                    <a href="/go.php?url=https://vk.com/rynok_mikhaylovsky " target="_blank" title="ВКонтакте" class="vk"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="/go.php?url=https://ok.ru/profile/561006126537" target="_blank" title="Одноклассники" class="odn"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="/go.php?url=https://ru-ru.facebook.com/people/%D0%9D%D0%B8%D0%BA%D0%B8%D1%82%D0%B0-%D0%9C%D0%B8%D1%85%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2/100012609671202" target="_blank" title="Facebook" class="fb"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="/go.php?url=https://www.instagram.com/rynok_mikhaylovsky/" target="_blank" title="Instagram" class="inst"></a>
                                                </div>
                                            </div>												</div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile_copy">
                <div class="copyright">
                    2020 © Рынок "Михайловский"</div>
                <span class="pay_system_icons">
	<i title="MasterCard" class="mastercard"></i>
<i title="Visa" class="visa"></i>
<i title="Yandex" class="yandex_money"></i>
<i title="WebMoney" class="webmoney"></i>
<i title="Qiwi" class="qiwi"></i></span>					</div>
        </div>
    </div>
</footer>

<?php if(!Yii::$app->user->isGuest) :?>
    <?php if(Cart::inCart(Yii::$app->user->identity->customer_id)) : ?>
        <a href="<?=Url::to(['cabinet/index'])?>" class="cart floating" style="display: inline;">
            <p class="cart-img">
                <span class="count"><?=Cart::productCount(Yii::$app->user->identity->customer_id)?></span>
            </p>

            <p class="cart-text">
                <span class="cart-title">Ваша корзина</span>
                <span> <span class="cart-sum"><?=Cart::cartPrice(Yii::$app->user->identity->customer_id)?></span> руб.</span>
            </p>
        </a>
    <?php endif; ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
