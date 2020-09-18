<?php

    use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Продукты';

?>

<h1 id="pagetitle"><?=$menu->title?></h1>

<div class="catalog_section_list rows_block items">
    <?php foreach ($categories as $category) : ?>
        <div class="item_block col-4">
            <div class="section_item item" id="<?=$category->category_id?>" style="height: 148px;">
                <div>
                    <?=Html::a(
                        Html::img(Yii::getAlias('@web').'/'.$category->image, [
                            'alt' => $category->title,
                            'title' => $category->title,
                            'width' => '100%',
                            'height' => '145px',
                        ]),
                        Url::to(['catalog/category', 'category' => $category->url]),
                        ['class' => 'thumb']
                    )?>
                </div>
            </div>
            <div class="catalog_name">
                <?=Html::a(
                    '<span>'.$category->title.'</span>',
                    Url::to(['catalog/category', 'category' => $category->url])
                )?>
            </div>
        </div>
    <?php endforeach; ?>
</div>