<?php

use common\models\Category;
use yii\helpers\Url;

?>

<footer id="footer">
    <div class="footer_inner no_fill">

        <div class="wrapper_inner">
            <div class="footer_bottom_inner">
                <div class="left_block">
                    <div class="copyright">
                        <?=date('Y')?> © Республиканский рынок</div>
                    <div id="bx-composite-banner">
                        <a href="/policy/">Политика конфиденциальности</a>
                        <a href="/polzovatelskoe-soglashenie/">Пользовательское соглашение</a>
                    </div>
                </div>
                <div class="right_block">
                    <div class="middle">
                        <div class="rows_block">
                            <div class="item_block col-75 menus">
                                <div class="submenu_top rows_block">
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="<?=Url::to(['about/index'])?>" class="dark_link">О рынке</a></div>
                                    </div>
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="<?=Url::to(['tenants/index'])?>" class="dark_link">Арендаторам</a></div>
                                    </div>
                                    <div class="item_block col-3">
                                        <div class="menu_item"><a href="<?=Url::to(['delivery/index'])?>" class="dark_link">Как купить</a></div>
                                    </div>
                                </div>
                                <div class="rows_block">
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <?php foreach ($about = Category::find()->where(['menu_id' => $menu->getIdByControllerName('about')])->orderBy(['sort' => SORT_ASC])->all() as $item) : ?>
                                                <li class="menu_item"><a href="<?=Url::to(['about/'.$item->url])?>" class="dark_link"><?=$item->title?></a></li>
                                            <?php endforeach; ?>
                                        </ul>											</div>
                                    <div class="item_block col-3"></div>
                                    <div class="item_block col-3">
                                        <ul class="submenu">
                                            <?php foreach ($about = Category::find()->where(['menu_id' => $menu->getIdByControllerName('delivery')])->orderBy(['sort' => SORT_ASC])->all() as $item) : ?>
                                                <li class="menu_item"><a href="<?=Url::to(['delivery/'.$item->url])?>" class="dark_link"><?=$item->title?></a></li>
                                            <?php endforeach; ?>
                                        </ul>											</div>
                                </div>
                            </div>
                            <div class="item_block col-4 soc">
                                <div class="soc_wrapper">
                                    <div class="phones">
                                        <div class="phone_block">
													<span class="phone_wrap">
														<span class="icons fa fa-phone"></span>
														<span>
															<span style="font-size: 14pt;"><span><b>8 (800) 444-39-38</b></span></span><br>
 телефон доставки<br>
 <a style="font-size: 10pt; color: #7ba02e;" href="mailto:administrator@rynok72.ru">direkciya2011@yandex.ru</a>														</span>
													</span>
                                            <span class="order_wrap_btn">
														<span class="callback_btn" id="open-button1">Заказать звонок</span>
													</span>
                                        </div>
                                    </div>
                                    <div class="social_wrapper">
                                        <div class="social">

                                            <div class="small_title">Мы в социальных сетях:</div>
                                            <div class="links rows_block soc_icons">
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="ВКонтакте" class="vk"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="Одноклассники" class="odn"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="Facebook" class="fb"></a>
                                                </div>
                                                <div class="item_block">
                                                    <a href="#" target="_blank" title="Instagram" class="inst"></a>
                                                </div>
                                            </div>												</div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile_copy">
                <div class="copyright">
                    <?=date('Y')?> © Республиканский Рынок</div>
                <span class="pay_system_icons">
	<i title="MasterCard" class="mastercard"></i>
<i title="Visa" class="visa"></i>
<i title="Yandex" class="yandex_money"></i>
<i title="WebMoney" class="webmoney"></i>
<i title="Qiwi" class="qiwi"></i></span>					</div>
        </div>
    </div>
</footer>
