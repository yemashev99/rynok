<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$path = explode('/', Yii::$app->request->pathInfo);

?>

<?php $form = ActiveForm::begin(); ?>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList($category,
                [
                    'prompt' => 'Выберете категорию',
                    'onchange' => '
                    $.post("/admin/catalog/list?id='.'"+$(this).val(), function (data) {
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

    <div class="row">
        <div class="col-md-6">
            <?=$form->field($model, 'title')->textInput(['onchange' => '
                    $.post("/admin/catalog/translate?text='.'"+$(this).val(), function (data) {
                        $("input#product-url").val(data);
                    });'])?>
        </div>
        <div class="col-md-6">
            <?=$form->field($model, 'url')->textInput()?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?=$form->field($model, 'price')->textInput()?>
        </div>
        <div class="col-md-3">
            <?=$form->field($model, 'count')->textInput()?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'measure')->dropDownList(
                [
                    'кг' => 'кг',
                    'гр' => 'гр',
                    'шт' => 'шт',
                    'л' => 'л',
                    'мл' => 'мл',
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
<?php if ($path[1] == 'update') : ?>
    <div class="col-md-6">
        <?= $form->field($model, 'file')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview'=>[
                    Yii::getAlias('@web').'/'.$model->image
                ],
                'initialPreviewAsData'=>true,
            ],
            'options' => [
                'accept' => 'images/*',
            ]
        ])?>
    </div>
<?php else: ?>
    <div class="col-md-6">
        <?= $form->field($model, 'file')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showUpload' => false,
            ],
            'options' => [
                'accept' => 'images/*',
            ]
        ])?>
    </div>
<?php endif; ?>
<?php ActiveForm::end(); ?>
