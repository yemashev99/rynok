<?php

use common\models\Cart;
use common\models\OrderStatus;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Заказы - '.$customer->fio;

$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['order/'.$status]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-header">
    <h2>Заказ на сумму <?=Cart::cartPrice($customer->customer_id, 'admin', OrderStatus::getStatusIdByTitle($status))?> ₽
        <?php
            if ($status == 'new')
            {
                echo Html::a('Отправлено', ['order/view', 'id' => $customer->customer_id, 'status' => 'new', 'action' => 'delivered'], ['class' => 'btn btn-primary']);
            } elseif ($status == 'delivered') {
                echo Html::a('Доставлено', ['order/view', 'id' => $customer->customer_id, 'status' => 'delivered', 'action' => 'done'], ['class' => 'btn btn-success']);
            }
        ?>
    </h2>
</div>
    <div class="row contact-info">
        <div class="col-md-3">
            Ф. И. О.
        </div>
        <div class="col-md-3">
            Телефон
        </div>
        <div class="col-md-3">
            Адрес
        </div>
        <div class="col-md-3">
            Индекс
        </div>
    </div>
    <div class="row contact-data">
        <div class="col-md-3">
            <?=$customer->fio?>
        </div>
        <div class="col-md-3">
            <?=$customer->phone?>
        </div>
        <div class="col-md-3">
            <?=$customer->address?>
        </div>
        <div class="col-md-3">
            <?php if($customer->postcode) echo $customer->postcode; else echo '(не указан)'?>
        </div>
    </div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'columns' => [
        'product.title:ntext',
        [
            'label'=>'Изображение',
            'format' => 'raw',
            'value' => function($data) {
                return Html::img(
                    Yii::getAlias('@web').'/'.$data->product->image,
                    [
                        'alt' => $data->product->title,
                        'width' => '150',
                        'height' => '100'
                    ]
                );
            }
        ],
        'comment',
        'quantity',
        [
            'label' => 'Сумма',
            'format' => 'raw',
            'value' => function($data) {
                $total = $data->product->price * $data->quantity;
                return $total.' ₽';
            }
        ]
    ],
]); ?>