<?php

namespace app\helpers;

class Html extends \yii\helpers\Html {

    public static function o(string $name): string
    {
        return static::img(
            "https://cdnjs.cloudflare.com/ajax/libs/octicons/8.2.0/svg/$name.svg",
            ['class' => 'octicon']
        );
    }

    public static function travisBadge(string $id, string $tld): string
    {
        $travisUrl = sprintf('https://travis-ci.%s/yiisoft/%s', $tld, $id);

        return static::a(static::img($travisUrl . '.svg?branch=master'), $travisUrl);
    }

    public static function dependenciesImg(string $id)
    {
        $img = '/img/dependencies/' . $id . '-nodev.svg';
        return static::a(static::img($img, [
            'class' => 'img-fluid',
            'style' => 'max-height: 100px',
            'alt' => "yiisoft/$id dependencies",
        ]), $img);
    }

}