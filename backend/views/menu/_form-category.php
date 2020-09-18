    <?php
        use kartik\file\FileInput;
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;
        $path = explode('/', Yii::$app->request->pathInfo);
    ?>


    <div class="col-md-6">
        <?php $form = ActiveForm::begin() ?>

        <?=$form->field($category, 'title')->textInput()?>

        <?=$form->field($category, 'url')->textInput()?>

        <?=$form->field($category, 'menu_id')->hiddenInput(['value' => $menu->menu_id])->label(false)?>

        <?php if ($path[1] == 'category-update') : ?>
            <?= $form->field($category, 'file')->widget(FileInput::className(), [
                'pluginOptions' => [
                    'showUpload' => false,
                    'initialPreview'=>[
                        Yii::getAlias('@web').'/'.$category->image
                    ],
                    'initialPreviewAsData'=>true,
                ],
                'options' => [
                    'accept' => 'images/*',
                ]
            ])?>
        <?php else: ?>
            <?= $form->field($category, 'file')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'images/*',
                ]
            ])?>
        <?php endif; ?>

        <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

        <?php ActiveForm::end() ?>
    </div>
