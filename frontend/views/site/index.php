<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Республиканский Селькохозяйственный Рынок';
?>
<div class="site-index">
    <div class="slider slider1">
        <div class="sliderContent">
            <?php foreach ($gallery as $item) : ?>
                <div class="item">
                    <?=Html::img(Yii::getAlias('@web').'/'.$item->image, ['alt' => '', 'width' => '100%'])?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="center-title">
                <h2>Доставка свежих продуктов на дом!</h2>
            </div>
        </div>
        <div class="row">
            пикчи
        </div>
    </div>
</div>
