<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
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

<div class="wrapper front_page basket_fly colored banner_auto">
    <div class="header_wrap ">
        <header id="header">
            <div class="wrapper_inner">
                <div class="top_br"></div>
                <table class="middle-h-row">
                    <tbody>
                        <tr>
                            <td class="logo_wrapp" style="/*width:220px;*/display: block;text-align: center;">
                                <div class="logo nofill_y">
                                    <a>
                                        <img src="<?=Yii::getAlias('@web').'/img/logo1.png'?>" alt="Рынок Михайловский" title="Рынок Михайловский">
                                    </a>
                                    <a data="1" href="" class="logo-mobile">
                                        <img src="<?=Yii::getAlias('@web').'/img/logo-mobile.png'?>" alt="Рынок Михайловский" title="Рынок Михайловский">
                                    </a>
                                </div>
                            </td>
                            <td class="text_wrapp">
                                <div class="slogan" style="line-height: 1;">
                                    <div class="h2">Рынок свежих продуктов</div>
                                </div>
                                <div class="center_block">
                                    <div class="search">
                                        <div id="title-search" class="stitle_form">
                                            <form action="/search/">
                                                <div class="form-control1 bg">
                                                    <input id="title-searchs-input" type="text" name="q" value="" size="40" class="text small_block" maxlength="100" autocomplete="off" placeholder="Поиск по товарам"><input name="s" type="submit" value="Поиск" class="button icon">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="best">
                                <img src="<?=Yii::getAlias('@web').'/img/the-best-market.png'?>" alt="Лучший розничный рынок России">
                            </td>
                            <td class="revizorro">
                                <img src="<?=Yii::getAlias('@web').'/img/elenaletuchaya_002.png'?>" alt="Проверка Ревизорро">
                            </td>
                            <td class="basket_wrapp">
                                <div class="middle_phone">
                                    <div class="phones">
												<span class="phone_wrap">
													<span class="phone">
														<span class="icons fa fa-phone"></span>
														<span class="phone_text">
															<span style="font-size: 14pt;">
                                                                <span>
                                                                    <b>+7 (3452) 99-56-59</b>
                                                                </span>
                                                            </span><br>
                                                            телефон доставки<br>
                                                            <a style="font-size: 10pt; color: #7ba02e;" href="mailto:administrator@rynok72.ru">administrator@rynok72.ru</a>
                                                        </span>
														<span class="address">г. Тюмень, ул. Федюнинского, 55</span>
													</span>
													<span class="order_wrap_btn">
														<span class="callback_btn">Заказать звонок</span>
													</span>
												</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="catalog_menu menu_colored">
                <div class="wrapper_inner">
<!--                    <div class="wrapper_middle_menu wrap_menu" style="overflow: visible;">-->
<!--                        <ul class="menu adaptive">-->
<!--                            <li class="menu_opener">-->
<!--                                <div class="text">-->
<!--                                    Меню-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                        <div class="catalog_menu_ext">-->
<!--                            <ul class="menu top menu_top_block catalogfirst">-->
<!--                                <li class="catalog icons_fa has-child ">-->
<!--                                    <a class="parent" href="/catalog/">Каталог</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div class="inc_menu">-->
<!--                            <ul class="menu top menu_top_block catalogfirst">-->
<!--                                <li class="  has-child">-->
<!--                                    <a class="icons_fa parent" href="/o-rynke/" style="padding-left: 34px; padding-right: 35px;">О рынке</a>-->
<!--                                </li>-->
<!--                                <li class="  has-child">-->
<!--                                    <a class="icons_fa parent" href="/kak-kupit/" style="padding-left: 34px; padding-right: 35px;">Доставка и оплата</a>-->
<!--                                </li>-->
<!--                                <li class="  has-child">-->
<!--                                    <a class="icons_fa parent" href="/arendatoram/" style="padding-left: 34px; padding-right: 35px;">Арендаторам</a>-->
<!--                                </li>-->
<!--                                <li class="  ">-->
<!--                                    <a class="" href="/retsepty/" style="padding-left: 34px; padding-right: 35px;">Рецепты</a>-->
<!--                                </li>-->
<!--                                <li class="  has-child">-->
<!--                                    <a class="icons_fa parent" href="/novyy-god/" style="padding-left: 34px; padding-right: 35px;">Новый год</a>-->
<!--                                </li><li class="  has-child">-->
<!--                                    <a class="icons_fa parent" href="/kontakti/" style="padding-left: 36px; padding-right: 37px;">Контакты</a>-->
<!--                            </ul>-->
<!--                            <div class="mobile_menu_wrapper">-->
<!--                                <ul class="mobile_menu">-->
<!--                                    <li class="icons_fa has-child ">-->
<!--                                        <a class="dark_link parent" href="/catalog/">Доставка товаров</a>-->
<!--                                        <ul class="dropdown">-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/">Доставка товаров</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/ryba/">Рыба</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/kolbasy_sosiski_delikatesy/">Колбасы, сосиски, деликатесы</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/myaso/">Мясо</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/molochnaya_produktsiya/">Молочная продукция</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/frukty_ovoshchi_zelen_griby/">Фрукты, овощи, зелень, грибы</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/catalog/ptitsa/">Птица</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/bakaleya_krupy_makarony/">Бакалея, крупы, макароны</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/konservatsiya_sousy_pripravy/">Консервация, соусы, приправы</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/catalog/buloshnaya_kruton/">Салаты и закуски </a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/myed/">Мёд</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/sukhofrukty_orekhi/">Сухофрукты, орехи</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/napitki_chay_kofe/">Напитки, чай, кофе</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/khleb_konditerskie_izdeliya/">Хлеб, кондитерские изделия, тесто</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/zamorozka_i_gotovye_blyuda/">Заморозка и готовые блюда</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/catalog/produktsiya_myasotsekha/">Полуфабрикаты из мяса</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/catalog/pekarnya_smakovnitsa/">Пекарня «Смаковница»</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/catalog/pekarnya_kruton_/">Пекарня «Крутонъ»</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/catalog/bytovaya_khimiya_parfyumeriya_kosmetika_tovary_dlya_doma/">«Ирина» Бытовая химия, косметика, товары для дома</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/catalog/tortsher_/">Кофейня-кондитерская  «ТортШер»</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <li class="icons_fa has-child ">-->
<!--                                        <a class="dark_link parent" href="/o-rynke/">О рынке</a>-->
<!--                                        <ul class="dropdown">-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/o-rynke/">О рынке</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/o-rynke/1-etazh/">1 этаж</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/o-rynke/2-etazh/">2 этаж</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/o-rynke/video/">Видео</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/o-rynke/yarmarka/">Ярмарка</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/o-rynke/novosti/">Новости</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <li class="icons_fa has-child ">-->
<!--                                        <a class="dark_link parent" href="/kak-kupit/">Доставка и оплата</a>-->
<!--                                        <ul class="dropdown">-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/kak-kupit/">Доставка и оплата</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/kak-kupit/oplata/">Как оплатить</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/kak-kupit/dostavka/">Доставка продукции</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/kak-kupit/garantii/">Гарантии</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/kak-kupit/vozvrat/">Возврат товара</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <li class="icons_fa has-child ">-->
<!--                                        <a class="dark_link parent" href="/arendatoram/">Арендаторам</a>-->
<!--                                        <ul class="dropdown">-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/arendatoram/">Арендаторам</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/arendatoram/arenda/">Аренда</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/arendatoram/reklama/">Реклама</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <li class="icons_fa  ">-->
<!--                                        <a class="dark_link " href="/retsepty/">Рецепты</a>-->
<!--                                    </li>-->
<!--                                    <li class="icons_fa has-child ">-->
<!--                                        <a class="dark_link parent" href="/novyy-god/">Новый год</a>-->
<!--                                        <ul class="dropdown">-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/novyy-god/">Новый год</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/novyy-god/dostavka-novogodnikh-eley/">Доставка новогодних елей</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/novyy-god/kakie-feyerverki-vybrat-dlya-prazdnika/">Какие фейерверки выбрать для праздника</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <li class="icons_fa has-child ">-->
<!--                                        <a class="dark_link parent" href="/kontakti/">Контакты</a>-->
<!--                                        <ul class="dropdown">-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa parent" href="/kontakti/">Контакты</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/kontakti/sotrudniki/">Cотрудники</a>-->
<!--                                            </li>-->
<!--                                            <li class="full ">-->
<!--                                                <a class="icons_fa " href="/kontakti/vopros-otvet/">Вопрос - ответ</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </li>-->
<!--                                    <li class="search">-->
<!--                                        <div class="search-input-div">-->
<!--                                            <input class="search-input" type="text" autocomplete="off" maxlength="50" size="40" placeholder="Поиск" value="" name="q">-->
<!--                                        </div>-->
<!--                                        <div class="search-button-div">-->
<!--                                            <button class="button btn-search btn-default" value="Найти" name="s" type="submit">Найти</button>-->
<!--                                        </div>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class='row' id='cssmenu'>
                        <ul class="col-lg-12 list-inline">
                            <li class='active'><a href='#'><span>Home</span></a></li>
                            <li class='has-sub'><a href='#'><span>Products</span></a>
                                <ul class="col-lg-12 list-inline">
                                    <li><a href='#'><span>Product 1</span></a></li>
                                    <li><a href='#'><span>Product 2</span></a></li>
                                    <li class='last'><a href='#'><span>Product 3</span></a></li>
                                </ul>
                            </li>
                            <li class='has-sub'><a href='#'><span>About</span></a>
                                <ul>
                                    <li><a href='#'><span>Company</span></a></li>
                                    <li class='last'><a href='#'><span>Contact</span></a></li>
                                </ul>
                            </li>
                            <li class='last'><a href='#'><span>Contact</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>

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
