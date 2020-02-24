<?php

    use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
    $this->params['breadcrumbs'][] = 'Продукты';
?>

<h1 id="pagetitle"><?=$menu->title?></h1>

<div class="catalog_section_list rows_block items">
    <?php foreach ($categories as $category) : ?>
        <div class="item_block col-2">
            <div class="section_item item" id="bx_1847241719_64" style="height: 258px;">
                <table class="section_item_inner">
                    <tbody><tr>
                        <td class="image">
                            <?=Html::a(
                                Html::img(Yii::getAlias('@web').'/'.$category->image, [
                                    'alt' => $category->title,
                                    'title' => $category->title,
                                ]),
                                Url::to(['catalog/category', 'category' => $category->url]),
                                ['class' => 'thumb']
                            )?>
                        </td>
                        <td class="section_info" style="height: 196px;">
                            <ul>
                                <li class="name">
                                    <?=Html::a(
                                        '<span>'.$category->title.'</span>',
                                        Url::to(['catalog/category', 'category' => $category->url])
                                    )?>
                                </li>
                                <?php foreach ($categoryModel->getSubCategoriesList($category->category_id) as $subCategory) :?>
                                    <li class="sect">
                                        <?=Html::a(
                                            $subCategory->title.' <span>'.$categoryModel->getProductCount($category->category_id, $subCategory->sub_category_id).'</span>',
                                            Url::to(['catalog/category', 'category' => $category->url, 'subCategory' => $subCategory->url]),
                                            ['class' => 'dark_link']
                                        )?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </div>
    <?php endforeach; ?>
</div>