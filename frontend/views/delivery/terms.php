<?php

$this->title = $terms->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Доставка и оплата', 'url' => ['delivery/index']];
$this->params['breadcrumbs'][] = $terms->title;

?>

<h1 id="pagetitle"><?=$terms->title?></h1>

<div class="content">
    <?=$terms->content?>
</div>
