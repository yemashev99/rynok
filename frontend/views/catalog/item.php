<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => Url::to(['catalog/category', 'category' => $category->url])];
$this->params['breadcrumbs'][] = $subCategory->title;
?>

<h1 id="pagetitle"><?=$subCategory->title?></h1>

<div class="right_block1 clearfix catalog horizontal" id="right_block_ajax">

</div>