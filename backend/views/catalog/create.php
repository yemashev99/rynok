<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Каталог';

use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = 'Добавление нового товара';

?>

<div class="page-header">
    <h1>Добавление нового товара</h1>
</div>

<?=$this->render('_form', compact('model', 'category', 'subCategory'))?>
