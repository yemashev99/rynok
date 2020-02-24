<?php
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
                            <a href="<?='/'.Yii::$app->controller->id.'/'.$category->url.'/'?>" class="thumb"><img src="<?=Yii::getAlias('@web').'/'.$category->image?>" alt="<?=$category->title?>" title="<?=$category->title?>"></a>
                        </td>
                        <td class="section_info" style="height: 196px;">
                            <ul>
                                <li class="name">
                                    <a href="<?='/'.Yii::$app->controller->id.'/'.$category->url.'/'?>"><span><?=$category->title?></span></a>
                                </li>
                                <?php foreach ($categoryModel->getSubCategoriesList($category->category_id) as $subCategory) :?>
                                    <li class="sect">
                                        <a href="<?='/'.Yii::$app->controller->id.'/'.$category->url.'/'.$subCategory->url.'/'?>" class="dark_link">
                                            <?=$subCategory->title?>&nbsp;
                                            <span><?=$categoryModel->getProductCount($category->category_id, $subCategory->sub_category_id)?></span>
                                        </a>
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