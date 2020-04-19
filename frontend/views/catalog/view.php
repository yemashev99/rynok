<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => Url::to(['catalog/category', 'category' => $category->url])];
$this->params['breadcrumbs'][] = ['label' => $subCategory->title, 'url' => Url::to(['catalog/item', 'category' => $category->url, 'subCategory' => $subCategory->url])];
$this->params['breadcrumbs'][] = $product->title;

if (Yii::$app->user->isGuest)
{
    $customer_id = 0;
} else {
    $customer_id = Yii::$app->user->identity->customer_id;
}

?>

<h1 id="pagetitle"><?=$product->title?></h1>

<div class="middle">
	<div class="catalog_detail">
			<div class="item_main_info noffer show_un_props">
				<div class="img_wrapper">
                    <?=Html::img(Yii::getAlias('@web').'/'.$product->image, ['width' => '340', 'height' => '233'])?>
				</div>
				<div class="right_info">
					<div class="info_item">
						<div class="middle_info">
							<div class="prices_block">
								<div class="cost prices">
									<div class="price"><?=$product->price?> ₽/<?=$product->count?><?=$product->measure?></div>
								</div>
							</div>
							<div class="buy_block">
								<div class="counter_wrapp">
                                    <?php if(Product::inCart($customer_id, $product->product_id)) : ?>
                                        <?php $form = ActiveForm::begin(['fieldConfig' => [
                                            'options' => ['tag' => false],
                                        ]]) ?>
                                            <div class="counter_block big_basket" data-offers="N" data-item="1081">
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
                                                <?=Html::submitButton('<i></i><span>В корзину</span>', ['class' => 'big_btn w_icons to-cart button transition_bg'])?>
                                                <!--/noindex-->
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
                                    <div id="product_<?=$product->product_id?>_basket_actions" class="button_block ">
                                        <!--noindex-->
                                        <?=Html::a('<i></i><span>В корзине</span>', ['cabinet/index'], ['class' => 'big_btn w_icons in-cart button transition_bg'])?>
                                        <!--/noindex-->
                                    </div>
                                    <?php endif; ?>
								</div>
								<!--<div class="wrapp_one_click">
									<span class="transparent big_btn type_block button transition_bg one_click" id="open-button-one-click">
										<span>Купить в 1 клик</span>
									</span>
								</div>-->
							</div>
						</div>
						<div class="element_detail_text wrap_md">
							<div class="sh">
								<div class="share_wrapp">
									<div class="text button transparent">Поделиться</div>
								</div>
							</div>
							<div class="price_txt">
								Цена действительна только для интернет-магазина и может отличаться от цен в розничных магазинах
							</div>
						</div>
						<div class="information_about_delivery">
							<div class="bold">
								Доcтавка
							</div>
							<div class="dostavka_li">По Абакану</div>
							<div class="dostavka_li">
								<i class="fa fa-check-circle-o" aria-hidden="true"></i> В наличии
							</div>
							<div class="dostavka_li">
								<i class="fa fa-truck" aria-hidden="true"></i> Доставка курьером
							</div>
							<div class="dostavka_li">
								<i class="fa fa-cube" aria-hidden="true"></i> Самовывоз из пункта выдачи, бесплатно
							</div>
							<div class="dostavka_li">
								<i class="fa fa-money" aria-hidden="true"></i> Оплата при получении<br>
								Банковской картой или наличными
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <div class="bottom_slider specials tab_slider_wrapp">
        <div class="top_blocks">
            <ul class="tabs">
                <li class="cur">
                    <span>Персональные рекомендации</span>
                </li>
            </ul>
            <ul class="tabs_content">
                <li class="tab RECOMENDATION_wrapp cur" style="opacity: 1; height: 500px;">
                    <div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="tabs_slider RECOMENDATION_slides wr"">
                            <?php foreach ($recommends as $recommend) : ?>
                                <li class="catalog_item" id="bx_1182278561_380380" style="height: 200px; width: 178px; float: left; display: block; opacity: 1;">
                                    <div class="image_wrapper_block">
                                        <a href="<?=Url::to(['catalog/view', 'category' => $recommend->category->url, 'subCategory' => $recommend->subCategory->url,'item' => $recommend->url])?>" class="thumb">
                                            <img src="<?=Yii::getAlias('@web').'/'.$recommend->image?>" alt="<?=$recommend->title?>" title="<?=$recommend->title?>">
                                        </a>
                                    </div>
                                    <div class="item_info" style="height: 75px;">
                                        <div class="item-title" style="height: 40px;">
                                            <a href="#"><span><?=$recommend->title?></span></a>
                                        </div>
                                        <div class="cost prices">
                                            <div class="price"><?=$recommend->price?> ₽/<?=$recommend->count?><?=$recommend->measure?></div>
                                        </div>
                                        <div class="buttons_block">
                                            <a class="button transition_bg basket read_more" href="<?=Url::to(['catalog/view', 'category' => $recommend->category->url, 'subCategory' => $recommend->subCategory->url,'item' => $recommend->url])?>">Подробнее</a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
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
            var url = "<?=Url::to(['cabinet/login', 'from' => 'catalog', 'category' => $category->url, 'subCategory' => $subCategory->url, 'item' => $product->url])?>";
            $(location).attr('href',url);
            e.preventDefault();
        }
    })
</script>

