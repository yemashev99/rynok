<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Республиканский Селькохозяйственный Рынок';
?>
<div class="middle">
    <div class="slider slider1">
        <div class="sliderContent">
            <?php foreach ($gallery as $item) : ?>
                <div class="item">
                    <?=Html::img(Yii::getAlias('@web').'/'.$item->image, ['alt' => '', 'width' => '100%'])?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="center-title">
        <h2>«Сельскохозяйственный» приглашает за покупками!</h2>
    </div>
    <div class="text" style="text-align: left;">
        <p>«Сельскохозяйственный» за здоровое и разнообразное  питание! Свежее мясо представлено не только традиционными свининой и говядиной. Баранина, телятина, оленина и крольчатина, маралятина, большой выбор мясных деликатесов и субпродуктов. Порадует и выбор домашней птицы: кроме традиционной курятины, республиканские  фермеры завозят мясо гусей, уток, индеек, диетических перепелок.</p>
    </div>
    <div class="main-category-block">
        <div class="row">
            <?php foreach ($icons as $icon) : ?>
                <div class="col-md-2" style="<?=$icon->options?>">
                    <?=Html::a(
                        Html::img(Yii::getAlias('@web').'/'.$icon->image_name),
                        Url::to(['catalog/category', 'category' => $icon->category->url])
                    )?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="main-category-block-mobile" style="display: none;">
        <?=Html::img(Yii::getAlias('@web').'/img/main.png', ['height' => '125px', 'width' => '340px'])?>
    </div>
    <div class="text" style="text-align: left; padding-bottom: 20px;">
        <p>«Сельскохозяйственный» - море гастрономического удовольствия. Для покупателей рыбы - огромный ассортимент. На прилавках в изобилии    местная форель, щука, окунь, пелядь, хариус. Всегда свежий улов - карп, морской и речной окунь, осётр и горбуша, камбала, кижуч, ряпушка, скумбрия, голец, сельдь, треска, палтус, сырок, хек, пикша, сибас, лемонема, семга и нерка, а так же муксун и нельма и так далее. </p>
    </div>
    <div class="center-title">
        <h2>О рынке</h2>
    </div>
    <div class="text" style="text-align: left; padding-bottom: 20px;">
        <p>Сельскохозяйственный рынок - стал по праву первым на конкурсе «Торговля России», в номинации «Лучший розничный рынок»</p>
        <?=Html::img(Yii::getAlias('@web').'/img/XXXL.jpg', ['width' => '35%', 'height' => '10%', 'align' => 'left', 'style' => 'padding-right: 10px'])?>
        <p>Мы гордимся нашим предприятием, которое сегодня стремится к лучшему, сохраняя традиции, не забывая о современных тенденциях. Фермеры Хакасии предлагают нашим покупателям  экологически чистую, вкусную продукцию частных подворий. Подбор всех поставщиков ведется тщательным образом, а перед продажей продукты проходят санитарный контроль в независимой лаборатории, здесь же на месте.</p>
        <p>Мы знаем, как для вас важен качественный сервис. В просторном двухэтажном здании рынка комфортно покупать: удобная транспортная развязка, большая парковочная зона, 2 центральных входа, продуктовые тележки, контрольные весы, банкоматы, терминал, информационные указатели. На втором этаже рынка представлены товары и ряд необходимых бытовых услуг для всей семьи.</p>
        <p>Свежие фрукты и овощи, продающиеся на рынке, <b>проходят экологическую экспертизу</b> на содержание нитратов и вредных веществ.</p>
    </div>
    <div class="center-title">
        <h2>Доставка свежих продуктов к вашему столу !</h2>
    </div>
    <div class="text" style="text-align: left; padding-bottom: 20px;">
        <?=Html::img(Yii::getAlias('@web').'/img/cur.jpg', ['width' => '35%', 'height' => '10%', 'align' => 'right'])?>
        <p>Вашему вниманию представлены высококачественные продукты, поставляемые ведущими фермерскими хозяйствами региона. Закажите их, и у вас будет великолепная возможность стать первоклассным «шеф-поваром», которого ваши гости искренне и от души поблагодарят за отличный праздничный стол!</p>
        <p>Республиканский  рынок уже давно заслужил репутацию поставщика продуктов безупречного качества. Нашу продукцию приобретают как жители города, так и организации. Мы осуществляем доставку:</p>
        <ul class="main-list">
            <li>частным лицам на дом</li>
            <li>компаниям и организациям, планирующим гастрономические удовольствия на корпоративах, семинарах, выездных мероприятиях за город и т.д.</li>
        </ul>
    </div>
    <div class="center-title">
        <h2>Вкусные подарки!</h2>
    </div>
    <div class="text" style="text-align: left; padding-bottom: 20px;">
        Для романтиков мы приготовили еще одно «вкусное» предложение – корзину для романтического ужина,  подарка.  Ее содержимое может варьироваться в зависимости от ваших вкусов и предпочтений. Например, это могут быть свежие аппетитные морепродукты, мясо для шашлыка, различные сорта сыров и икры,  фруктов. Разумеется, корзина будет отлично выглядеть, ее дизайн мы оформим в соответствии с вашими пожеланиями!
    </div>
    <div class="center-title">
        <h2>Наши преимущества</h2>
    </div>
    <div class="text" style="text-align: left; padding-bottom: 20px;">
        <?=Html::img(Yii::getAlias('@web').'/img/9710886731213027_589e.jpg', ['width' => '27%', 'align' => 'right', 'style' => 'padding-left: 10px'])?>
        <ul class="main-list">
            <li>свежие фермерские экологически чистые продукты;</li>
            <li>широчайший ассортимент деликатесных ингредиентов для праздничных блюд;</li>
            <li>оперативная доставка как частным клиентам, так и организациям;</li>
            <li>доставка корзины для романтического ужина.</li>
        </ul>
    </div>
    <div class="center-title">
        <h2>Условия оплаты</h2>
    </div>
    <div class="text" style="text-align: left; padding-bottom: 20px;">
        Оплачивайте покупку любым подходящим для Вас способом:
        <ul class="main-list">
            <li>Наличные. Оплата осуществляется после того, как Вы ознакомились с товарами и приняли решение о покупке. Деньги передаются сотруднику службы доставки  Республиканского Сельскохозяйственного рынка, который предоставляет кассовый и товарный чеки.</li>
            <li>Пластиковые карты. Безналичная оплата банковской картой сотруднику службы доставки через терминал при получении заказа.</li>
            <!--<li>Онлайн-оплата на сайте. Для выбора оплаты товара с помощью банковской карты на соответствующей странице необходимо нажать кнопку «Оплата заказа банковской картой».</li>-->
        </ul>
    </div>
    <div class="vrez1" style="margin-bottom:8%">
        Чтобы заказать отборные свежие продукты к праздничному столу, воспользуйтесь возможностями сайта или позвоните нам по телефону первой продовольственной линией рынка 8 (800)-444-39-38
    </div>
    <div class="center-title">
        <h2>Последние новости</h2>
    </div>
    <div class="masonry_area masonry" style="position: relative;">
        <?php foreach ($newsItems as $newsItem) : ?>
            <div class="col-md-5 masonry-brick" style="padding-left: 0; padding-right: 0">
                <article id="<?=$newsItem->news_id?>" class="post-<?=$newsItem->news_id?> post type-post status-publish format-standard has-post-thumbnail hentry category-1">
                    <div class="thumbnails">
                        <?=Html::a(
                            Html::img(Yii::getAlias('@web').'/'.$newsItem->image,
                                [
                                    'width' => '750',
                                    'height' => '450',
                                    'class' => 'post-thumbnail img-responsive wp-post-image',
                                    'alt' => '',
                                ]
                            ),
                            ['about/news-content', 'news' => $newsItem->url],
                            ['title' => $newsItem->title]
                        )?>
                    </div>
                    <div class="padding-content">
                        <header class="entry-header">
                            <h1 class="entry-title text-uppercase">
                                <?=Html::a($newsItem->title, ['about/news-content', 'news' => $newsItem->url], ['rel' => 'bookmark'])?>
                            </h1>
                        </header>
                        <div class="entry-content">
                            <p>
                                <?=$newsItem->description?>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
    <?=Html::a('Все новости', ['about/news'], ['class' => 'btn btn-default'])?>
</div>

<script type="text/javascript">
    var isMobile = false;
    $(document).ready(function(){
        if ($('body').width() <= 470) {
            isMobile = true;
        }
        if (!isMobile) {
            $('.masonry_area').masonry({
// указываем элемент-контейнер в котором расположены блоки для динамической верстки
            itemSelector: '.masonry-brick',
// указываем класс элемента являющегося блоком в нашей сетке
            singleMode: false,
// true - если у вас все блоки одинаковой ширины
            isResizable: true,
// перестраивает блоки при изменении размеров окна
            isAnimated: true,
// анимируем перестроение блоков
            animationOptions: {
                queue: false,
                duration: 500
            }
// опции анимации - очередь и продолжительность анимации
        });
        }
    });
</script>
