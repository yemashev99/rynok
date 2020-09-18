<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Каталог';

use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = 'Редактирование товара';

?>

<div class="page-header">
    <h1>Редактирование товара</h1>
</div>

<?=$this->render('_form', compact('model', 'category', 'subCategory'))?>
