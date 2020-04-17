<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление сайтом - Арендаторам';

?>

<div class="page-header">
    <h2>Документы для арендаторов</h2>
</div>

<?=Html::a('+ Загрузить новый документ', ['tenants/doc-create'], ['class' => 'btn btn-primary'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top:20px',
    ],
    'columns' => [
        'doc_id',
        'title',
        [
            'label'=>'Документ',
            'format' => 'raw',
            'value' => function($data) {
                if ($data->doc)
                {
                    return Html::a('Просмотр', Yii::getAlias('@web').'/'.$data->doc, ['class' => 'btn btn-primary', 'target' => '_blank']);
                }
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['tenants/doc-update', 'id' => $data->doc_id], ['class' => 'glyphicon glyphicon-pencil']);
            }
        ],
        [
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('', ['tenants/doc-delete', 'id' => $data->doc_id], ['class' => 'glyphicon glyphicon-trash']);
            }
        ],
    ],
]); ?>
