<?php
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

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

<?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end(); ?>
