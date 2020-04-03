<?php use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$path = explode('/', Yii::$app->request->pathInfo);

?>

<div class="col-md-6">

    <?php $form = ActiveForm::begin() ?>

    <?=$form->field($subCategory, 'title')->textInput()?>

    <?=$form->field($subCategory, 'url')->textInput()?>

    <?=$form->field($subCategory, 'category_id')->hiddenInput(['value' => $category->category_id])->label(false)?>

    <?php if ($path[1] == 'sub-category-update') : ?>
        <?= $form->field($subCategory, 'file')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview'=>[
                    Yii::getAlias('@web').'/'.$subCategory->image
                ],
                'initialPreviewAsData'=>true,
            ],
            'options' => [
                'accept' => 'images/*',
            ]
        ])?>
    <?php else: ?>
        <?= $form->field($subCategory, 'file')->widget(FileInput::className(), [
            'options' => [
                'accept' => 'images/*',
            ]
        ])?>
    <?php endif; ?>

    <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

    <?php ActiveForm::end() ?>

</div>
