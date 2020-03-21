<?php

use common\models\Cart;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Личный кабинет - Республиканский Селькохозяйственный Рынок';

?>

<div class="icon-done">
    <?=Html::img(Yii::getAlias('@web').'/img/done.png', ['width' => '225', 'height' => '225'])?>
    <h2>Заказ отправлен!</h2>
    <div class="row">
        <div class="col-md-5">
            <h3><?=Html::a('Перейти в католог', ['catalog/index'])?></h3>
        </div>
        <div class="col-md-5">
            <h3><?=Html::a('Перейти к заказу', ['cabinet/index', 'cabinet' => 'orders'])?></h3>
        </div>
    </div>
</div>
