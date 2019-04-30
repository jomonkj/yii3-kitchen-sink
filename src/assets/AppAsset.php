<?php

namespace app\assets;

use Yiisoft\Yii\JQuery\JqueryAsset;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/src/resources/dist/';
    public $baseUrl = '@web';
   
    public $css = [
        'css/app.css'
    ];

    public $js = [
        'js/app.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}
