<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'Teleport',
    'name' => 'Teleport',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'user' => [
            'class' => dektrium\user\Module::class,
            'controllerMap' => [
                'security' => 'app\controllers\user\SecurityController'
            ],
        ],
    ],
    'components' => [
        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => [
                // here is the list of clients you want to use
                'vkontakte' => [
                    'class'        => 'dektrium\user\clients\VKontakte',
                    'clientId'     => 'vk_client_id',
                    'clientSecret' => 'vk_client_secret',
                ],
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => 'google_client_id',
                    'clientSecret' => 'google_client_secret',
                ],
                'yandex' => [
                    'class'        => 'dektrium\user\clients\Yandex',
                    'clientId'     => 'yandex_client_id',
                    'clientSecret' => 'yandex_client_secret'
                ],
            ],
        ],
        'request' => [
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Gd4M0jOnBoT7-OEjGnPXxeYJyoEEtQ4a',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => dektrium\user\models\User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => [
                        '@dektrium/user/views'
                    ],
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
