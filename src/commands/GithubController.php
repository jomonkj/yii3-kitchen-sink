<?php

namespace app\commands;

use yii\base\Action;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\FileHelper;
use yii\helpers\Console;


class GithubController extends Controller
{
    public $git = '/usr/bin/git';
    
    private $workDir;
    
    public function beforeAction(Action $action): bool
    {
        $this->workDir = $this->app->getAlias('@runtime/github');
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
                Console::error("$package is already cloned.. skipping");
                continue;
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
            echo "pulling $package\n";
            chdir($this->workDir . '/' . $package);
            echo $this->git('checkout .') . "\n";
            echo $this->git('pull') . "\n";
        }

        return ExitCode::OK;
    }

    private function git($command)
    {
        return exec($this->git . ' ' . $command);
    }

}
