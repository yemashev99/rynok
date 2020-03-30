<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Главная';

use richardfan\sortable\SortableGridView;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="page-header">
    <h2>Кольцевая галерея</h2>
</div>

<?=Html::a('+ Добавить элемент', ['first/create'], ['class' => 'btn btn-primary'])?>

<?= SortableGridView::widget([
    'dataProvider' => $dataProvider,

    // you can choose how the URL look like,
    // but it must match the one you put in the array of controller's action()
    'sortUrl' => Url::to(['sortItem']),

    'columns' => [
        'first_page_gallery_id',
        'title',
        [
            'label'=>'Изображение',
            'format' => 'raw',
            'value' => function($data) {
                return Html::img(
                    Yii::getAlias('@web').'/'.$data->image,
                    [
                        'alt' => $data->title,
                        'width' => '150',
                        'height' => '100'
                    ]
                );
            }
        ],
        'url',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ],
]); ?>
