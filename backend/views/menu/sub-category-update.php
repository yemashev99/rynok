<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Меню';

use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Пункты меню', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = ['label' => 'Категории "'.$menu->title.'"', 'url' => ['menu/category', 'id' => $menu->menu_id]];
$this->params['breadcrumbs'][] = ['label' => 'Подкатегории "'.$category->title.'"', 'url' => ['menu/sub-category', 'id' => $category->category_id]];
$this->params['breadcrumbs'][] = 'Редактирование "'.$subCategory->title.'"';

?>

<div class="page-header">
    <h1>Редактирование "<?=$subCategory->title?>"</h1>
</div>

<?=$this->render('_form-sub_category', compact('category', 'subCategory'))?>
