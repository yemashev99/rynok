<?php

use yii\helpers\Html;

$this->title = $category->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => ['about/'.$category->url]];
$this->params['breadcrumbs'][] = $gallery->title;

?>

<div class="content">
    <?=$gallery->content?>
</div>

<?php if ($gallery->type == 'video') : ?>

    <?php foreach ($items as $galleryItem) : ?>
        <iframe width="560" height="315" src="<?=$galleryItem->content?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <?php endforeach; ?>

<?php elseif ($gallery->type == 'photo') : ?>

    <?php foreach ($items as $galleryItem) : ?>
        <?=Html::img(Yii::getAlias('@web').'/'.$galleryItem->content)?>
    <?php endforeach; ?>

<?php endif; ?>
