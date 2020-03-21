<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Заказы - Клиенты';

?>

<div class="page-header">
    <h2>Завершенные</h2>
</div>

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
                    Url::to(['order/view', 'id' => $data->customer_id, 'status' => 'done']),
                    [
                        'class' => 'btn btn-primary',
                        'style' => 'text-decoration: none;'
                    ]
                );
            }
        ],
    ],
]); ?>
