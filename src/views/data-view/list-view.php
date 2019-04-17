<?php

/** @var $this yii\web\View */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'yiisoft/yii-dataview';
$this->subTitle = 'GridView, ListView, DetailView';

use yii\activerecord\data\ActiveDataProvider;
use yii\dataview\ListView; ?>

<div class="card-group">
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'partials/package',
    'layout' => '{summary}<div class="packages-list">{items}</div>{pager}'
]) ?>
</div>
