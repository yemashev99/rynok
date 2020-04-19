<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Каталог - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['catalog/index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => Url::to(['catalog/category', 'category' => $category->url])];
$this->params['breadcrumbs'][] = ['label' => $subCategory->title, 'url' => Url::to(['catalog/item', 'category' => $category->url, 'subCategory' => $subCategory->url])];
$this->params['breadcrumbs'][] = $product->title;

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
									<div class="counter_block big_basket" data-offers="N" data-item="1081">
										<span class="minus" id="bx_117848907_1081_quant_down">-</span>
										<input type="text" class="text" id="bx_117848907_1081_quantity" name="quantity" value="1">
										<span class="plus" id="bx_117848907_1081_quant_up">+</span>
									</div>
									<div id="bx_117848907_1081_basket_actions" class="button_block ">
										<!--noindex-->
										<span class="big_btn w_icons to-cart button transition_bg" data-item="1081" data-float_ratio="" data-ratio="1" data-bakset_div="bx_basket_div_1081" data-props="" data-part_props="Y" data-add_props="Y" data-empty_props="Y" data-offers="" data-iblockid="14" data-quantity="1"><i></i><span>В корзину</span></span><a rel="nofollow" href="/basket/" class="big_btn w_icons in-cart button transition_bg" data-item="1081" style="display:none;"><i></i><span>В корзине</span></a>
										<!--/noindex-->
									</div>
								</div>
								<div class="wrapp_one_click">
									<span class="transparent big_btn type_block button transition_bg one_click">
										<span>Купить в 1 клик</span>
									</span>
								</div>
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
</div>

