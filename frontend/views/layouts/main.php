<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Callback;
use common\models\Cart;
use common\models\FreePlace;
use common\models\Menu;
use common\models\Category;
use common\models\News;
use common\models\Product;
use frontend\models\ProductSearch;
use frontend\models\Site;
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
$navItems = array(); $mobileNavItems = array();
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
        $mobileNavItems[] = [
            'label' => $menuItem->title,
            'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'options' => [
                'class' => 'icons_fa has-child ',
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
        $mobileNavItems[] = [
            'label' => $menuItem->title,
            'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
        ];
    }
}
$menu = new Menu();
$sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName(Yii::$app->controller->id)])->orderBy(['sort' => SORT_ASC])->all();
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
        $navSideItems = array();
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
    case 'delivery':
        $navSideItems = array();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['delivery/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
    case 'cabinet':
        $navSideItems = array();
        $sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName('catalog')])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['catalog/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
    case 'tenants':
        $navSideItems = array();
        $sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName('tenants')])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['tenants/'.$sidebarItem->url]),
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
//callback
$callback = new Callback();
if ($callback->load(Yii::$app->request->post()))
{
    $callback->date = date('d-m-Y');
    $callback->processed = 'N';
    $callback->type = 'call';
    $callback->save();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=78db9fac-117a-4f46-be71-9a815e9d8b17" type="text/javascript"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper front_page basket_fly colored banner_auto">
<span id="gray-fon">
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
                                <?= Nav::widget([
                                    'options' => ['class' => 'mobile_menu', 'style' => 'display: none'],
                                    'items' => $mobileNavItems,
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
                                            <div class="info-text"><a class="name dark_link" href="<?=Url::to(['about/news-content', 'news' => $item->url])?>"><?=$item->title?></a></div>
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

<footer id="footer">
    <div class="footer_inner no_fill">

        <div class="wrapper_inner">
            <div class="footer_bottom_inner">
                <div class="left_block">
                    <div class="copyright">
                        <?=date('Y')?> © Республиканский рынок</div>
                    <div id="bx-composite-banner">
                        <a href="/policy/">Политика конфиденциальности</a>
                        <a href="/polzovatelskoe-soglashenie/">Пользовательское соглашение</a>
                    </div>
                </div>
                <div class="right_block">
                    <div class="middle">
                        <div class="rows_block">
                            <div class="item_block col-75 menus">
                                <div class="submenu_top rows_block">
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="<?=Url::to(['about/index'])?>" class="dark_link">О рынке</a></div>
                                    </div>
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="<?=Url::to(['tenants/index'])?>" class="dark_link">Арендаторам</a></div>
                                    </div>
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="<?=Url::to(['delivery/index'])?>" class="dark_link">Как купить</a></div>
                                    </div>
                                </div>
                                <div class="rows_block">
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <?php foreach ($about = Category::find()->where(['menu_id' => $menu->getIdByControllerName('about')])->orderBy(['sort' => SORT_ASC])->all() as $item) : ?>
                                                <li class="menu_item"><a href="<?=Url::to(['about/'.$item->url])?>" class="dark_link"><?=$item->title?></a></li>
                                            <?php endforeach; ?>
                                        </ul>											</div>
                                    <div class="item_block col-3"></div>
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <?php foreach ($about = Category::find()->where(['menu_id' => $menu->getIdByControllerName('delivery')])->orderBy(['sort' => SORT_ASC])->all() as $item) : ?>
                                                <li class="menu_item"><a href="<?=Url::to(['delivery/'.$item->url])?>" class="dark_link"><?=$item->title?></a></li>
                                            <?php endforeach; ?>
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
															<span style="font-size: 14pt;"><span><b>8 (800) 444-39-38</b></span></span><br>
 телефон доставки<br>
 <a style="font-size: 10pt; color: #7ba02e;" href="mailto:administrator@rynok72.ru">direkciya2011@yandex.ru</a>														</span>
													</span>
                                            <span class="order_wrap_btn">
														<span class="callback_btn" id="open-button1">Заказать звонок</span>
													</span>
                                        </div>
                                    </div>
                                    <div class="social_wrapper">
                                        <div class="social">

                                            <div class="small_title">Мы в социальных сетях:</div>
                                            <div class="links rows_block soc_icons">
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="ВКонтакте" class="vk"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="Одноклассники" class="odn"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="Facebook" class="fb"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="Instagram" class="inst"></a>
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
                    <?=date('Y')?> © Республиканский Рынок</div>
                <span class="pay_system_icons">
	<i title="MasterCard" class="mastercard"></i>
<i title="Visa" class="visa"></i>
<i title="Yandex" class="yandex_money"></i>
<i title="WebMoney" class="webmoney"></i>
<i title="Qiwi" class="qiwi"></i></span>					</div>
        </div>
    </div>
</footer>

<?php if(!Site::isMobile()) :?>
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
<?php endif; ?>

<div class="modal-overlay closed" id="modal-overlay"></div>

<div class="popup modal closed" id="modal" aria-hidden="true" aria-labelledby="modalTitle" aria-describedby="modalDescription" role="dialog">
    <a href="#" class="close" id="close-button"><i></i></a>
    <div class="modal-guts" role="document">
        <label class="form CALLBACK" style="width: 385px;">
            <!--noindex-->
            <div class="form_head">
                <h2>Заказать звонок</h2>
            </div>

            <?php $form = ActiveForm::begin() ?>

            <div class="form_body">
                <?=$form->field($callback, 'name')->textInput()->label('<span>Ваше имя&nbsp;<span class="star">*</span></span>')?>

                <?=$form->field($callback, 'phone')->textInput()->label('<span>Телефон&nbsp;<span class="star">*</span></span>')?>

                <div class="clearboth"></div>
                <div class="clearboth"></div>

            </div>

            <div class="form_footer">
                <?=Html::submitButton('Отправить', ['class' => 'button medium ff'])?>

                <?=Html::resetButton('<span>Закрыть</span>', ['class' => 'button medium transparent', 'id' => 'reset'])?>
            </div>

            <?php ActiveForm::end() ?><!--/noindex-->
        </label>
    </div>
</div>

<script>
    var modal = document.querySelector("#modal"),
        modalOverlay = document.querySelector("#modal-overlay"),
        closeButton = document.querySelector("#close-button"),
        openButton = document.querySelector("#open-button"),
        openButton1 = document.querySelector("#open-button1"),
        resetButton = document.querySelector("#reset");

    closeButton.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    resetButton.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    openButton.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    openButton1.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    $(document).ready(function () {
        $('#mobile-menu').on('click',function () {
            if($('.mobile_menu').css('display') == 'none')
            {
                $('.mobile_menu').css({display: 'block'});
            } else {
                $('.mobile_menu').css({display: 'none'});
            }
        });
    });

</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
