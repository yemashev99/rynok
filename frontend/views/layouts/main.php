<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Callback;
use common\models\Cart;
use common\models\Menu;
use common\models\Category;
use common\models\News;
use common\models\Product;
use frontend\models\ProductSearch;
use frontend\models\Site;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

//search product
$data = Product::searchItem();
$productSearchModel = new ProductSearch();


$menuItems = Menu::find()->orderBy('sort')->all();
$navItems = array(); $mobileNavItems = array();
foreach ($menuItems as $key => $menuItem)
{
    if ($menuItem->controller_name == 'catalog') {
        $navItems[] = [
            'label' => $menuItem->title,
            'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'linkOptions' => [
                'style' => 'padding-left: 79px; padding-right: 78px',
            ],
            'options' => [
                'class' => 'catalog icons_fa',
            ],
        ];
        $mobileNavItems[] = [
            'label' => $menuItem->title,
            'icon' => 'none',
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'items' => Category::getItems($menuItem->menu_id, $menuItem->url)
        ];
    } else {
        $navItems[] = [
            'label' => $menuItem->title,
            'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'linkOptions' => [
                'style' => 'padding-left: 29px; padding-right: 30px',
            ],
        ];
        $mobileNavItems[] = [
            'label' => $menuItem->title,
            'icon' => 'none',
            Category::itemsExists($menuItem->menu_id, $menuItem->url) ? : 'url' => [$menuItem->url],
            'active' => in_array(Yii::$app->controller->id, [$menuItem->controller_name]),
            'items' => Category::getItems($menuItem->menu_id, $menuItem->url)
        ];
    }
}
$menu = new Menu();
$sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName(Yii::$app->controller->id)])->orderBy(['sort' => SORT_ASC])->all();
$navSideItems = array();
foreach ($sidebarItems as $key => $sidebarItem)
{
    $navSideItems[] = [
        'label' => $sidebarItem->title,
        'url' => Url::to(['catalog/category', 'category' => $sidebarItem->url]),
        'linkOptions' => [
            'class' => 'icons_fa',
        ],
        'options' => [
            'class' => 'item',
        ],
    ];
}
switch (Yii::$app->controller->id) {
    case 'about':
        $navSideItems = array();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['about/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
    case 'delivery':
        $navSideItems = array();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['delivery/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
    case 'cabinet':
        $navSideItems = array();
        $sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName('catalog')])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['catalog/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
    case 'tenants':
        $navSideItems = array();
        $sidebarItems = Category::find()->where('menu_id = :id', [':id' => $menu->getIdByControllerName('tenants')])->orderBy(['sort' => SORT_ASC])->all();
        foreach ($sidebarItems as $key => $sidebarItem)
        {
            $navSideItems[] = [
                'label' => $sidebarItem->title,
                'url' => Url::to(['tenants/'.$sidebarItem->url]),
                'linkOptions' => [
                    'class' => 'icons_fa',
                ],
                'options' => [
                    'class' => 'item',
                ],
            ];
        }
        break;
}
$newsItems = News::find()->orderBy(['news_id' => SORT_DESC])->limit(3)->all();
//callback
$callback = new Callback();
if ($callback->load(Yii::$app->request->post()))
{
    $callback->date = date('d-m-Y');
    $callback->processed = 'N';
    $callback->type = 'call';
    $callback->save();
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=78db9fac-117a-4f46-be71-9a815e9d8b17" type="text/javascript"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper front_page basket_fly colored banner_auto">
<span id="gray-fon">
    <?= $this->render(
        'header.php', compact(
                'productSearchModel', 'navItems', 'mobileNavItems', 'data'
        )
    ) ?>
    <div class="wraps" id="content" style="min-height: 542.344px;">
        <div class="wrapper_inner front">
            <div class="left_block">
                <?= $this->render(
                    'left_block.php', compact(
                        'navSideItems', 'newsItems'
                    )
                ) ?>
            </div>
            <div class="right_block">
                <?=
                Breadcrumbs::widget(
                    [
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
                ) ?>
                <?=$content?>
            </div>
        </div>
    </div>
</span>
</div>

<?= $this->render(
    'footer.php', compact('menu')
) ?>

<?php if(!Site::isMobile()) :?>
    <?php if(!Yii::$app->user->isGuest) :?>
        <?php if(Cart::inCart(Yii::$app->user->identity->customer_id)) : ?>
            <a href="<?=Url::to(['cabinet/index'])?>" class="cart floating" style="display: inline;">
                <p class="cart-img">
                    <span class="count"><?=Cart::productCount(Yii::$app->user->identity->customer_id)?></span>
                </p>

                <p class="cart-text">
                    <span class="cart-title">Ваша корзина</span>
                    <span> <span class="cart-sum"><?=Cart::cartPrice(Yii::$app->user->identity->customer_id)?></span> руб.</span>
                </p>
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<div class="modal-overlay closed" id="modal-overlay"></div>

<div class="popup modal closed" id="modal" aria-hidden="true" aria-labelledby="modalTitle" aria-describedby="modalDescription" role="dialog">
    <a href="#" class="close" id="close-button"><i></i></a>
    <div class="modal-guts" role="document">
        <label class="form CALLBACK" style="width: 385px;">
            <!--noindex-->
            <div class="form_head">
                <h2>Заказать звонок</h2>
            </div>

            <?php $form = ActiveForm::begin() ?>

            <div class="form_body">
                <?=$form->field($callback, 'name')->textInput()->label('<span>Ваше имя&nbsp;<span class="star">*</span></span>')?>

                <?=$form->field($callback, 'phone')->textInput()->label('<span>Телефон&nbsp;<span class="star">*</span></span>')?>

                <div class="clearboth"></div>
                <div class="clearboth"></div>

            </div>

            <div class="form_footer">
                <?=Html::submitButton('Отправить', ['class' => 'button medium ff'])?>

                <?=Html::resetButton('<span>Закрыть</span>', ['class' => 'button medium transparent', 'id' => 'reset'])?>
            </div>

            <?php ActiveForm::end() ?><!--/noindex-->
        </label>
    </div>
</div>

<script>

    //мобильное меню
    $(document).ready(function () {
        $('.treeview-menu').css({display: 'none'});
        $('.fa-angle-left').addClass('fa-angle-down').removeClass('fa-angle-left');
        $('#mobile-menu').on('click',function () {
            if($('.mobile_menu').css('display') == 'none')
            {
                $('.mobile_menu').css({display: 'block'});
            } else {
                $('.mobile_menu').css({display: 'none'});
            }
        });
        $('.treeview').on('click', function () {
            if ($(this).find('.treeview-menu').css('display') == 'none')
            {
                $(this).find('.treeview-menu').css({display: 'block'});
            } else {
                $(this).find('.treeview-menu').css({display: 'none'});
            }
        });
    });

    //попап заказать звонок
    var modal = document.querySelector("#modal"),
        modalOverlay = document.querySelector("#modal-overlay"),
        closeButton = document.querySelector("#close-button"),
        openButton = document.querySelector("#open-button"),
        openButton1 = document.querySelector("#open-button1"),
        resetButton = document.querySelector("#reset");

    closeButton.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    resetButton.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    openButton.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

    openButton1.addEventListener("click", function() {
        modal.classList.toggle("closed");
        modalOverlay.classList.toggle("closed");
    });

</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
