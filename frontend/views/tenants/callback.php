<?php

use yii\helpers\Html;

$this->title = 'Арендаторам - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['tenants/index']];
$this->params['breadcrumbs'][] = 'Заявка на сотрудничество';
?>

<h1 id="pagetitle">Оставьте заявку на сотрудничество:</h1>

<?php $form = \yii\widgets\ActiveForm::begin() ?>
<div class="form">
    <?=$form->field($callback, 'name')->textInput(['placeholder' => 'Ваше имя'])->label(false)?>

    <?=$form->field($callback, 'phone')->textInput(['placeholder' => 'Ваш телефон'])->label(false)?>

    <?=$form->field($callback, 'production')->textInput(['placeholder' => 'Ваша продукция'])->label(false)?>

    <?=Html::submitButton('Отправить', ['class' => 'btn btn-success'])?>
</div>
<?php \yii\widgets\ActiveForm::end() ?>