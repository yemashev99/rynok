<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['about/news']];
$this->params['breadcrumbs'][] = 'Добавление новой новости';

?>

    <div class="page-header">
        <h1>Добавление новой новости <span style="font-size: 14px; color: #777777">* Добавить контент можно только после добавления новости</span></h1>
    </div>

<?=$this->render('_news-form', compact('model'))?>