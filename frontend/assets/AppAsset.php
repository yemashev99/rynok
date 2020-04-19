<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.min.css',
        'css/default.css',
        'css/style.min.css'
    ];
    public $js = [
        'js/site.js',
        'js/jquery.masonry.min.js',
        'js/init.js',
        'js/mobilyslider.js',
        'js/map.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
