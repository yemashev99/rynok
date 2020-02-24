    <?php
        use kartik\file\FileInput;
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;
    ?>


    <div class="col-md-6">
        <?php $form = ActiveForm::begin() ?>

        <?=$form->field($category, 'title')->textInput()?>

        <?=$form->field($category, 'url')->textInput()?>

        <?=$form->field($category, 'menu_id')->hiddenInput(['value' => $menu->menu_id])->label(false)?>

        <?= $form->field($category, 'file')->widget(FileInput::className(), [
            'options' => [
                'accept' => 'images/*',
            ]
        ])?>

        <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

        <?php ActiveForm::end() ?>
    </div>
