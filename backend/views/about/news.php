<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление сайтом - О рынке';

?>

<div class="page-header">
    <h2>Новости</h2>
</div>

<?=Html::a('+ Добавить новую новость', ['about/news-create'], ['class' => 'btn btn-primary'])?>

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
        'news_id',
        'title',
        'description',
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
        [
            'label' => 'Контент',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('Перейти', ['about/news-content', 'id' => $data->news_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['about/news-update', 'id' => $data->news_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>