<?php

use frontend\models\Site;
use yii\helpers\Html;

$this->title = $model->title.' - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'О рынке', 'url' => ['about/index']];
$this->params['breadcrumbs'][] = $model->title;

?>

<h1 id="pagetitle"><?=$model->title?></h1>

<div class="center-title">
    <h2>Рынок производителей и фермерских хозяйств Республики Хакасия</h2>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="text" style="text-align: center;">
            <?=Html::img(Yii::getAlias('@web').'/img/9710886731213018_05c3.jpg', ['width' => '35%', 'height' => '10%'])?>
            <?=Html::img(Yii::getAlias('@web').'/img/DSC00586.jpg', ['width' => '35%', 'height' => '10%', 'style' => 'padding-left: 10px;'])?>
        </div>
    </div>
    <div class="col-md-12" style="padding-top: 10px">
        <div class="text" style="text-align: center;">
            <?=Html::img(Yii::getAlias('@web').'/img/9710886731213020_62d9.jpg', ['width' => '35%', 'height' => '10%'])?>
            <?=Html::img(Yii::getAlias('@web').'/img/9710886731213034_de33.jpg', ['width' => '35%', 'height' => '10%', 'style' => 'padding-left: 10px;'])?>
        </div>
    </div>
</div>

<div class="text floor-1" style="text-align: left; padding-bottom: 20px; <?php if (Site::isMobile()) : ?>margin-top: 10%;<?php else: ?>margin-top: -66%;<?php endif; ?>">
    <p>
        Горячий и свежий хлеб пекарен, пироги с различными начинками, узбекские лепешки, приготовленные в настоящем тандыре. А чебуреки или самса по традиционным рецептам? Ммм….<br>
        Вы можете заказать и праздничный торт к любому мероприятию – филиалы популярных кондитерских Хакасии ждут вас.
    </p>
    <p>Кроме того, на рынке представлена молочная продукция от ведущих производителей Хакасии и Красноярского края. Хакасский пармезан или моцарелла, айран или домашний кефир – выбирайте сами.</p>
    <p>Наши погребки открыты для вас всегда! Домашние соленья и варенья, все виды консервации – от арбузов до огурцов. Для любителей экзотики лавка с ароматными восточными пряностями, орехами и сухофруктами.</p>
    <p>Большой выбор гастрономической и бакалейной продукции, огромный выбор колбас, ветчины, от крупных и небольших мясоперерабатывающих компаний. Изюминка отделов – мясные деликатесы из мяса марала, оленя. </p>
</div>
