<?php

use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Заказы - Клиенты';

?>

<div class="page-header">
    <h2>Новые заказы</h2>
</div>

<?=ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'exportConfig' => [
        ExportMenu::FORMAT_EXCEL => false,
    ],
    'columns' => [
        'customer_id',
        'fio:ntext',
        'phone',
        'address:ntext',
        'cart.created_at:datetime',
    ],
    'showConfirmAlert' => false
])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'columns' => [
        'customer_id',
        'fio:ntext',
        'phone',
        'address:ntext',
        'cart.created_at:datetime',
        [
            'label'=> 'Действия',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('Подробнее',
                    Url::to(['order/view', 'id' => $data->customer_id, 'status' => 'new']),
                    [
                        'class' => 'btn btn-primary',
                        'style' => 'text-decoration: none;'
                    ]
                );
            }
        ],
    ],
]); ?>


