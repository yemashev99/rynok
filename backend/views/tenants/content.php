<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
mihaildev\elfinder\Assets::noConflict($this);

$this->title = 'Управление сайтом - Арендаторам';

$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['tenants/index']];
$this->params['breadcrumbs'][] = 'Контент';

?>

<div class="page-header">
    <h2>Объект № <?=$model->tenants_id?>: "<?=$model->title?>"</h2>
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
