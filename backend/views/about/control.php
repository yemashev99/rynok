<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
mihaildev\elfinder\Assets::noConflict($this);

$this->title = 'Управление сайтом - О рынке';

?>

<div class="page-header">
    <h2><?=$model->title?></h2>
</div>

<?php $form = ActiveForm::begin() ?>

<?php echo $form->field($model, 'content')->widget(CKEditor::className(),[
    'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ])
]); ?>

<?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end() ?>
