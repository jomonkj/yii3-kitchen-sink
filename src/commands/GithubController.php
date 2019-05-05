<?php

namespace app\commands;

use yii\base\Action;
use Yiisoft\Yii\Console\Controller;
use Yiisoft\Yii\Console\ExitCode;
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
            echo $this->git('checkout .')[0] . "\n";
            echo $this->git('checkout master')[0] . "\n";
            echo $this->git('pull')[0] . "\n";
        }

        return ExitCode::OK;
    }

    /**
     *
     */
    public function actionStatus(array $packages = [])
    {
        if (empty($packages)) {
            $packages = array_keys($this->app->params['packages']);
        }

        foreach ($packages as $package) {
            chdir($this->workDir . '/' . $package);
            [$status, $out] =  $this->git('status');

            $branch = str_replace('On branch ', '', $out[0]);

            if ($status !== 'nothing to commit, working tree clean') {
                echo "$package has changes\n";
            }

            if ($branch !== 'master') {
                echo "$package is on branch $branch\n";
            }
        }

        return ExitCode::OK;
    }

    private function git($command)
    {
        return [trim(exec($this->git . ' ' . $command, $out)), $out];
    }

}
