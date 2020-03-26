<?php

/* @var $this yii\web\View */

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model, 'title')->textInput()?>

<?php if ($gallery->type == 'video') : ?>

<label>Ссылка на видео YouTube</label>
<?=$form->field($model, 'content')->textInput()->label(false)?>

<?php elseif ($gallery->type == 'photo') : ?>

<?= $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'images/*',
        ]
])?>

<?php endif; ?>

<?=$form->field($model, 'gallery_id')->hiddenInput(['value' => $gallery->gallery_id])->label(false)?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end(); ?>
