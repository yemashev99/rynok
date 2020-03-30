<?php

use yii\helpers\Html;

$this->title = $category->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = $category->title;

?>

<h1 id="pagetitle"><?=$category->title?></h1>

<div class="masonry_area masonry" style="position: relative;">
    <?php foreach ($galleryItems as $galleryItem) : ?>
        <div class="col-md-5 masonry-brick">
            <article id="<?=$galleryItem->gallery_id?>" class="post-<?=$galleryItem->gallery_id?> post type-post status-publish format-standard has-post-thumbnail hentry category-1">
                <div class="thumbnails">
                    <?=Html::a(
                        Html::img(Yii::getAlias('@web').'/'.$galleryItem->image,
                            [
                                'width' => '750',
                                'height' => '450',
                                'class' => 'post-thumbnail img-responsive wp-post-image',
                                'alt' => '',
                            ]
                        ),
                        ['about/gallery-content', 'item' => $galleryItem->url],
                        ['title' => $galleryItem->title]
                    )?>
                </div>
                <div class="padding-content">
                    <header class="entry-header">
                        <h1 class="entry-title text-uppercase">
                            <?=Html::a($galleryItem->title, ['about/gallery-content', 'item' => $galleryItem->url], ['rel' => 'bookmark'])?>
                        </h1>
                    </header>
                    <div class="entry-content">
                        <p>
                            <?=$galleryItem->description?>
                        </p>
                    </div>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
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
