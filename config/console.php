<?php

return [
    'app' => [
        'controllerNamespace' => \app\commands::class,
    ],
    'file-target' => [
        '__class' => \Yii\Log\FileTarget::class,
        'logFile' => '/tmp/foo.log',
    ],
    'logger' => [
        '__class' => \Yii\Log\Logger::class,
        '__construct()' => [
            [
                'file-target' => \yii\di\Reference::to('file-target'),
            ]
        ]
    ],

];