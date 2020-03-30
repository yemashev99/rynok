<?php

use backend\models\OrderSearch;
use common\models\Category;
use common\models\Menu;

$menu = new Menu();
$items = Category::find()->where(['menu_id' => $menu->getIdByControllerName('about')])->all();
$aboutItems[] = [
    'label' => 'Основная информация',
    'icon' => 'file-text-o',
    'url' => ['about/index'],
    'active' => in_array('index', explode('/', Yii::$app->request->pathInfo))
];
foreach ($items as $item)
{
    $aboutItems[] = [
        'label' => $item->title,
        'icon' => 'file-text-o',
        'url' => ['about/'.$item->url],
        'active' => in_array($item->url, explode('/', Yii::$app->request->pathInfo))
    ];
}

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
                                'label' => 'Главная',
                                'icon' => 'file-text-o',
                                'url' => ['first/index'],
                                'active' => in_array(Yii::$app->controller->id, ['first'])
                            ],
                            [
                                'label' => 'Каталог',
                                'icon' => 'shopping-cart',
                                'url' => ['catalog/index'],
                                'active' => in_array(Yii::$app->controller->id, ['catalog'])
                            ],
                            [
                                'label' => 'О рынке',
                                'icon' => 'info',
                                'url' => '#',
                                'items' => $aboutItems,
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
