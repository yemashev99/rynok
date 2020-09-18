<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Редактирование пользователя';
?>
    <h1>Редактирование</h1>

<?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>

<?= $form->field($model, 'login')->textInput() ?>

<?= $form->field($model, 'email')->textInput() ?>

    <div>
        <?=Html::submitButton('Добавить', ['class' => 'btn btn-primary'])?>
    </div>

<?php ActiveForm::end(); ?>