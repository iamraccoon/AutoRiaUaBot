<?php
Yii::setAlias('bot', dirname(__DIR__) . '/bot');
Yii::setAlias('glossary', dirname(__DIR__) . '/console/modules/glossary');
Yii::setAlias('httpclient', dirname(__DIR__) . '/common/components/httpclient');
Yii::setAlias('app/migrations', dirname(__DIR__) . '/console/migrations');

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
        'autoRia' => [
            'class' => httpclient\AutoRia::className(),
            'baseUrl' => 'https://developers.ria.com/auto',
            'apiKey' => 'dBkMcJoWz5OD1k6CH1AERgUMFNQwXlNNZfiteIwg'
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'glossary' => [
            'class' => glossary\Module::className(),
        ],
    ],

];

return $config;
