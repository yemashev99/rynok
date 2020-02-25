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
        <div class="item_block col-2">
            <div class="section_item item" id="bx_1847241719_65" style="height: 148px;">
                <table class="section_item_inner">
                    <tbody><tr>
                        <td class="image">
                            <?=Html::a(
                                Html::img(Yii::getAlias('@web').'/'.$subCategory->image, [
                                    'alt' => $subCategory->title,
                                    'title' => $subCategory->title,
                                ]),
                                Url::to(['catalog/item', 'category' => $subCategory->category->url, 'subCategory' => $subCategory->url]),
                                ['class' => 'thumb']
                            )?>
                        </td>
                        <td class="section_info" style="height: 86px;">
                            <ul>
                                <li class="name">
                                    <?=Html::a(
                                        '<span>'.$subCategory->title.'</span>',
                                        Url::to(['catalog/item', 'category' => $subCategory->category->url, 'subCategory' => $subCategory->url])
                                    )?>
                                </li>
                            </ul>
                            <div class="desc"><span class="desc_wrapp"></span></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>