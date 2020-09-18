<?php

$this->title = $control->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = $control->title;

?>

<h1 id="pagetitle"><?=$control->title?></h1>

<div class="content">
    <?=$control->content?>
</div>
