<?php

$this->title = $payment->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Доставка и оплата', 'url' => ['delivery/index']];
$this->params['breadcrumbs'][] = $payment->title;

?>

<h1 id="pagetitle"><?=$payment->title?></h1>

<div class="content">
    <?=$payment->content?>
</div>
