<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Арендаторам';

$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['tenants/index']];
$this->params['breadcrumbs'][] = 'Добавление нового объекта';

?>

<div class="page-header">
    <h1>Добавление нового объекта <span style="font-size: 14px; color: #777777">* Добавить контент можно только после добавления объекта</span></h1>
</div>

<?=$this->render('_form', compact('model'))?>
