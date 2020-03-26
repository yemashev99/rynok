<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Фото и видео', 'url' => ['about/gallery']];
$this->params['breadcrumbs'][] = 'Добавление нового объекта';

?>

<div class="page-header">
    <h1>Добавление нового объекта <span style="font-size: 14px; color: #777777">* Добавить контент можно только после добавления объекта</span></h1>
</div>

<?=$this->render('_gallery-form', compact('model'))?>
