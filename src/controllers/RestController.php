<?php

namespace app\controllers;

use app\models\Package;
use Yiisoft\Yii\Rest\ActiveController;

class RestController extends ActiveController
{
    public function __construct($id, $module)
    {
        parent::__construct($id, $module, Package::class);
    }

}