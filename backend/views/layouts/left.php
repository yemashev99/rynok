<?php

use backend\models\OrderSearch;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->login?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Управление сайтом', 'icon' => 'dashboard',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Меню (Категории)',
                                'icon' => 'database',
                                'url' => ['menu/index'],
                                'active' => in_array(Yii::$app->controller->id, ['menu'])
                            ],
                            [
                                'label' => 'Каталог',
                                'icon' => 'shopping-cart',
                                'url' => ['catalog/index'],
                                'active' => in_array(Yii::$app->controller->id, ['catalog'])
                            ],
                        ]
                    ],
                    [
                        'label' => 'Заказы',
                        'icon' => 'shopping-basket',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Новые ('.OrderSearch::orderCount('new').')',
                                'icon' => 'envelope-open-o',
                                'url' => ['order/new'],
                                'active' => $this->context->route == 'order/new',
                            ],
                            [
                                'label' => 'Отправленные ('.OrderSearch::orderCount('delivered').')',
                                'icon' => 'truck',
                                'url' => ['order/delivered'],
                                'active' => $this->context->route == 'order/delivered',
                            ],
                            [
                                'label' => 'Завершенные ('.OrderSearch::orderCount('done').')',
                                'icon' => 'check-square-o',
                                'url' => ['order/done'],
                                'active' => $this->context->route == 'order/done',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'users',
                        'url' => ['/user'],
                        'active' => $this->context->route == 'user/index',
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
