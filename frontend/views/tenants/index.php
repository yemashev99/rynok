<?php

use yii\helpers\Html;

$this->title = 'Арендаторам - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Арендаторам';

?>

<h1 id="pagetitle">Аренда</h1>

<div class="masonry_area masonry" style="position: relative;">
    <?php foreach ($tenants as $tenant) : ?>
        <div class="col-md-5 masonry-brick">
            <article id="<?=$tenant->tenants_id?>" class="post-<?=$tenant->tenants_id?> post type-post status-publish format-standard has-post-thumbnail hentry category-1">
                <?php if ($tenant->image) : ?>
                    <div class="thumbnails">
                        <?=Html::a(
                            Html::img(Yii::getAlias('@web').'/'.$tenant->image,
                                [
                                    'width' => '750',
                                    'height' => '450',
                                    'class' => 'post-thumbnail img-responsive wp-post-image',
                                    'alt' => '',
                                ]
                            ),
                            ['tenants/content', 'tenant' => $tenant->url],
                            ['title' => $tenant->title]
                        )?>
                    </div>
                <?php endif; ?>
                <div class="padding-content">
                    <?php if ($tenant->title) : ?>
                        <header class="entry-header">
                            <h1 class="entry-title text-uppercase">
                                <?=Html::a($tenant->title, ['tenants/content', 'tenant' => $tenant->url], ['rel' => 'bookmark'])?>
                            </h1>
                        </header>
                    <?php endif; ?>
                    <?php if ($tenant->description) : ?>
                        <div class="entry-content">
                            <p>
                                <?=$tenant->description?>
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
