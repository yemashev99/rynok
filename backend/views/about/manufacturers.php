<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление сайтом - О рынке';

?>

<div class="page-header">
    <h2>Производители</h2>
</div>

<?=Html::a('+ Добавить', ['about/manufacturers-create'], ['class' => 'btn btn-primary'])?>

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
        'manufacturer_id',
        'title',
        'description',
        [
            'label'=>'Изображение',
            'format' => 'raw',
            'value' => function($data) {
                if ($data->image)
                {
                    return Html::img(
                        Yii::getAlias('@web').'/'.$data->image,
                        [
                            'alt' => $data->title,
                            'width' => '150',
                            'height' => '100'
                        ]
                    );
                }
            }
        ],
        [
            'label' => 'Контент',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('Перейти', ['about/manufacturers-content', 'id' => $data->manufacturer_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['about/manufacturers-update', 'id' => $data->manufacturer_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>
