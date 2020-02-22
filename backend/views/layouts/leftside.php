<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->login?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Онлайн</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Меню', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Управление сайтом', 'icon' => 'fa fa-dashboard',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Меню',
                                    'icon' => 'fa fa-database',
                                    'url' => ['menu/index'],
                                    'active' => in_array(Yii::$app->controller->id, ['menu'])
                                ],
                            ]
                        ],
                        [
                            'label' => 'Пользователи',
                            'icon' => 'fa fa-users',
                            'url' => ['/user'],
                            'active' => $this->context->route == 'user/index',
                        ],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
