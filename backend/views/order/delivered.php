<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Заказы - Клиенты';

?>

<div class="page-header">
    <h2>Отправленные</h2>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'columns' => [
        'order_id',
        'customer.fio:ntext',
        'customer.phone',
        'customer.address:ntext',
        'created_at:datetime',
        [
            'label'=> 'Действия',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('Подробнее',
                    Url::to(['order/view', 'id' => $data->customer_id, 'status' => 'delivered']),
                    [
                        'class' => 'btn btn-primary',
                        'style' => 'text-decoration: none;'
                    ]
                );
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ],
]); ?>
