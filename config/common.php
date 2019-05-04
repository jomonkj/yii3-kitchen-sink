<?php

return [
    'app' => [
        'basePath' => dirname(__DIR__) . '/src',
        'aliases' => [
            '@app' => dirname(__DIR__),
            '@github' => dirname(__DIR__) . '/runtime/github',
            '@vendor' => dirname(__DIR__) . '/vendor',
            '@runtime' => dirname(__DIR__) . '/runtime',
        ]
    ],
    'db' => [
        '__class'   => \yii\db\Connection::class,
        'dsn'       => 'sqlite:' . dirname(__DIR__) . '/db.sqlite',
    ],
    'cache' => [
        '__class' => \Yiisoft\Cache\Cache::class,
        '__construct()' => [
               '__class' => Yiisoft\Cache\ArrayCache::class,
           ],
    ],
    'user' => [
        '__class' => yii\web\User::class,
        'identityClass' => \app\models\User::class,
    ],
];
