<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = $category->title;
?>

<h1 id="pagetitle"><?=$category->title?></h1>

<div class="catalog_section_list rows_block items">
    <?php foreach ($subCategories as $subCategory) : ?>
        <div class="item_block col-4">
            <div class="section_item item" id="<?=$subCategory->sub_category_id?>" style="height: 148px;">
                <div>
                    <?=Html::a(
                        Html::img(Yii::getAlias('@web').'/'.$subCategory->image, [
                            'alt' => $subCategory->title,
                            'title' => $subCategory->title,
                            'width' => '100%',
                            'height' => '145px',
                        ]),
                        Url::to(['catalog/item', 'category' => $subCategory->category->url, 'subCategory' => $subCategory->url]),
                        ['class' => 'thumb']
                    )?>
                </div>
                <div class="catalog_name category_catalog_name">
                    <?=Html::a(
                        '<span>'.$subCategory->title.'</span>',
                        Url::to(['catalog/item', 'category' => $subCategory->category->url, 'subCategory' => $subCategory->url])
                    )?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>