<?php

namespace app\widgets;

use Yiisoft\Yii\Bootstrap4\Widget;

class MetricsWidget extends Widget
{
    public $package;
    public $packageDir;
    public $metrics;

    public function run()
    {
        return $this->render('metrics', [
            'packageDir' => $this->packageDir,
            'metrics' => $this->metrics,
            'package' => $this->package,
        ]);
    }
}