<?php

use yii\helpers\Html;

$this->title = $category->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = $category->title;

?>

<h1 id="pagetitle"><?=$category->title?></h1>

<div class="masonry_area masonry" style="position: relative;">
    <?php foreach ($manufacturers as $manufacturer) : ?>
        <div class="col-md-5 masonry-brick">
            <article id="<?=$manufacturer->manufacturer_id?>" class="post-<?=$manufacturer->manufacturer_id?> post type-post status-publish format-standard has-post-thumbnail hentry category-1">
                <?php if ($manufacturer->image) : ?>
                    <div class="thumbnails">
                        <?=Html::a(
                            Html::img(Yii::getAlias('@web').'/'.$manufacturer->image,
                                [
                                    'width' => '750',
                                    'height' => '450',
                                    'class' => 'post-thumbnail img-responsive wp-post-image',
                                    'alt' => '',
                                ]
                            ),
                            ['about/manufacturers-content', 'manufacturer' => $manufacturer->url],
                            ['title' => $manufacturer->title]
                        )?>
                    </div>
                <?php endif; ?>
                <div class="padding-content">
                    <?php if ($manufacturer->title) : ?>
                        <header class="entry-header">
                            <h1 class="entry-title text-uppercase">
                                <?=Html::a($manufacturer->title, ['about/manufacturers-content', 'manufacturer' => $manufacturer->url], ['rel' => 'bookmark'])?>
                            </h1>
                        </header>
                    <?php endif; ?>
                    <?php if ($manufacturer->description) : ?>
                        <div class="entry-content">
                            <p>
                                <?=$manufacturer->description?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    var isMobile = false;
    $(document).ready(function(){
        if ($('body').width() <= 470) {
            isMobile = true;
        }
        if (!isMobile) {
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
        }
    });
</script>
