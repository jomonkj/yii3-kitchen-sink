<?php

namespace idk\app\helpers;

class Html extends \yii\helpers\Html {

    public static function o($name)
    {
        return static::img(
            "https://cdnjs.cloudflare.com/ajax/libs/octicons/8.2.0/svg/$name.svg",
            ['class' => 'octicon']
        );
    }

}