<?php use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="col-md-6">

    <?php $form = ActiveForm::begin() ?>

    <?=$form->field($subCategory, 'title')->textInput()?>

    <?=$form->field($subCategory, 'url')->textInput()?>

    <?=$form->field($subCategory, 'category_id')->hiddenInput(['value' => $category->category_id])->label(false)?>

    <?= $form->field($subCategory, 'file')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'images/*',
        ]
    ])?>

    <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end() ?>

</div>
