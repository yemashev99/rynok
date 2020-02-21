<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Авторизация</h1>

<?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>

<?= $form->field($login_model, 'email')->textInput() ?>

<?= $form->field($login_model, 'password')->passwordInput() ?>

<div>
    <?=Html::submitButton('Submit', ['class' => 'btn btn-primary'])?>
</div>

<?php ActiveForm::end(); ?>
