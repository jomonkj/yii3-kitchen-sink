<?php

return [
    'app' => [
        'basePath' => dirname(__DIR__) . '/src',
        'aliases' => [
            '@app' => dirname(__DIR__),
            '@vendor' => dirname(__DIR__) . '/vendor',
        ]
    ],
    'db' => [
        '__class'   => \yii\db\Connection::class,
        'dsn'       => 'mysql:dbname=' . $params['db.name']
            . (!empty($params['db.host']) ? (';host=' . $params['db.host']) : '')
            . (!empty($params['db.port']) ? (';port=' . $params['db.port']) : ''),
        'username'  => $params['db.user'],
        'password'  => $params['db.password'],
    ],
    'logger' => [
        '__class' => \Yii\Log\Logger::class,
        '__construct()' => [
            'targets' => [
                \Yii\Log\FileTarget::class,
            ],
        ],
    ],
    'cache' => [
        '__class' => \yii\cache\Cache::class,
        '__construct()' => [
               '__class' => yii\cache\ArrayCache::class,
           ],
    ],
    'user' => [
        '__class' => yii\web\User::class,
        'identityClass' => \idk\app\models\User::class,
    ],
];
