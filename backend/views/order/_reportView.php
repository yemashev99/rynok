<?php

use common\models\Cart;
use common\models\OrderStatus;

$i = 1;

?>
<div>
    <table>
        <tr>
            <td>
                Дата
            </td>
            <td style="border-bottom: 1px solid black;">
                <?=date('j.m.Y H:i:s', $order->created_at)?>
            </td>
            <td>
                <b>Заявка №</b>
            </td>
            <td>
                <?=$order->order_id?>
            </td>
        </tr>
    </table>
    <br>
    <table border="1" style="border-collapse:collapse" cellpadding="6">
        <tr>
            <td>
                № п/п
            </td>
            <td>
                Наименование товара
            </td>
            <td>
                Кол-во
            </td>
            <td>
                Цена
            </td>
        </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>
                    <?php echo $i; $i++; ?>
                </td>
                <td>
                    <?=$item->product->title ?>
                </td>
                <td>
                    <?=$item->quantity?> <?=$item->product->measure?>
                </td>
                <td>
                    <?=$item->product->price * $item->quantity?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>
                <?php echo $i;?>
            </td>
            <td>
                Услуга по доставке
            </td>
            <td>
                1 шт
            </td>
            <td>
                200
            </td>
        </tr>
        <tr>
            <td style="border-right: none;">

            </td>
            <td style="border-left: none; border-right: none;">
                Итого:
            </td>
            <td style="border-left: none">

            </td>
            <td>
                <?=Cart::cartPrice($order->customer_id, 'admin', 'new', 'Y')?>
            </td>
        </tr>
    </table>
    <br>
    <table border="0" style="border-bottom: 1px solid black;">
        <tr>
            <td>Адрес доставки: <?=$order->customer->address?></td>
        </tr>
    </table>
</div>
<br><br>
<br>
<?php $i = 1; ?>
<div>
    <table>
        <tr>
            <td>
                Дата
            </td>
            <td style="border-bottom: 1px solid black;">
                <?=date('j.m.Y H:i:s', $order->created_at)?>
            </td>
            <td>
                <b>Заявка №</b>
            </td>
            <td>
                <?=$order->order_id?>
            </td>
        </tr>
    </table>
    <table border="0" style="margin:0 0 0 auto">
        <tr>
            <td style="padding-right: 25%">
                <i>Оплата	наличка (б/нал)</i>
            </td>
        </tr>
    </table>
    <table border="1" style="border-collapse:collapse" cellpadding="6">
        <tr>
            <td>
                № п/п
            </td>
            <td>
                Наименование товара
            </td>
            <td>
                Кол-во
            </td>
            <td>
                Цена
            </td>
            <td style="border-top: none">
                Цена
            </td>
            <td style="border-top: none">
                ИП или ООО
            </td>
        </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>
                    <?php echo $i; $i++; ?>
                </td>
                <td>
                    <?=$item->product->title ?>
                </td>
                <td>
                    <?=$item->quantity?> <?=$item->product->measure?>
                </td>
                <td>
                    <?=$item->product->price * $item->quantity?>
                </td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>
                <?php echo $i;?>
            </td>
            <td>
                Услуга по доставке
            </td>
            <td>
                1 шт
            </td>
            <td>
                200
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="border-right: none;">

            </td>
            <td style="border-left: none; border-right: none;">
                Итого:
            </td>
            <td style="border-left: none">

            </td>
            <td>
                <?=Cart::cartPrice($order->customer_id, 'admin', 'new', 'Y')?>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <table border="0">
        <tr>
            <td style="border-bottom: 1px solid black;">Адрес доставки: <?=$order->customer->address?></td>
            <td style="padding-left: 5%">км</td>
            <td>_______________</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td style="padding-right: 20%;padding-left: 15%;">_________________</td>
            <td>_________________</td>
        </tr>
        <tr>
            <td style="padding-right: 20%;padding-left: 22%; font-size: 10px"><i>подпись</i></td>
            <td style="font-size: 10px; padding-left: 7%;"><i>подпись</i></td>
        </tr>
    </table>
</div>
<br><br>
<br>
<?php $i = 1; ?>
<div>
    <table>
        <tr>
            <td>
                Дата
            </td>
            <td style="border-bottom: 1px solid black;">
                <?=date('j.m.Y H:i:s', $order->created_at)?>
            </td>
            <td>
                <b>Заявка №</b>
            </td>
            <td>
                <?=$order->order_id?>
            </td>
        </tr>
    </table>
    <table border="0" style="margin:0 0 0 auto">
        <tr>
            <td style="padding-right: 25%">
                <i>Оплата	наличка (б/нал)</i>
            </td>
        </tr>
    </table>
    <table border="1" style="border-collapse:collapse" cellpadding="6">
        <tr>
            <td>
                № п/п
            </td>
            <td>
                Наименование товара
            </td>
            <td>
                Кол-во
            </td>
            <td>
                Цена
            </td>
            <td style="border-top: none">
                Цена
            </td>
            <td style="border-top: none">
                ИП или ООО
            </td>
        </tr>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>
                    <?php echo $i; $i++; ?>
                </td>
                <td>
                    <?=$item->product->title ?>
                </td>
                <td>
                    <?=$item->quantity?> <?=$item->product->measure?>
                </td>
                <td>
                    <?=$item->product->price * $item->quantity?>
                </td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td>
                <?php echo $i;?>
            </td>
            <td>
                Услуга по доставке
            </td>
            <td>
                1 шт
            </td>
            <td>
                200
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="border-right: none;">

            </td>
            <td style="border-left: none; border-right: none;">
                Итого:
            </td>
            <td style="border-left: none">

            </td>
            <td>
                <?=Cart::cartPrice($order->customer_id, 'admin', 'new', 'Y')?>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <table border="0">
        <tr>
            <td style="border-bottom: 1px solid black;">Адрес доставки: <?=$order->customer->address?></td>
            <td style="padding-left: 5%">км</td>
            <td>_______________</td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td style="padding-right: 20%;padding-left: 15%;">_________________</td>
            <td>_________________</td>
        </tr>
        <tr>
            <td style="padding-right: 20%;padding-left: 22%; font-size: 10px"><i>подпись</i></td>
            <td style="font-size: 10px; padding-left: 7%;"><i>подпись</i></td>
        </tr>
    </table>
</div>
