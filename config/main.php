<?php

require(__DIR__ . '/alias.php');

$keys = require(__DIR__ . '/keys.php');

$config = [
    'id' => 'app',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'bot\controllers',
    'components' => [
        'cache' => [
            'class' => \yii\redis\Cache::className()
        ],
        'redis' => [
            'class' => \yii\redis\Connection::className(),
            'hostname' => '127.0.0.1',
            'database' => 1,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'autoRia' => [
            'class' => httpclient\AutoRia::className(),
            'baseUrl' => 'https://developers.ria.com/auto',
            'apiKey' => YII_ENV_DEV ? $keys['dev']['riaApiKey'] : $keys['prod']['riaApiKey']
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'glossary' => [
            'class' => glossary\Module::className(),
        ],
        'search' => [
            'class' => search\Module::className(),
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
