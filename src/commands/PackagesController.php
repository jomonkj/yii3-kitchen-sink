<?php

namespace idk\app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Yii;
use yii\helpers\FileHelper;
use yii\helpers\Console;


class PackagesController extends Controller
{

    /**
     * Generates the packages dependencies graph definition file
     * 
     * @param string $destination The final JSON file path 
     */
    public function actionD3()
    {
        $all = [];

        $basePath = Yii::getAlias('@runtime/github/');

        foreach (glob($basePath . '*', GLOB_ONLYDIR) as $packagePath) {
            $package = basename($packagePath);
            $json = json_decode(file_get_contents($basePath . $package . '/composer.json'), true);

            if (isset($json['require'])) {
                foreach ($json['require'] as $req => $version) {
                    if (strpos($req, 'yiisoft/') === 0) {
                        $all[] = ['source' => $package, 'target' => str_replace('yiisoft/', '', $req), 'type' => 'require'];
                    }
                }
            }
            if (isset($json['require-dev'])) {
                foreach ($json['require-dev'] as $req => $version) {
                    if (strpos($req, 'yiisoft/') === 0) {
                        $all[] = ['source' => $package, 'target' => str_replace('yiisoft/', '', $req), 'type' => 'require-dev'];
                    }
                }
            }
        }

        file_put_contents($basePath . 'dependencies.json', json_encode($all));
    }

}
