<?php

use hiqdev\composer\config\Builder;
use yii\di\Container;
use yii\helpers\Yii;

define('YII_DEBUG', true);

(function () {
    require_once __DIR__ . '/../vendor/autoload.php';

    Builder::rebuild();

    // This should NOT be done in production !
    // @see https://github.com/hiqdev/composer-config-plugin#refreshing-config
    \hiqdev\composer\config\Builder::rebuild();

    $container = new Container(require Builder::path('web'));

    Yii::setContainer($container);

    $container->get('app')->run();
})();
