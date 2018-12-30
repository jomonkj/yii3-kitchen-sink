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

    private function git($command)
    {
        return exec($this->git . ' ' . $command);
    }

}
