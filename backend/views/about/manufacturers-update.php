<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['about/manufacturers']];
$this->params['breadcrumbs'][] = 'Редактирование производителя';

?>

<div class="page-header">
    <h1>Редактирование производителя <span style="font-size: 14px; color: #777777">* Контент можно изменить на соответсвующей странице</span></h1>
</div>

<?=$this->render('_manufacturers-form', compact('model'))?>
