<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Фото и видео', 'url' => ['about/gallery']];
$this->params['breadcrumbs'][] = ['label' => 'Контент', 'url' => ['about/gallery-content', 'id' => $gallery->gallery_id]];
if ($gallery->type == 'video')
{
    $this->params['breadcrumbs'][] = 'Добавление видео';
} elseif ($gallery->type == 'photo') {
    $this->params['breadcrumbs'][] = 'Добавление фото';
}

?>

<div class="page-header">
    <h1>Добавление нового объекта в контент</h1>
</div>

<?=$this->render('_gallery-item-form', compact('model', 'gallery'))?>
