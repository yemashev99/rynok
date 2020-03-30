<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
mihaildev\elfinder\Assets::noConflict($this);

$this->title = 'Управление сайтом - О рынке';

$this->params['breadcrumbs'][] = ['label' => 'Фото и видео', 'url' => ['about/gallery']];
$this->params['breadcrumbs'][] = 'Контент';

?>

<div class="page-header">
    <h2>Объект № <?=$model->gallery_id?>: "<?=$model->title?>"</h2>
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

<?php if ($model->type == 'video') : ?>

    <div class="page-header">
        Видео объекта
    </div>

    <?=Html::a('+ Добавить видео', ['about/gallery-item-create', 'id' => $model->gallery_id, 'type' => $model->type], ['class' => 'btn btn-primary'])?>

<?php elseif ($model->type == 'photo') : ?>

    <div class="page-header">
        Фото объекта
    </div>

    <?=Html::a('+ Добавить фото', ['about/gallery-item-create', 'id' => $model->gallery_id, 'type' => $model->type], ['class' => 'btn btn-primary'])?>

<?php endif; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top:20px',
    ],
    'columns' => [
        'gallery_item_id',
        'title',
        [
            'label'=>'Контент',
            'format' => 'raw',
            'value' => function($data) {
                if ($data->gallery->type == 'photo')
                {
                    return Html::img(
                        Yii::getAlias('@web').'/'.$data->content,
                        [
                            'alt' => $data->title,
                            'width' => '150',
                            'height' => '100'
                        ]
                    );
                } elseif ($data->gallery->type == 'video')
                {
                    return Html::a($data->content, $data->content, ['target' => '_blank']);
                }
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['about/gallery-item-update', 'id' => $data->gallery_id, 'type' => $data->gallery->type, 'item_id' => $data->gallery_item_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>
