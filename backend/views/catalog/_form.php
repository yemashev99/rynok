<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList($category,
                [
                    'prompt' => 'Выберете категорию',
                    'onchange' => '
                    $.post("/catalog/list?id='.'"+$(this).val(), function (data) {
                        $("select#product-sub_category_id").removeAttr("disabled");
                        $("select#product-sub_category_id").html(data);
                    });
                ',
                ]
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sub_category_id')->dropDownList($subCategory,
                [
                    'prompt' => '',
                    'disabled' => 'disabled',
                ]
            ) ?>
        </div>
    </div>

    <?=$form->field($model, 'title')->textInput()?>

    <div class="row">
        <div class="col-md-6">
            <?=$form->field($model, 'price')->textInput()?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'measure')->dropDownList(
                [
                    'кг' => 'кг',
                    'гр' => 'гр',
                    'шт' => 'шт',
                ],
                [
                    'prompt' => 'Выбрать...',
                ]
            ) ?>
        </div>
    </div>

    <?=$form->field($model, 'description')->textarea(['style' => 'height: 72px'])?>

    <?=Html::submitButton('Добавить', ['class' => 'btn btn-success', 'style' => 'margin-top: 30px;'])?>
</div>
<div class="col-md-6">
    <?= $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'images/*',
        ]
    ])?>
</div>
<?php ActiveForm::end(); ?>
