<?php

use app\helpers\Html;
use yii\bootstrap4\Tabs;

/** @var array $package */
/** @var string $readme */
/** @var string $composer */
/** @var bool $hasDependencies */

$id = $package['id'];

$this->title = $id;

$this->params['breadcrumbs'][] = ['url' => ['site/packages'], 'label' => 'Packages'];
$this->params['breadcrumbs'][] = $id;

?>

<h1>yiisoft/<?= $id ?>
    <div class="float-right"></div>
</h1>

<?= Html::travisBadge($id, $package['travis']) ?>



<hr/>

<?= Tabs::widget([
    'items' => [
        [
            'label' => 'pdpend',
            'content' => <<<HTML
<img src="/img/packages/$id/chart.svg"/>
<img src="/img/packages/$id/pyramid.svg"/>
HTML

        ],
        [
            'label' => 'composer.json',
            'content' => Html::tag('pre', $composer),
        ],
        [
            'label' => 'Dependencies',
            'content' => Html::dependenciesImg($id),
        ],
        [
            'label' => 'README',
            'content' => $readme,
        ]
    ]
]) ?>
