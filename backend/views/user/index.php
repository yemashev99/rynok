<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Пользователи';

?>

<div class="page-header">
    <h2>Пользователи</h2>
</div>

<?=Html::a('+ Добавить нового пользователя', ['site/signup'], ['class' => 'btn btn-primary'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top:20px',
    ],
    'columns' => [
        'user_id',
        'login',
        'email',
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['user/update', 'id' => $data->user_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>

