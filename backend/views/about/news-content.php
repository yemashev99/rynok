<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
mihaildev\elfinder\Assets::noConflict($this);

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['about/news']];
$this->params['breadcrumbs'][] = 'Контент';

?>

<div class="page-header">
    <h2>Новость № <?=$model->news_id?>: "<?=$model->title?>"</h2>
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
