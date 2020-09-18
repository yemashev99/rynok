<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model, 'title')->textInput()?>

<?=$form->field($model, 'url')->textInput()?>

<?= $form->field($model, 'file')->widget(FileInput::className(), [
    'options' => [
        'accept' => 'images/*',
    ]
])?>

<?=Html::submitButton('Добавить', ['class' => 'btn btn-success', 'style' => 'margin-top: 30px;'])?>

<?php ActiveForm::end(); ?>
