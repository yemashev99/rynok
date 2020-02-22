<?php

/* @var $this yii\web\View */

$this->title = 'Управление сайтом';

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

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top: 20px',
    ],
    'columns' => [
        'sidebar_id',
        'title',
        'url',
        [
            'label' => 'Подкатегории',
            'format' => 'raw',
            'value' => function($data){
                return Html::a('Перейти', ['menu/sub-category', 'id' => $data->sidebar_id], ['class' => 'btn btn-primary']);
            }
        ],
        [
            'label'=>'Изменить',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a( '',
                    Url::to(['menu/category-update', 'id' => $data->sidebar_id]),
                    ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
    ],
]); ?>
