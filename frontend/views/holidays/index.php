<?php

use yii\helpers\Html;

$this->title = 'Праздники - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Праздники';

?>

<h1 id="pagetitle">Праздники</h1>

<div class="masonry_area masonry" style="position: relative;">
    <?php foreach ($holiday as $item) : ?>
        <div class="col-md-5 masonry-brick">
            <article id="<?=$item->holiday_id?>" class="post-<?=$item->holiday_id?> post type-post status-publish format-standard has-post-thumbnail hentry category-1">
                <?php if ($item->image) : ?>
                    <div class="thumbnails">
                        <?=Html::a(
                            Html::img(Yii::getAlias('@web').'/'.$item->image,
                                [
                                    'width' => '750',
                                    'height' => '450',
                                    'class' => 'post-thumbnail img-responsive wp-post-image',
                                    'alt' => '',
                                ]
                            ),
                            ['holidays/content', 'id' => $item->url],
                            ['title' => $item->title]
                        )?>
                    </div>
                <?php endif; ?>
                <div class="padding-content">
                    <?php if ($item->title) : ?>
                        <header class="entry-header">
                            <h1 class="entry-title text-uppercase">
                                <?=Html::a($item->title, ['holidays/content', 'id' => $item->url], ['rel' => 'bookmark'])?>
                            </h1>
                        </header>
                    <?php endif; ?>
                    <?php if ($item->description) : ?>
                        <div class="entry-content">
                            <p>
                                <?=$item->description?>
                            </p>
                        </div>
                    <?php endif; ?>
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

