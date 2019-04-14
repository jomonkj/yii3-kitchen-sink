<?php

/* @var $this yii\web\View */

use idk\app\helpers\Html;

$this->title = 'yiisoft/yii-dataview';
$this->subTitle = 'GridView, ListView, DetailView';

?>

<?= \yii\dataview\GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'pure-table',
    ],
    'columns' => [
        'github' => [
            'format' => 'html',
            'value' => function ($model) {
                return Html::a(Html::o('mark-github'), 'https://github.com/yiisoft/' . $model['id']);
        }],
        'id:text:Package name',
        [
            'label' => 'Build status',
            'format' => 'html',
            'value' => function ($model) {
                $link = "https://travis-ci.{$model['travis']}/yiisoft/{$model['id']}";
                return Html::a(Html::img($link . '.svg?branch=master'), $link);    
            }
        ]
    ],
]) ?>