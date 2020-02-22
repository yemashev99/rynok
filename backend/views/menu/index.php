<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом';

use yii\grid\GridView; ?>

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
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ],
]); ?>

