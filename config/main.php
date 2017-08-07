<?php
Yii::setAlias('bot', dirname(__DIR__) . '/bot');
Yii::setAlias('storage', dirname(__DIR__) . '/console/modules/storage');

$config = [
    'id' => 'app',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'bot\controllers',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'modules' => [
        'storage' => [
            'class' => storage\Module::className(),
        ],
    ],

];

return $config;
