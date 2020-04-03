<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление сайтом - Праздники';

?>

<div class="page-header">
    <h2>Праздники</h2>
</div>

<?=Html::a('+ Добавить', ['holidays/create'], ['class' => 'btn btn-primary'])?>

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
        'holiday_id',
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
                return Html::a('Перейти', ['holidays/content', 'id' => $data->holiday_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['holidays/update', 'id' => $data->holiday_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>
