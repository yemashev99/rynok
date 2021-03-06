<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\Customer',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'noreply-rynok19@yandex.ru',
                'password' => 'Abakan2020',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'catalog' => 'catalog/index',
                'catalog/search' => 'catalog/search',
                'catalog/<category>/<subCategory>/<item>' => 'catalog/view',
                'catalog/<category>/<subCategory>' => 'catalog/item',
                'catalog/<category>' => 'catalog/category',
                'about/news/<news>' => 'about/news-content',
                'about/manufacturers/<manufacturer>' => 'about/manufacturers-content',
                'about/gallery/<item>' => 'about/gallery-content',
                'tenants' => 'tenants/index',
                'tenants/docs' => 'tenants/docs',
                'tenants/callback' => 'tenants/callback',
                'tenants/<tenant>' => 'tenants/content',
                'contact' => 'contact/index',
                'holidays/<id>' => 'holidays/content',
                'holidays' => 'holidays/index',
            ],
        ],
    ],
    'params' => $params,
];
