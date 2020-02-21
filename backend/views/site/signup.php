<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<h1>Регистрация</h1>

<?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>

<?= $form->field($model, 'login')->textInput() ?>

<?= $form->field($model, 'email')->textInput() ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div>
    <?=Html::submitButton('Submit', ['class' => 'btn btn-primary'])?>
</div>

<?php ActiveForm::end(); ?>
