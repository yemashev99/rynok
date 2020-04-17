<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Арендаторам';

$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['tenants/docs']];
$this->params['breadcrumbs'][] = 'Редактирование файла';

?>

<div class="page-header">
    <h1>Редактирование файла</h1>
</div>

<?=$this->render('_form-doc', compact('model'))?>

