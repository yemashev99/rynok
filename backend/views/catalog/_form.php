<?php

use kartik\file\FileInput;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>
<div class="col-md-6">
    <?= $form->field($model, 'category_id')->dropDownList($category,
        [
            'prompt' => 'Выберете категорию',
            'onchange' => '
                    $.post("/catalog/list?id='.'"+$(this).val(), function (data) {
                        $("select#sortform-subcategoryid").removeAttr("disabled");
                        $("select#sortform-subcategoryid").html(data);
                    });
                ',
        ]
    ) ?>

    <?= $form->field($model, 'sub_category_id')->dropDownList($subCategory,
        [
            'prompt' => '',
            'disabled' => 'disabled',
        ]
    ) ?>

    <?=$form->field($model, 'title')->textInput()?>

    <?=$form->field($model, 'price')->textInput()?>

    <?= $form->field($model, 'measure')->dropDownList(
        [
            'кг' => 'кг',
            'гр' => 'гр',
            'шт' => 'шт',
        ],
        [
            'prompt' => '',
            'disabled' => 'disabled',
        ]
    ) ?>

    <?=$form->field($model, 'description')->textarea()?>
</div>
<div class="col-md-6">
    <?= $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'images/*',
        ]
    ])?>
</div>
<?php ActiveForm::end(); ?>
