<?php

namespace app\models;

use yii\activerecord\ActiveRecord;
use yii\web\Linkable;

class Package extends ActiveRecord implements Linkable
{
    public static function tableName()
    {
        return 'package';
    }

    public function rules()
    {
        return [
            ['id', 'unique'],
            [['name', 'travis', 'section'], 'string'],
            ['travis', 'default', 'value' => 'com'],
            ['section', 'default', 'value' => 'Default'],
        ];
    }

    /**
     * Returns a list of links.
     *
     * Each link is either a URI or a [[Link]] object. The return value of this method should
     * be an array whose keys are the relation names and values the corresponding links.
     *
     * If a relation name corresponds to multiple links, use an array to represent them.
     *
     * For example,
     *
     * ```php
     * [
     *     'self' => 'http://example.com/users/1',
     *     'friends' => [
     *         'http://example.com/users/2',
     *         'http://example.com/users/3',
     *     ],
     *     'manager' => $managerLink, // $managerLink is a Link object
     * ]
     * ```
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            'self' => 'http://www.google.com',
        ];
    }
}