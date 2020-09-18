<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => Url::to(['catalog/category', 'category' => $category->url])];
$this->params['breadcrumbs'][] = $subCategory->title;

if ($orderBy == SORT_ASC)
{
    $orderBy = 'desc';
    $classOrderBy = 'asc';
} else {
    $orderBy = 'asc';
    $classOrderBy = 'desc';
}
if (Yii::$app->user->isGuest)
{
    $customer_id = 0;
} else {
    $customer_id = Yii::$app->user->identity->customer_id;
}
?>

<h1 id="pagetitle"><?=$subCategory->title?></h1>

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
                        ['catalog/item', 'display' => $display, 'category' => $category->url, 'subCategory' => $subCategory->url],
                        [
                            'class' => 'sort_btn '.(in_array($sort, ['']) ? 'current' : '').' '.$classOrderBy,
                            'rel' => 'nofollow',
                            'active' => in_array($sort, ['']),
                        ]
                    )?>
                    <?=Html::a(
                        '<i class="icon" title="По алфавиту"></i><span>По алфавиту</span><i class="arr icons_fa"></i>',
                        ['catalog/item', 'sort' => 'title', 'display' => $display, 'orderBy' => $orderBy, 'category' => $category->url, 'subCategory' => $subCategory->url],
                        [
                            'class' => 'sort_btn '.(in_array($sort, ['title']) ? 'current' : '').' '.$classOrderBy,
                            'rel' => 'nofollow',
                            'active' => in_array($sort, ['title']),
                        ]
                    )?>
                    <?=Html::a(
                        '<i class="icon" title="По цене"></i><span>По цене</span><i class="arr icons_fa"></i>',
                        ['catalog/item', 'sort' => 'price', 'display' => $display, 'orderBy' => $orderBy, 'category' => $category->url, 'subCategory' => $subCategory->url],
                        [
                            'class' => 'sort_btn '.(in_array($sort, ['price']) ? 'current' : '').' '.$classOrderBy,
                            'rel' => 'nofollow',
                        ]
                    )?>
                </div>
                <div class="sort_display">
                    <?=Html::a(
                        '<i title="плиткой"></i>',
                        ['catalog/item', 'display' => 'block', 'category' => $category->url, 'subCategory' => $subCategory->url],
                        [
                            'class' => 'sort_btn block '.(in_array($display, ['block']) ? 'current' : ''),
                            'rel' => 'nofollow'
                        ]
                    )?>
                    <?=Html::a(
                        '<i title="списком"></i>',
                        ['catalog/item', 'display' => 'list', 'category' => $category->url, 'subCategory' => $subCategory->url],
                        [
                            'class' => 'sort_btn list '.(in_array($display, ['list']) ? 'current' : ''),
                            'rel' => 'nofollow'
                        ]
                    )?>
                    <?=Html::a(
                        '<i title="таблицей"></i>',
                        ['catalog/item', 'display' => 'table', 'category' => $category->url, 'subCategory' => $subCategory->url],
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
                                    <div class="catalog_item item_wrap" id="<?=$product->product_id?>" style="padding-bottom: 30px;">
                                        <div>
                                            <div class="image_wrapper_block">
                                                <div class="stickers">
                                                </div>
                                                <a href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>" class="thumb" id="product_<?=$product->product_id?>_pic">
                                                    <img src="<?=Yii::getAlias('@web').'/'.$product->image?>" alt="<?=$product->title?>" title="<?=$product->title?>">
                                                </a>
                                            </div>
                                            <div class="item_info TYPE_1">
                                                <div class="item-title">
                                                    <a href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>"><span><?=$product->title?></span></a>
                                                </div>
                                                <div class="cost prices clearfix" style="height: 30px;">
                                                    <div class="price only_price">
                                                        <?=$product->price?> ₽/<?=$product->count?><?=$product->measure?>
                                                    </div>
                                                </div>
                                                <div class="hover_block1 footer_button">
                                                    <div class="counter_wrapp ">
                                                        <?php if(Product::inCart($customer_id, $product->product_id)) : ?>
                                                            <?php $form = ActiveForm::begin(['fieldConfig' => [
                                                                'options' => ['tag' => false],
                                                            ]]) ?>
                                                            <div class="counter_block" data-offers="N" data-item="<?=$product->product_id?>">
                                                                <span class="minus" id="product_<?=$product->product_id?>_quant_down">-</span>
                                                                <?=$form->field($cartForm, 'quantity', ['template' => "{label}\n{input}"])->textInput([
                                                                    'type' => 'text',
                                                                    'class' => 'text',
                                                                    'id' => 'cartform-quantity-'.$product->product_id,
                                                                    'value' =>  1
                                                                ])->label(false)?>
                                                                <span class="plus" id="product_<?=$product->product_id?>_quant_up">+</span>
                                                            </div>
                                                            <div id="product_<?=$product->product_id?>_basket_actions" class="button_block ">
                                                                <?=Html::submitButton('<i></i><span>В корзину</span>', ['class' => 'small to-cart button'])?>
                                                            </div>
                                                            <?=$form->field($cartForm, 'product_id')->hiddenInput([
                                                                'value' => $product->product_id,
                                                                'id' => 'cartform-product_id-'.$product->product_id,
                                                                ])->label(false)?>
                                                            <?=$form->field($cartForm, 'customer_id')->hiddenInput([
                                                                'value' => $customer_id,
                                                                'id' => 'cartform-customer_id-'.$product->product_id,
                                                            ])->label(false)?>
                                                            <?php ActiveForm::end() ?>
                                                        <?php else: ?>
                                                            <?=Html::a('<i></i><span>В корзине</span>', ['cabinet/index'], ['class' => 'small in-cart button'])?>
                                                        <?php endif; ?>
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
                                        <div class="desc_name"><a href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>"><span><?=$product->title?></span></a></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="image_block">
                                        <div class="image_wrapper_block">
                                            <div class="stickers">
                                            </div>
                                            <a href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>" class="thumb" id="product_<?=$product->product_id?>_pic">
                                                <img src="<?=Yii::getAlias('@web').'/'.$product->image?>" alt="<?=$product->title?>" title="<?=$product->title?>">
                                            </a>
                                        </div>
                                    </td>

                                    <td class="description_wrapp">
                                        <div class="description">
                                            <div class="item-title">
                                                <a href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>"><span><?=$product->title?></span></a>
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
                                                    <?=$product->price?> ₽/<?=$product->count?><?=$product->measure?>																									</div>
                                            </div>

                                            <div class="basket_props_block" id="bx_basket_div_1892" style="display: none;">
                                            </div>

                                            <?php if(Product::inCart($customer_id, $product->product_id)) : ?>
                                            <?php $form = ActiveForm::begin(['fieldConfig' => [
                                                'options' => ['tag' => false],
                                            ]]) ?>
                                            <div class="counter_wrapp ">
                                                <div class="counter_block" data-offers="N" data-item="<?=$product->product_id?>">
                                                    <span class="minus" id="product_<?=$product->product_id?>_quant_down">-</span>
                                                    <?=$form->field($cartForm, 'quantity', ['template' => "{label}\n{input}"])->textInput([
                                                        'type' => 'text',
                                                        'class' => 'text',
                                                        'id' => 'cartform-quantity-'.$product->product_id,
                                                        'value' =>  1
                                                    ])->label(false)?>
                                                    <span class="plus" id="product_<?=$product->product_id?>_quant_up">+</span>
                                                </div>
                                                <div id="product_<?=$product->product_id?>_basket_actions" class="button_block ">
                                                    <!--noindex-->
                                                    <?=Html::submitButton('<i></i><span>В корзину</span>', ['class' => 'small to-cart button transition_bg'])?>
                                                    <?=$form->field($cartForm, 'product_id')->hiddenInput([
                                                        'value' => $product->product_id,
                                                        'id' => 'cartform-product_id-'.$product->product_id,
                                                    ])->label(false)?>
                                                    <?=$form->field($cartForm, 'customer_id')->hiddenInput([
                                                        'value' => $customer_id,
                                                        'id' => 'cartform-customer_id-'.$product->product_id,
                                                    ])->label(false)?>
                                                    <?php ActiveForm::end(); ?>
                                                    <?php else: ?>
                                                        <?=Html::a('<i></i><span>В корзине</span>', ['cabinet/index'], ['class' => 'small in-cart button transition_bg', 'style' => 'margin-top: 10%'])?>
                                                    <?php endif; ?> <!--/noindex-->
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
                                        <a class="popup_image fancy" href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>" title="<?=$product->title?>">
                                            <img src="<?=Yii::getAlias('@web').'/'.$product->image?>" alt="<?=$product->title?>" title="<?=$product->title?>">
                                        </a>
                                    </div>
                                </td>
                                <td class="item-name-cell">
                                    <div class="title"><a href="<?=Url::to(['catalog/view', 'category' => $product->category->url, 'subCategory' => $product->subCategory->url, 'item' => $product->url])?>"><?=$product->title?></a></div>
                                </td>
                                <td class="price-cell">
                                    <div class="cost prices clearfix">
                                        <div class="price">
                                            <?=$product->price?> ₽/<?=$product->count?><?=$product->measure?>
                                        </div>

                                    </div>

                                    <div class="basket_props_block" id="bx_basket_div_<?=$product->product_id?>" style="display: none;">
                                    </div>
                                    <div class="adaptive_button_buy">
                                        <!--noindex-->
                                        <span class="small to-cart button transition_bg" data-item="<?=$product->product_id?>" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_<?=$product->product_id?>" data-props="" data-part_props="Y" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="14" data-quantity="1"><i></i><span>В корзину</span></span><a rel="nofollow" href="/basket/" class="small in-cart button transition_bg" data-item="<?=$product->product_id?>" style="display:none;"><i></i><span>В корзине</span></a>							<!--/noindex-->
                                    </div>
                                </td>
                                <td class="but-cell item_<?=$product->product_id?>">

                                    <?php if(Product::inCart($customer_id, $product->product_id)) : ?>
                                    <?php $form = ActiveForm::begin(['fieldConfig' => [
                                        'options' => ['tag' => false],
                                    ]]) ?>
                                    <div class="counter_wrapp">
                                        <div class="counter_block" data-item="<?=$product->product_id?>">
                                            <span class="minus" id="product_<?=$product->product_id?>_quant_down">-</span>
                                            <?=$form->field($cartForm, 'quantity', ['template' => "{label}\n{input}"])->textInput([
                                                'type' => 'text',
                                                'class' => 'text',
                                                'id' => 'cartform-quantity-'.$product->product_id,
                                                'value' =>  1
                                            ])->label(false)?>
                                            <span class="plus" id="product_<?=$product->product_id?>_quant_up">+</span>
                                        </div>
                                        <div class="button_block ">
                                            <!--noindex-->
                                            <?=Html::submitButton('<i></i><span>В корзину</span>', ['class' => 'small to-cart button transition_bg'])?>
                                            <?=$form->field($cartForm, 'product_id')->hiddenInput([
                                                'value' => $product->product_id,
                                                'id' => 'cartform-product_id-'.$product->product_id,
                                            ])->label(false)?>
                                            <?=$form->field($cartForm, 'customer_id')->hiddenInput([
                                                'value' => $customer_id,
                                                'id' => 'cartform-customer_id-'.$product->product_id,
                                            ])->label(false)?>
                                            <?php ActiveForm::end(); ?>
                                            <?php else: ?>
                                                <?=Html::a('<i></i><span>В корзине</span>', ['cabinet/index'], ['class' => 'small in-cart button transition_bg'])?>
                                            <?php endif; ?><!--/noindex-->
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

<script type="text/javascript">
    $(document).ready(function () {
        $('.minus').on('click',function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').on('click',function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });
    var customer_id = <?=$customer_id?>;
    $('.to-cart').on('click', function (e) {
        if (customer_id === 0)
        {
            alert('Для добавления в корзину, необходимо авторизоваться');
            var url = "<?=Url::to(['cabinet/login', 'from' => 'catalog', 'category' => $category->url, 'subCategory' => $subCategory->url, 'display' => $display])?>";
            $(location).attr('href',url);
            e.preventDefault();
        }
    })
</script>