<?php use yii\helpers\Html;
use yii\widgets\ActiveForm ?>


<?php $form = ActiveForm::begin() ?>

<?=$form->field($category, 'title')->textInput(['style' => 'width:20%'])?>

<?=$form->field($category, 'url')->textInput(['style' => 'width:20%'])?>

<?=$form->field($category, 'menu_id')->hiddenInput(['value' => $menu->menu_id])->label(false)?>

<?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end() ?>
