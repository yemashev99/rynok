<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form">
    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'title')->textInput()?>

    <?=$form->field($model, 'description')->textInput()?>

    <?=$form->field($model, 'url')->textInput()?>

    <?= $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'images/*',
        ]
    ])?>

    <?=Html::submitButton('Добавить', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end() ?>
</div>