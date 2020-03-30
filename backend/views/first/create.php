<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Главная';

use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['first/index']];
$this->params['breadcrumbs'][] = 'Добавление нового элемента в галерею';

?>

<div class="page-header">
    <h1>Добавление нового элемента в галерею</h1>
</div>

<?=$this->render('_form', compact('model'))?>
