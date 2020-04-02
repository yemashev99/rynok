<?php

$this->title = $menu->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = $menu->title;

?>

<h1 id="pagetitle"><?=$menu->title?></h1>

<div class="content">
    <?=$menu->content?>
</div>

<div id="map" style="height: 350px;"></div>