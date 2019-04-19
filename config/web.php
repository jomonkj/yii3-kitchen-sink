<?php

return [
    'app' => [
        'name' => 'Yii3 Kitchen Sink',
        'controllerNamespace' => '\app\controllers',
        'aliases' => [
            '@webroot' => __DIR__ . '/../public',
            '@doc' => __DIR__ . '/../docs',
            '@npm' => __DIR__ . '/../node_modules',
        ],
    ],
    'assetManager' => [
        'appendTimestamp' => true,
        'linkAssets' => true,
        'bundles' => [
        \yii\bootstrap4\BootstrapAsset::class => [
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