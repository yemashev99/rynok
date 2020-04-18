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

				</div>
			</div>
		</div>
</div>

