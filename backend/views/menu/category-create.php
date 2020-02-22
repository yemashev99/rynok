<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом';

use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Пункты меню', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = ['label' => 'Категории "'.$menu->title.'"', 'url' => ['menu/category', 'id' => $menu->menu_id]];
$this->params['breadcrumbs'][] = 'Добавление новой категории';

?>

<div class="page-header">
    <h1>Добавление новой категории</h1>
</div>

<?=$this->render('_form-category', compact('category', 'menu'))?>
