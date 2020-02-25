<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом - Меню';

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Пункты меню', 'url' => ['menu/index']];
$this->params['breadcrumbs'][] = ['label' => 'Категории "'.$menu->title.'"', 'url' => ['menu/category', 'id' => $menu->menu_id]];
$this->params['breadcrumbs'][] = 'Подкатегории "'.$category->title.'"';

?>

    <div class="page-header">
        <h1>Подкатегории "<?=$category->title?>"</h1>
    </div>

<?=Html::a('+ Добавить новую', ['menu/sub-category-create', 'id' => $category->category_id], ['class' => 'btn btn-primary'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top: 20px',
    ],
    'columns' => [
        'sub_category_id',
        'title',
        'url',
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
            'label'=>'Изменить',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a( '',
                    Url::to(['menu/sub-category-update', 'id' => $data->sub_category_id]),
                    ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>