<?php

$this->title = $category->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Доставка и оплата', 'url' => ['delivery/index']];
$this->params['breadcrumbs'][] = $category->title;

?>

<h1 id="pagetitle"><?=$category->title?></h1>

<div class="content">
    <?=$category->content?>
</div>

