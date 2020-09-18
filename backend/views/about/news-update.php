<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['about/news']];
$this->params['breadcrumbs'][] = 'Редактирование новости';

?>

<div class="page-header">
    <h1>Редактирование новости <span style="font-size: 14px; color: #777777">* Контент можно изменить на соответсвующей странице</span></h1>
</div>

<?=$this->render('_news-form', compact('model'))?>
