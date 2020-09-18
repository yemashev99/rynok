<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Праздники';

$this->params['breadcrumbs'][] = ['label' => 'Праздники', 'url' => ['holidays/index']];
$this->params['breadcrumbs'][] = 'Добавление нового праздника';

?>

<div class="page-header">
    <h1>Добавление нового праздника <span style="font-size: 14px; color: #777777">* Добавить контент можно только после добавления праздника</span></h1>
</div>

<?=$this->render('_form', compact('model'))?>
