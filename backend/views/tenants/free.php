<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Управление сайтом - Арендаторам';

?>

<div class="page-header">
    <h2>Свободных мест для аренды</h2>
</div>

<?php $form = ActiveForm::begin() ?>

<?=$form->field($model, 'free')->textInput(['style' => 'width:15%'])->label(false)?>

<?=Html::submitButton('Изменить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end() ?>
