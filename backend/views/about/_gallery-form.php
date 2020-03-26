<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form">
    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'type')->dropDownList(
        [
            'photo' => 'Фото',
            'video' => 'Видео',
        ],
        [
            'prompt' => 'Выберете тип объекта'
        ]
    )?>

    <?=$form->field($model, 'title')->textInput()?>

    <?=$form->field($model, 'description')->textInput()?>

    <?=$form->field($model, 'url')->textInput()?>

    <?= $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'images/*',
        ]
    ])?>

    <?=$form->field($model, 'date')->hiddenInput(['value' => date('d-m-Y')])->label(false)?>

    <?=Html::submitButton('Добавить', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end() ?>
</div>
