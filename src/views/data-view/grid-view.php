<?php

/** @var $this yii\web\View */
/** @var ActiveDataProvider $dataProvider */

use app\helpers\Html;
use yii\activerecord\data\ActiveDataProvider;
use yii\dataview\GridView;

$this->title = 'yiisoft/yii-dataview';
$this->subTitle = 'GridView, ListView, DetailView';

?>

<div class="row">
    <div class="col-md-4">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
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
    </div>
</div>
