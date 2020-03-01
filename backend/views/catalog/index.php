<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Управление сайтом - Каталог';

?>

<div class="page-header">
    <h2>Критерии сортировки</h2>
</div>

<div class="row">
    <?php $form = ActiveForm::begin() ?>
    <div class="col-md-3">
        <?= $form->field($sortForm, 'categoryId')->dropDownList($category,
            [
                'prompt' => 'Выберете категорию',
                'onchange' => '
                    $.post("/catalog/list?id='.'"+$(this).val(), function (data) {
                        $("select#sortform-subcategoryid").removeAttr("disabled");
                        $("select#sortform-subcategoryid").html(data);
                    });
                ',
            ]
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($sortForm, 'subCategoryId')->dropDownList($subCategory,
            [
                'prompt' => '',
                'disabled' => 'disabled',
            ]
        ) ?>
    </div>
    <div class="col-sm-1">
       <?=Html::submitButton('<i class="fa fa-search"></i> Поиск', [
           'class' => 'btn btn-primary',
           'style' => 'margin-top: 24px;',
       ])?>
    </div>
    <?php ActiveForm::end() ?>
    <div class="col-md-1">
        <?=Html::a('Сбросить', ['catalog/index'], [
            'class' => 'btn btn-default',
            'style' => 'margin-top: 24px;',
        ])?>
    </div>
</div>

<div class="page-header">
    <h2>Товары</h2>
</div>

<?=Html::a('+ Добавить новый товар', ['catalog/create'], ['class' => 'btn btn-primary'])?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered',
    ],
    'options' => [
        'style' => 'padding-top:20px',
    ],
    'columns' => [
        'product_id',
        [
            'attribute' => 'categoryId',
            'label' => 'Категория',
            'value' => 'category.title'
        ],
        [
            'attribute' => 'subCategoryId',
            'label' => 'Подкатегория',
            'value' => 'subCategory.title'
        ],
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
            'label'=>'Цена',
            'format' => 'raw',
            'value' => function($data) {
                return $data->price.' ₽';
            }
        ],
        'measure',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ],
]); ?>

