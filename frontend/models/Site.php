<?php


namespace frontend\models;


use common\models\Cart;
use Yii;
use yii\base\Model;

class Site extends Model
{
    public static function isMobile() {
        $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        foreach ($mobile_agent_array as $value) {
            if (strpos($agent, $value) !== false) return true;
        }
        return false;
    }

    public static function count()
    {
        if (!Yii::$app->user->isGuest){
            $cart['count'] = Cart::productCount(Yii::$app->user->identity->customer_id);
            $cart['price'] = Cart::cartPrice(Yii::$app->user->identity->customer_id);
        } else {
            $cart['count'] = 0;
            $cart['price'] = 0;
        }
        return $cart;
    }
}