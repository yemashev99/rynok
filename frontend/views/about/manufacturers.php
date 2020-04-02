<?php

$this->title = $manufacturers->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = $manufacturers->title;

?>

<h1 id="pagetitle"><?=$manufacturers->title?></h1>

<div class="content">
    <?=$manufacturers->content?>
</div>
