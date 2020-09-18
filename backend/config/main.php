<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'login' => 'site/login',
                'menu' => 'menu/index',
                'menu/update/<id:\d+>' => 'menu/update',
                'menu/category/<id:\d+>' => 'menu/category',
                'menu/category-create/<id:\d+>' => 'menu/category-create',
                'menu/category-update/<id:\d+>' => 'menu/category-update',
                'menu/sub-category/<id:\d+>' => 'menu/sub-category',
                'menu/sub-category-create/<id:\d+>' => 'menu/sub-category-create',
                'menu/sub-category-update/<id:\d+>' => 'menu/sub-category-update',
                'catalog' => 'catalog/index',
                'order/<status>/view/<id:\d+>' => 'order/view',
                'about/news/create' => 'about/news-create',
                'about/news/update/<id:\d+>' => 'about/news-update',
                'about/news/<id:\d+>/content' => 'about/news-content',
                'about/gallery/create' => 'about/gallery-create',
                'about/gallery/update/<id:\d+>' => 'about/gallery-update',
                'about/gallery/<id:\d+>/content' => 'about/gallery-content',
                'main' => 'first/index',
                'tenants' => 'tenants/index',
                'contact' => 'contact/index',
                'holidays' => 'holidays/index',
                'callback/processed/<id:\d+>' => 'callback/processed',
                'callback/<type>' => 'callback',
                'export' => 'export/index',
            ],
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'image',
                'name' => 'About'
            ],
        ],
    ],
    'params' => $params,
];
