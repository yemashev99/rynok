<?php

use yii\helpers\Html;

$this->title = $category->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => ['about/news']];
$this->params['breadcrumbs'][] = $manufacturer->title;

?>

<div class="content">
    <?=$manufacturer->content?>
</div>
