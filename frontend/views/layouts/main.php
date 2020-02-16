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
                                        <img src="<?=Yii::getAlias('@web').'/img/logo.png'?>" alt="Рынок Михайловский" title="Рынок Михайловский">
                                    </a>
                                    <a data="1" href="" class="logo-mobile">
                                        <img src="<?=Yii::getAlias('@web').'/img/logo.png'?>" alt="Рынок Михайловский" title="Рынок Михайловский">
                                    </a>
                                </div>
                            </td>
                            <td class="text_wrapp">
                                <div class="slogan">
                                    <div class="h2" style="color: green; line-height: 1.15;">РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК</div>
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
                            <td>
                                <div class="work-time">
                                    Ежедневно<br/>09:00 - 19:00
                                </div>
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
                                                                    <b>+7 (913) 441-14-85</b>
                                                                </span>
                                                            </span><br>
                                                            телефон доставки<br>
                                                            <a style="font-size: 10pt; color: green;" href="mailto:direkciya2011@yandex.ru">direkciya2011@yandex.ru</a>
                                                        </span>
														<span class="address">Республика Хакасия<br>Абакан, Тельмана, 92к</span>
													</span>
													<span class="order_wrap_btn" style="color: green;">
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
                    <div class="wrapper_middle_menu wrap_menu" style="overflow: visible;">
                        <ul class="menu adaptive">
                            <li class="menu_opener">
                                <div class="text">
                                    Меню
                                </div>
                            </li>
                        </ul>
                        <div class="inc_menu">
                            <ul class="menu top menu_top_block catalogfirst">
                                <li>
                                    <a class="icons_fa parent" href="/catalog/" style="padding-left: 34px; padding-right: 35px;">Каталог</a>
                                </li>
                                <li>
                                    <a class="icons_fa parent" href="/o-rynke/" style="padding-left: 34px; padding-right: 35px;">О рынке</a>
                                </li>
                                <li>
                                    <a class="icons_fa parent" href="/kak-kupit/" style="padding-left: 34px; padding-right: 35px;">Доставка и оплата</a>
                                </li>
                                <li>
                                    <a class="icons_fa parent" href="/arendatoram/" style="padding-left: 34px; padding-right: 35px;">Арендаторам</a>
                                </li>
                                <li>
                                    <a class="" href="/retsepty/" style="padding-left: 34px; padding-right: 35px;">Рецепты</a>
                                </li>
                                <li>
                                    <a class="icons_fa parent" href="/novyy-god/" style="padding-left: 34px; padding-right: 35px;">Новый год</a>
                                </li>
                                <li>
                                    <a class="icons_fa parent" href="/kontakti/" style="padding-left: 36px; padding-right: 37px;">Контакты</a>
                                </li>
                            </ul>
                            <div class="mobile_menu_wrapper">
                                <ul class="mobile_menu">
                                    <li class="icons_fa has-child ">
                                        <a class="dark_link parent" href="/catalog/">Доставка товаров</a>
                                    </li>
                                    <li class="icons_fa has-child ">
                                        <a class="dark_link parent" href="/o-rynke/">О рынке</a>
                                    </li>
                                    <li class="icons_fa has-child ">
                                        <a class="dark_link parent" href="/kak-kupit/">Доставка и оплата</a>
                                    </li>
                                    <li class="icons_fa has-child ">
                                        <a class="dark_link parent" href="/arendatoram/">Арендаторам</a>
                                    </li>
                                    <li class="icons_fa  ">
                                        <a class="dark_link " href="/retsepty/">Рецепты</a>
                                    </li>
                                    <li class="icons_fa has-child ">
                                        <a class="dark_link parent" href="/novyy-god/">Новый год</a>
                                    </li>
                                    <li class="icons_fa has-child ">
                                        <a class="dark_link parent" href="/kontakti/">Контакты</a>
                                    </li>
                                    <li class="search">
                                        <div class="search-input-div">
                                            <input class="search-input" type="text" autocomplete="off" maxlength="50" size="40" placeholder="Поиск" value="" name="q">
                                        </div>
                                        <div class="search-button-div">
                                            <button class="button btn-search btn-default" value="Найти" name="s" type="submit">Найти</button>
                                        </div>
                                    </li>
                                </ul>
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
                <ul class="left_menu">
                    <li class="item">
                        <a data="/o-rynke/" class="icons_fa" href="/o-rynke/1-etazh/">
                            <span>1 этаж</span>
                        </a>
                    </li>
                    <li class="item">
                        <a data="/o-rynke/" class="icons_fa" href="/o-rynke/2-etazh/">
                            <span>2 этаж</span>
                        </a>
                    </li>
                    <li class="item">
                        <a data="/o-rynke/" class="icons_fa" href="/o-rynke/video/">
                            <span>Видео</span>
                        </a>
                    </li>
                    <li class="item">
                        <a data="/o-rynke/" class="icons_fa" href="/o-rynke/yarmarka/">
                            <span>Ярмарка</span>
                        </a>
            </div>
            <div class="right_block">
                <?=$content?>
            </div>
        </div>
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
