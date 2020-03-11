<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Поиск - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = 'Поиск';

if ($orderBy == SORT_ASC)
{
    $orderBy = 'desc';
    $classOrderBy = 'asc';
} else {
    $orderBy = 'asc';
    $classOrderBy = 'desc';
}

?>

<h1 id="pagetitle">Поиск: "<?=$search?>"</h1>

<div class="right_block1 catalog horizontal">
    <div class="inner_wrapper">
        <div class="adaptive_filter">
            <a class="filter_opener"><i></i><span>Фильтр</span></a>
        </div>
        <div class="sort_header view_block">
            <div class="sort_header view_block">
                <!--noindex-->
                <div class="sort_filter">
                    <?=Html::a(
                        '<i class="icon" title="Произвольно"></i><span>Произвольно</span><i class="arr icons_fa"></i>',
                        ['catalog/search', 'display' => $display, 'search' => $search],
                        [
                            'class' => 'sort_btn '.(in_array($sort, ['']) ? 'current' : '').' '.$classOrderBy,
                            'rel' => 'nofollow',
                            'active' => in_array($sort, ['']),
                        ]
                    )?>
                    <?=Html::a(
                        '<i class="icon" title="По алфавиту"></i><span>По алфавиту</span><i class="arr icons_fa"></i>',
                        ['catalog/search', 'sort' => 'title', 'display' => $display, 'orderBy' => $orderBy, 'search' => $search],
                        [
                            'class' => 'sort_btn '.(in_array($sort, ['title']) ? 'current' : '').' '.$classOrderBy,
                            'rel' => 'nofollow',
                            'active' => in_array($sort, ['title']),
                        ]
                    )?>
                    <?=Html::a(
                        '<i class="icon" title="По цене"></i><span>По цене</span><i class="arr icons_fa"></i>',
                        ['catalog/search', 'sort' => 'price', 'display' => $display, 'orderBy' => $orderBy, 'search' => $search],
                        [
                            'class' => 'sort_btn '.(in_array($sort, ['price']) ? 'current' : '').' '.$classOrderBy,
                            'rel' => 'nofollow',
                        ]
                    )?>
                </div>
                <div class="sort_display">
                    <?=Html::a(
                        '<i title="плиткой"></i>',
                        ['catalog/search', 'display' => 'block', 'search' => $search],
                        [
                            'class' => 'sort_btn block '.(in_array($display, ['block']) ? 'current' : ''),
                            'rel' => 'nofollow'
                        ]
                    )?>
                    <?=Html::a(
                        '<i title="списком"></i>',
                        ['catalog/search', 'display' => 'list', 'search' => $search],
                        [
                            'class' => 'sort_btn list '.(in_array($display, ['list']) ? 'current' : ''),
                            'rel' => 'nofollow'
                        ]
                    )?>
                    <?=Html::a(
                        '<i title="таблицей"></i>',
                        ['catalog/search', 'display' => 'table', 'search' => $search],
                        [
                            'class' => 'sort_btn table '.(in_array($display, ['table']) ? 'current' : ''),
                            'rel' => 'nofollow'
                        ]
                    )?>
                </div>
                <!--/noindex-->
            </div>
        </div>
        <?php if ($display == 'block') : ?>
            <div class="ajax_load block">
                <div class="top_wrapper rows_block show_un_props">
                    <div class="catalog_block items block_list">
                        <?php foreach ($products as $product) : ?>
                            <div class="item_block col-4">
                                <div class="catalog_item_wrapp item" style="height: 270px;">
                                    <div class="catalog_item item_wrap" id="<?=$product->product_id?>" style="height: 300px;">
                                        <div>
                                            <div class="image_wrapper_block">
                                                <div class="stickers">
                                                </div>
                                                <a href="#" class="thumb" id="product_<?=$product->product_id?>_pic">
                                                    <img src="<?=Yii::getAlias('@web').'/'.$product->image?>" alt="<?=$product->title?>" title="<?=$product->title?>">
                                                </a>
                                            </div>
                                            <div class="item_info TYPE_1" style="height: 48px;">
                                                <div class="item-title" style="height: 20px;">
                                                    <a href="<?php /*TODO: view item*/ ?>"><span><?=$product->title?></span></a>
                                                </div>
                                                <div class="cost prices clearfix" style="height: 30px;">
                                                    <div class="price only_price">
                                                        <?=$product->price?> ₽/<?=$product->measure?>
                                                    </div>
                                                </div>
                                                <div class="hover_block1 footer_button">
                                                    <div class="counter_wrapp ">
                                                        <div class="counter_block" data-offers="N" data-item="1894">
                                                            <span class="minus" id="bx_3966226736_1894_quant_down">-</span>
                                                            <input type="text" class="text" id="bx_3966226736_1894_quantity" name="quantity" value="1">
                                                            <span class="plus" id="bx_3966226736_1894_quant_up">+</span>
                                                        </div>
                                                        <div id="bx_3966226736_1894_basket_actions" class="button_block ">
                                                            <!--noindex-->
                                                            <span class="small to-cart button"><i></i><span>В корзину</span></span><a rel="nofollow" href="/basket/" class="small in-cart button" data-item="1894" style="display:none;"><i></i><span>В корзине</span></a>												<!--/noindex-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="bottom_nav list">
                <div class="module-pagination">
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                        'maxButtonCount' => 8,
                    ]) ?>
                </div>
            </div>
        <?php elseif ($display == 'list') : ?>
            <div class="ajax_load list">
                <div class="display_list show_un_props">
                    <?php foreach ($products as $product) : ?>
                        <div class="list_item_wrapp item_wrap item">
                            <table class="list_item" id="<?=$product->product_id?>" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tbody><tr class="adaptive_name">
                                    <td colspan="2">
                                        <div class="desc_name"><a href="<?php /*TODO: view item*/ ?>"><span><?=$product->title?></span></a></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="image_block">
                                        <div class="image_wrapper_block">
                                            <div class="stickers">
                                            </div>
                                            <a href="<?php /*TODO: view item*/ ?>" class="thumb" id="product_<?=$product->product_id?>_pic">
                                                <img src="<?=Yii::getAlias('@web').'/'.$product->image?>" alt="<?=$product->title?>" title="<?=$product->title?>">
                                            </a>
                                        </div>
                                    </td>

                                    <td class="description_wrapp">
                                        <div class="description">
                                            <div class="item-title">
                                                <a href="<?php /*TODO: view item*/ ?>"><span><?=$product->title?></span></a>
                                            </div>
                                            <div class="wrapp_stockers">
                                                <div class="article_block">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="information_wrapp">
                                        <div class="information">
                                            <div class="cost prices clearfix">
                                                <div class="price" id="<?=$product->product_id?>">
                                                    <?=$product->price?> ₽/<?=$product->measure?>																									</div>
                                            </div>

                                            <div class="basket_props_block" id="bx_basket_div_1892" style="display: none;">
                                            </div>

                                            <div class="counter_wrapp ">
                                                <div class="counter_block" data-offers="N" data-item="1892">
                                                    <span class="minus" id="bx_3966226736_1892_quant_down">-</span>
                                                    <input type="text" class="text" id="bx_3966226736_1892_quantity" name="quantity" value="1">
                                                    <span class="plus" id="bx_3966226736_1892_quant_up">+</span>
                                                </div>
                                                <div id="bx_3966226736_1892_basket_actions" class="button_block ">
                                                    <!--noindex-->
                                                    <span class="small to-cart button transition_bg" data-item="1892" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_1892" data-props="" data-part_props="Y" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="14" data-quantity="1"><i></i><span>В корзину</span></span><a rel="nofollow" href="/basket/" class="small in-cart button transition_bg" data-item="1892" style="display:none;"><i></i><span>В корзине</span></a>										<!--/noindex-->
                                                </div>
                                            </div>
                                        </div>
                                    </td></tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="bottom_nav list">
                <div class="module-pagination">
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                        'maxButtonCount' => 8,
                    ]) ?>
                </div>
            </div>
        <?php elseif ($display == 'table') : ?>
            <div class="ajax_load table">
                <table class="module_products_list">
                    <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr class="item" id="<?=$product->product_id?>">
                            <td class="foto-cell">
                                <div class="image_wrapper_block">
                                    <a class="popup_image fancy" href="<?php /*TODO: view item*/ ?>" title="<?=$product->title?>">
                                        <img src="<?=Yii::getAlias('@web').'/'.$product->image?>" alt="<?=$product->title?>" title="<?=$product->title?>">
                                    </a>
                                </div>
                            </td>
                            <td class="item-name-cell">
                                <div class="title"><a href="<?php /*TODO: view item*/ ?>"><?=$product->title?></a></div>
                            </td>
                            <td class="price-cell">
                                <div class="cost prices clearfix">
                                    <div class="price">
                                        <?=$product->price?> ₽/<?=$product->measure?>
                                    </div>

                                </div>

                                <div class="basket_props_block" id="bx_basket_div_1892" style="display: none;">
                                </div>
                                <div class="adaptive_button_buy">
                                    <!--noindex-->
                                    <span class="small to-cart button transition_bg" data-item="1892" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_1892" data-props="" data-part_props="Y" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="14" data-quantity="1"><i></i><span>В корзину</span></span><a rel="nofollow" href="/basket/" class="small in-cart button transition_bg" data-item="1892" style="display:none;"><i></i><span>В корзине</span></a>							<!--/noindex-->
                                </div>
                            </td>
                            <td class="but-cell item_1892">
                                <div class="counter_wrapp">
                                    <div class="counter_block" data-item="1892">
                                        <span class="minus">-</span>
                                        <input type="text" class="text" name="count_items" value="1">
                                        <span class="plus">+</span>
                                    </div>
                                    <div class="button_block ">
                                        <!--noindex-->
                                        <span class="small to-cart button transition_bg" data-item="1892" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_1892" data-props="" data-part_props="Y" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="14" data-quantity="1"><i></i><span>В корзину</span></span><a rel="nofollow" href="/basket/" class="small in-cart button transition_bg" data-item="1892" style="display:none;"><i></i><span>В корзине</span></a>								<!--/noindex-->
                                    </div>
                                </div>
                            </td>
                            <td class="like_icons ">
                                <div class="wrapp_stockers">
                                    <div class="like_icons">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="bottom_nav list">
                <div class="module-pagination">
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                        'maxButtonCount' => 8,
                    ]) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>