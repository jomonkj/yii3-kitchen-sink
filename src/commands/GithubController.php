<?php

namespace idk\app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Yii;
use yii\helpers\FileHelper;
use yii\helpers\Console;


class GithubController extends Controller
{
    public $git = '/usr/bin/git';
    
    private $workDir;
    
    public function beforeAction(\yii\base\Action $action): bool
    {
        $this->workDir = Yii::getAlias('@runtime/github');
        FileHelper::createDirectory($this->workDir);
        chdir($this->workDir);

        return true;
    }

    /**
     * Clones all repositories. Use it once.
     */
    public function actionClone()
    {
        $packages = array_keys($this->app->params['packages']);

        foreach ($packages as $package) {
            if (is_dir($this->workDir . '/' . $package)) {
                Console::error("$package is already cloned");
                return ExitCode::CANTCREAT;
            }
            $this->git('clone git@github.com:yiisoft/' . $package);
        }

        return ExitCode::OK;
    }

    /**
     * 
     */
    public function actionPull(array $packages = [])
    {
        if (empty($packages)) {
            $packages = array_keys($this->app->params['packages']);
        }

        foreach ($packages as $package) {
            chdir($this->workDir . '/' . $package);
            echo $this->git('pull') . "\n";
        }

        return ExitCode::OK;
    }

    private function buildDependencies()
    {
        $all = [];

        foreach (glob($this->workDir . '/*') as $packagePath) {
            $package = basename($packagePath);
            $all[$package] = [];

            $json = json_decode(file_get_contents($package . '/composer.json'), true);

            if (isset($json['require'])) {
                foreach ($json['require'] as $req => $version) {
                    if (strpos($req, 'yiisoft/') === 0) {
                        $all[$package][] = str_replace('yiisoft/', '', $req);
                    }
                }
            }
        }

        return $all;
    }

    /**
     * Generates the packages dependencies graphs
     * 
     * @param string $destination The final PNG file path 
     */
    public function actionGraph($destination)
    {
        $dependencies = $this->buildDependencies();
        $objects = [];


        $graph = new \Fhaculty\Graph\Graph();
        $graph->setAttribute('graphviz.graph.ratio', 0.3);
        $graph->setAttribute('graphviz.edge.color', '#444444');
        $graph->setAttribute('graphviz.node.shape', 'plaintext');
        $graph->setAttribute('graphviz.node.color', 'none');
        $graph->setAttribute('graphviz.node.fontsize', 39);
        $graph->setAttribute('graphviz.graph.nodesep', 0.5);
        $graph->setAttribute('graphviz.graph.ranksep', 0.5);

        foreach ($dependencies as $package => $deps) {
            $objects[$package] = $graph->createVertex($package);
        }

        foreach ($dependencies as $package => $deps) {
            foreach ($deps as $dep) {
                if (isset($objects[$dep])) {
                    $objects[$package]->createEdgeTo($objects[$dep]);
                }
            }
        }

        $graphviz = new \Graphp\GraphViz\GraphViz();
        $tmp = $graphviz->createImageFile($graph);

        chdir(Yii::getAlias('@app'));
        echo getcwd();
        copy($tmp, $destination);
    }

    private function git($command)
    {
        return exec($this->git . ' ' . $command);
    }

}
