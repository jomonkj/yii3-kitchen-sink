<?php


return [
    'app' => [
        'controllerNamespace' => \app\commands::class,
    ],
    'logger' => function () {
        return new \Yiisoft\Log\Logger([new Yiisoft\Log\FileTarget("/tmp/log.txt")]);
    }

];
