<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление сайтом - Арендаторам';

?>

<div class="page-header">
    <h2>Объекты</h2>
</div>

<?=Html::a('+ Добавить', ['tenants/create'], ['class' => 'btn btn-primary'])?>

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
        'tenants_id',
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
                return Html::a('Перейти', ['tenants/content', 'id' => $data->tenants_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['tenants/update', 'id' => $data->tenants_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>
