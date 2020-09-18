<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление сайтом - О рынке';

?>

<div class="page-header">
    <h2>Фото и видео</h2>
</div>

<?=Html::a('+ Добавить', ['about/gallery-create'], ['class' => 'btn btn-primary'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top:20px',
    ],
    'columns' => [
        'gallery_id',
        'title',
        'description',
        [
            'label'=>'Изображение',
            'format' => 'raw',
            'value' => function($data) {
                return Html::img(
                    Yii::getAlias('@web').'/'.$data->image,
                    [
                        'alt' => $data->title,
                        'width' => '150',
                        'height' => '100'
                    ]
                );
            }
        ],
        [
            'label'=>'Тип',
            'format' => 'raw',
            'value' => function($data) {
                if ($data->type == 'video')
                {
                    return 'Видео';
                } elseif ($data->type == 'photo') {
                    return 'Фото';
                }
            }
        ],
        'date',
        [
            'label' => 'Контент',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('Перейти', ['about/gallery-content', 'id' => $data->gallery_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['about/gallery-update', 'id' => $data->gallery_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>
