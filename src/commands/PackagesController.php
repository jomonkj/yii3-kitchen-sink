<?php

namespace app\commands;

use Psr\Log\LoggerInterface;
use yii\console\Controller;
use yii\helpers\FileHelper;
use Yii\Log\Logger;


class PackagesController extends Controller
{
    private $logger;

    public function __construct($id, $module, Logger $logger)
    {
        parent::__construct($id, $module);

        $this->logger = $logger;

        $this->logger->warning('yes');
        $this->logger->flush();

    }

    /**
     * Generates the packages dependencies graph definition file
     *
     * @param string $destination The final JSON file path
     */
    public function actionD3(): void
    {
        $all = [];

        $this->logger->critical('yeah');
        $this->logger->critical('no');


        $basePath = $this->app->getAlias('@runtime/github/');

        foreach (glob($basePath . '*', GLOB_ONLYDIR) as $packagePath) {
            $package = basename($packagePath);
            $json = json_decode(file_get_contents($basePath . $package . '/composer.json'), true);

            if (isset($json['require'])) {
                foreach ($json['require'] as $req => $version) {
                    if (strpos($req, 'yiisoft/') === 0) {
                        $target = str_replace('yiisoft/', '', $req);
                        // if ($target === 'core') $target = 'yii-core'; // TODO: fix this in packages
                        $all[] = ['source' => $package, 'target' => $target, 'type' => 'require'];
                    }
                }
            }
            if (isset($json['require-dev'])) {
                foreach ($json['require-dev'] as $req => $version) {
                    if (strpos($req, 'yiisoft/') === 0) {
                        // $all[] = ['source' => $package, 'target' => str_replace('yiisoft/', '', $req), 'type' => 'require-dev'];
                    }
                }
            }
        }

        file_put_contents($basePath . 'dependencies.json', json_encode($all));
    }

    /**
     * Generates all dependencies graphics for packages
     *
     * @param string $destination The final JSON file path
     */
    public function actionDependencies(): void
    {
        $basePath = $this->app->getAlias('@runtime/github/');
        $cwd = getcwd();

        foreach ($this->app->params['packages'] as $id => $info) {
            echo "Generating $id\n";

            $packagePath = $basePath . $id;

            chdir($packagePath);
            exec('composer update --ignore-platform-reqs');

            chdir($cwd);
            $cmd = "php vendor/bin/graph-composer export --no-dev runtime/github/$id public/img/dependencies/$id-nodev.svg";
            exec($cmd);
        }
    }

    public function actionPdepend(): void
    {
        $basePath = $this->app->getAlias('@runtime/github');

        foreach ($this->app->params['packages'] as $id => $info) {
            echo "Generating $id\n";

            $imgPath = "public/img/packages/$id";
            FileHelper::createDirectory($imgPath);

            $srcPath = "$basePath/$id/src/";

            $cmd = "./pdepend.phar --summary-xml=$imgPath/summary.xml --jdepend-chart=$imgPath/chart.svg --overview-pyramid=$imgPath/pyramid.svg $srcPath";
            exec($cmd);
        }
    }

}
