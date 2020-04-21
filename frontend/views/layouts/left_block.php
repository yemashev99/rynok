<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;

?>

<?= Nav::widget([
    'options' => ['class' => 'left_menu'],
    'items' => $navSideItems,
]) ?>
<div id="main-left-0">
    <b>
        <a class="main-link" href="<?=Url::to(['about/gallery'])?>">Видео: ярмарки, производители, новости</a>
    </b>
</div>
<div id="main-left-1">
    <iframe width="195" height="110" src="https://www.youtube.com/embed/ppsYaWWtod8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
</div>
<?/*TODO: news*/?>
<?php if (!in_array('news', explode('/', Yii::$app->request->pathInfo))) : ?>
    <div class="news_blocks front">
        <div class="top_block">
            <div class="title_block">Новости</div>
            <a href="<?=Url::to(['about/news'])?>">Все новости</a>
            <div class="clearfix"></div>
        </div>
        <div class="info_block">
            <div class="news_items">
                <?php foreach ($newsItems as $item) : ?>
                    <div id="<?=$item->news_id?>" class="item box-sizing dl">
                        <div class="image">
                            <a href="<?=Url::to(['about/news-content', 'news' => $item->url])?>">
                                <img class="img-responsive" src="<?=Yii::getAlias('@web').'/'.$item->image?>" alt="<?=$item->title?>" title="<?=$item->title?>">
                            </a>
                        </div>
                        <div class="info">
                            <div class="date"><?=$item->date?></div>
                            <div class="info-text"><a class="name dark_link" href="<?=Url::to(['about/news-content', 'news' => $item->url])?>"><?=$item->title?></a></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
