<?php

namespace app\assets;

use yii\web\AssetBundle;


class DependencyGraphAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
   
    public $css = [
        'css/dependency-graph.less'
    ];

    public $js = [
        '//d3js.org/d3.v3.min.js',
        'js/cola.v3.min.js',
        'js/dependency-graph.js',
    ];

    public $depends = [
        AppAsset::class,
    ];
}