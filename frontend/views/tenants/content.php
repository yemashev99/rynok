<?php

use yii\helpers\Html;

$this->title = 'Арендаторам - Республиканский Селькохозяйственный Рынок';
$this->params['breadcrumbs'][] = ['label' => 'Арендаторам', 'url' => ['tenants/index']];
$this->params['breadcrumbs'][] = $object->title;

?>

<div class="content">
    <?=$object->content?>
</div>
