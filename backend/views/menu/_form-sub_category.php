<?php use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<?php $form = ActiveForm::begin() ?>

<?=$form->field($subCategory, 'title')->textInput(['style' => 'width:20%'])?>

<?=$form->field($subCategory, 'url')->textInput(['style' => 'width:20%'])?>

<?=$form->field($subCategory, 'category_id')->hiddenInput(['value' => $category->category_id])->label(false)?>

<?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end() ?>
