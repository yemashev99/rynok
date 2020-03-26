<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Фото и видео', 'url' => ['about/gallery']];
$this->params['breadcrumbs'][] = 'Редактирование объекта';

?>

<div class="page-header">
    <h1>Редактирование объекта <span style="font-size: 14px; color: #777777">* Контент можно изменить на соответсвующей странице</span></h1>
</div>

<?=$this->render('_gallery-form', compact('model'))?>
