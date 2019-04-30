<?php

return [
    'app' => [
        'name' => 'Yii3 Kitchen Sink',
        'bootstrap' => ['debug' => 'debug'],
        'controllerNamespace' => '\app\controllers',
        'aliases' => [
            '@webroot' => __DIR__ . '/../public',
            '@doc' => __DIR__ . '/../docs',
            '@npm' => __DIR__ . '/../node_modules',
        ],
        'modules' => [
            'gii' => [
                '__class' => \Yiisoft\Yii\Gii\Module::class,
                'allowedIPs' => ['[::1]'],
            ],
        ],

    ],
    'assetManager' => [
        'appendTimestamp' => true,
        'linkAssets' => true,
        'bundles' => [
        \Yiisoft\Yii\Bootstrap4\BootstrapAsset::class => [
                'css' => [],
            ]
        ]
    ],
    'view' => [
        '__class' => app\components\View::class,

    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            'site/packages/<package:[-\w]+>' => 'site/package',
        ]
    ],
];