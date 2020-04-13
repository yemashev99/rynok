<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Обратные звонки';

?>

<div class="page-header">
    <h2>Обратные звонки</h2>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'rowOptions' => function ($model, $key, $index, $grid) {
        if ($model->processed == 'Y')
        {
            return ['style' => 'color: rgba(78, 235, 16, 1);'];
        } else {
            return ['style' => 'color: rgba(235, 16, 16, 1);'];
        }
    },
    'options' => [
        'style' => 'padding-top:20px',
    ],
    'columns' => [
        'callback_id',
        'name',
        'phone',
        'date',
        [
            'format' => 'raw',
            'value' => function($data) {
                if ($data->processed == 'N')
                {
                    return Html::a('', ['callback/processed', 'id' => $data->callback_id], ['class' => 'glyphicon glyphicon-ok']);
                } else {
                    return 'Обработан!';
                }
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ],
]); ?>
