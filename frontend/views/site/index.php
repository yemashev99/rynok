<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Республиканский Селькохозяйственный Рынок';
?>
<div class="middle">
    <div class="slider slider1">
        <div class="sliderContent">
            <?php foreach ($gallery as $item) : ?>
                <div class="item">
                    <?=Html::img(Yii::getAlias('@web').'/'.$item->image, ['alt' => '', 'width' => '100%'])?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="center-title">
        <h2>Доставка свежих продуктов на дом!</h2>
    </div>
    <div class="text">
        Служба доставки рынка, доставит Вам мясо, рыбу, салаты, свежую зелень, товары бакалеи, напитки и много другое. Заполняйте корзину. Приятных Вам покупок, Ваш Республиканский рынок.
    </div>
    <div class="main-category-block">
        <div class="row">
            <?php foreach ($icons as $icon) : ?>
                <div class="col-md-2" style="<?=$icon->options?>">
                    <?=Html::a(
                        Html::img(Yii::getAlias('@web').'/'.$icon->image_name),
                        Url::to(['catalog/category', 'category' => $icon->category->url])
                    )?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="center-title">
        <h2>Последние новости</h2>
    </div>
    <div class="masonry_area masonry" style="position: relative;">
        <?php foreach ($newsItems as $newsItem) : ?>
            <div class="col-md-5 masonry-brick" style="padding-left: 0; padding-right: 0">
                <article id="<?=$newsItem->news_id?>" class="post-<?=$newsItem->news_id?> post type-post status-publish format-standard has-post-thumbnail hentry category-1">
                    <div class="thumbnails">
                        <?=Html::a(
                            Html::img(Yii::getAlias('@web').'/'.$newsItem->image,
                                [
                                    'width' => '750',
                                    'height' => '450',
                                    'class' => 'post-thumbnail img-responsive wp-post-image',
                                    'alt' => '',
                                ]
                            ),
                            ['about/news-content', 'news' => $newsItem->url],
                            ['title' => $newsItem->title]
                        )?>
                    </div>
                    <div class="padding-content">
                        <header class="entry-header">
                            <h1 class="entry-title text-uppercase">
                                <?=Html::a($newsItem->title, ['about/news-content', 'news' => $newsItem->url], ['rel' => 'bookmark'])?>
                            </h1>
                        </header>
                        <div class="entry-content">
                            <p>
                                <?=$newsItem->description?>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
    <?=Html::a('Все новости', ['about/news'], ['class' => 'btn btn-default'])?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.masonry_area').masonry({
// указываем элемент-контейнер в котором расположены блоки для динамической верстки
            itemSelector: '.masonry-brick',
// указываем класс элемента являющегося блоком в нашей сетке
            singleMode: false,
// true - если у вас все блоки одинаковой ширины
            isResizable: true,
// перестраивает блоки при изменении размеров окна
            isAnimated: true,
// анимируем перестроение блоков
            animationOptions: {
                queue: false,
                duration: 500
            }
// опции анимации - очередь и продолжительность анимации
        });
    });
</script>
