<?php

use yii\helpers\Html;

$this->title = 'Арендаторам - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['tenants/index']];
$this->params['breadcrumbs'][] = 'Документы для арендаторов';
?>

<h1 id="pagetitle">Документы для арендаторов</h1>

<div class="content">
    <p>Уважаемые арендаторы!</p>
    <p>Если вы готовы арендовать торговые площади на Республиканском рынке, Вы можете ознакомиться с примерными формами договора и заявления на торговое место.</p>
    <ul style="list-style-image: url(http://xn--80ablnbgebcdzdndnlgh5a5o.xn--p1ai/wp-content/uploads/2018/09/179483.png); padding-left:100px">
        <?php foreach ($firstDocs as $doc) : ?>
            <li><?=Html::a($doc->title, [$doc->doc], ['target' => '_blank'])?></li>
        <?php endforeach; ?>
    </ul>
    <p>Убедительно просим Вас внимательно прочитать следующие документы:</p>
    <ul style="list-style-image: url(http://xn--80ablnbgebcdzdndnlgh5a5o.xn--p1ai/wp-content/uploads/2018/09/179483.png); padding-left:100px">
        <?php foreach ($secondDocs as $doc) : ?>
            <li><?=Html::a($doc->title, [$doc->doc], ['target' => '_blank'])?></li>
        <?php endforeach; ?>
    </ul>
</div>
