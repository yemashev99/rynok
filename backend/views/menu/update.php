<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Управление сайтом';

$this->params['breadcrumbs'][] = ['label' => 'Пункты меню', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = 'Редактирование';

?>

<div class="page-header">
    <h1>Редактирование</h1>
</div>

<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model, 'title')->textInput(['style' => 'width:20%'])?>

<?=$form->field($model, 'sort')->textInput(['style' => 'width:20%'])?>

<?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end(); ?>
