<?php

use yii\helpers\Html;

$this->title = 'Праздники - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Праздники', 'url' => ['holidays/index']];
$this->params['breadcrumbs'][] = $object->title;

?>

<div class="content">
    <?=$object->content?>
</div>
