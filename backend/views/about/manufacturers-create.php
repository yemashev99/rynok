<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['about/manufacturers']];
$this->params['breadcrumbs'][] = 'Добавление нового производителя';

?>

<div class="page-header">
    <h1>Добавление нового производителя <span style="font-size: 14px; color: #777777">* Добавить контент можно только после добавления производителя</span></h1>
</div>

<?=$this->render('_manufacturers-form', compact('model'))?>
