<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Меню';

use richardfan\sortable\SortableGridView;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Пункты меню', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = 'Категории "'.$menu->title.'"';

?>

<div class="page-header">
    <h1>Категории "<?=$menu->title?>"</h1>
</div>

<?=Html::a('+ Добавить новую', ['menu/category-create', 'id' => $menu->menu_id], ['class' => 'btn btn-primary'])?>

<?= SortableGridView::widget([
    'dataProvider' => $dataProvider,

    // you can choose how the URL look like,
    // but it must match the one you put in the array of controller's action()
    'sortUrl' => Url::to(['sortItem']),

    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top: 20px',
    ],
    'columns' => [
        'category_id',
        'title',
        'url',
        [
            'label'=>'Изображение',
            'format' => 'raw',
            'value' => function($data) {
                if (!is_null($data->image))
                {
                    return Html::img(
                        Yii::getAlias('@web').'/'.$data->image,
                        [
                            'alt' => $data->title,
                            'width' => '150',
                            'height' => '100'
                        ]
                    );
                }
            }
        ],
        [
            'label' => 'Подкатегории',
            'format' => 'raw',
            'value' => function($data){
                return Html::a('Перейти', ['menu/sub-category', 'id' => $data->category_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'label'=>'Изменить',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a( '',
                    Url::to(['menu/category-update', 'id' => $data->category_id]),
                    ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
        [
            'label'=>'Удалить',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a( '',
                    Url::to(['menu/category-delete', 'id' => $data->category_id]),
                    ['class' => 'glyphicon glyphicon-trash']);
            }
        ],
    ],
]); ?>
