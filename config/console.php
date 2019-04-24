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
        '__construct()' => function() {
            return [
                [
                    'file' => new \Yii\Log\FileTarget("/tmp/log.txt"),
                ]
            ];
        }
    ],

];