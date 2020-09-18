<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Праздники';

$this->params['breadcrumbs'][] = ['label' => 'Праздники', 'url' => ['holidays/index']];
$this->params['breadcrumbs'][] = 'Редактирование праздника';

?>

    <div class="page-header">
        <h1>Редактирование праздника <span style="font-size: 14px; color: #777777">* Контент можно изменить на соответсвующей странице</span></h1>
    </div>

<?=$this->render('_form', compact('model'))?>