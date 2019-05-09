<?php

namespace app\helpers;

use Yiisoft\Strings\Inflector;
use yii\exceptions\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use League\CommonMark\CommonMarkConverter;

class DocHelper
{
    private static $redirections = [
        '2-Configuration' => ['site/config'],
        '3-Packages' => ['site/packages'],
    ];

    /**
     * @param $file
     * @return string
     * @throws InvalidConfigException
     */
    public static function doc($file): string
    {
        if (!file_exists($file)) {
            throw new InvalidConfigException("Cannot find $file");
        }

        return self::renderFile($file);
    }

    private static function renderFile($path): string
    {
        $html = (new CommonMarkConverter())->convertToHtml(file_get_contents($path));

        $html = preg_replace_callback('!<a href="([^"]+).md"!', static function($match) {
             return isset(self::$redirections[$match[1]]) ? '<a href="' . Url::to(self::$redirections[$match[1]]) . '"' : $match[0];
        }, $html);

        $html = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', static function($matches ) {
            if (  stripos( $matches[0], 'id=' ) === false) :
                $matches[0] = $matches[1] . $matches[2] . ' id="' . Inflector::slug( $matches[3] ) . '">' . $matches[3] . $matches[4];
            endif;
            return $matches[0];
        }, $html );

        return Html::tag('div', $html, ['class' => 'md']);
    }
}
