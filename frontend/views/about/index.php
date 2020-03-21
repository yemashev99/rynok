<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $menu->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = $menu->title;

?>

<h1 id="pagetitle"><?=$menu->title?></h1>

<div class="content">
    <?=$menu->content?>
</div>


