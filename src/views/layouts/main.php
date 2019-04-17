<?php

use idk\app\assets\AppAsset;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Yii;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->title ?: 'Yii 3 Kitchen Sink' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap"  id="app">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/img/yii.png" style="height: 30px; margin-right: 1rem"/> Yii3 Kitchen Sink',
        'brandUrl' => Yii::getApp()->homeUrl,
        'options' => [
            'class' => 'navbar-dark bg-dark navbar-expand-lg',
        ],
    ]);

    $menuItems = [
        ['label' => 'Documentation', 'url' => ['site/docs']],
        ['label' => 'Packages', 'url' => ['site/packages']],
        // Tests
        ['label' => 'yiisoft/yii-dataview', 'items' => [
            ['label' => 'GridView', 'url' => ['data-view/index']],
            ['label' => 'ListView', 'url' => ['data-view/list-view']],
        ]],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="float-left"><a href="https://github.com/machour/yii3-kitchen-sink">Source Code</a></p>

        <p class="float-right">Powered by <a href="https://www.yiiframework.com/" target="_blank" rel="noopener">Yii</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>