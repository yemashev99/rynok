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

<div class="wrap">
    <div class="container">
        <header class="header" style="margin-bottom:100px">
            <a href="<?=Yii::$app->homeUrl?>" title="Республиканский рынок в г. Абакан, республика Хакасия" alt="Республиканский рынок в г. Абакан, республика Хакасия">
                <img class="logo" src="<?=Yii::getAlias('@web').'/img/logo.png'?>" />
            </a>
            <div class="block-title">
                <div class="title">
                    <span class="text">РЕСПУБЛИКАНСКИЙ СЕЛЬСКОХОЗЯЙСТВЕННЫЙ РЫНОК</span>
                    <br /><span class="text2">АО «Дирекция республиканских рынков»</span>
                </div>
            </div>
            <div class="block-time">
                <span>Ежедневно</span><br />
                <span>09:00 - 19:00</span>
            </div>
            <div class="block-contact">
                <span>Республика Хакасия</span><br />
                <span>Абакан, Тельмана, 92к</span><br />
                <span>direkciya2011@yandex.ru</span>
            </div>
<!--            <div class="catalog_menu menu_colored">-->
<!--                <div class="wrapper_inner">-->
<!--                    <div class="wrapper_middle_menu wrap_menu">-->
<!--                        <ul class="menu adaptive">-->
<!--                            <li class="menu_opener">-->
<!--                                <div class="text">-->
<!--                                    Menu-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </header>
    </div>
    <div class="wrap content">
        <div class="container">
            <div class="left-block">
                Sidebar
            </div>
            <div class="right-block">
                <?= $content ?>
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
