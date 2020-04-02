<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Арендаторам';

$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['about/manufacturers']];
$this->params['breadcrumbs'][] = 'Редактирование объекта';

?>

<div class="page-header">
    <h1>Редактирование объекта <span style="font-size: 14px; color: #777777">* Контент можно изменить на соответсвующей странице</span></h1>
</div>

<?=$this->render('_form', compact('model'))?>
