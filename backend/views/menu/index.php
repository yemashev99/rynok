<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Меню';

use yii\grid\GridView;
use yii\helpers\Html; ?>

<div class="page-header">
    <h1>Пункты меню</h1>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered'
    ],
    'columns' => [
        'sort',
        'title',
        [
            'label' => 'Категории',
            'format' => 'raw',
            'value' => function($data){
                return Html::a('Перейти', ['menu/category', 'id' => $data->menu_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ],
]); ?>

