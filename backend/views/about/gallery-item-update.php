<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Фото и видео', 'url' => ['about/gallery']];
$this->params['breadcrumbs'][] = ['label' => 'Контент', 'url' => ['about/gallery-content', 'id' => $gallery->gallery_id]];
if ($gallery->type == 'video')
{
    $this->params['breadcrumbs'][] = 'Редактирование видео';
} elseif ($gallery->type == 'photo') {
    $this->params['breadcrumbs'][] = 'Редактирование фото';
}

?>

<div class="page-header">
    <h1>Редактирование объекта в контенте</h1>
</div>

<?=$this->render('_gallery-item-form', compact('model', 'gallery'))?>
