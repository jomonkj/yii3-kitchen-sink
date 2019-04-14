<?php
/* @var $this yii\web\View */

$this->title = 'yiisoft/yii-dataview';
$this->subTitle = 'GridView, ListView, DetailView';

?>

<div class="card-group">
<?= \yii\dataview\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'partials/package',
    'layout' => '{summary}<div class="packages-list">{items}</div>{pager}'
]) ?>
</div>
