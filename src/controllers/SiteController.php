<?php

namespace idk\app\controllers;

use yii\db\ConnectionInterface;
use yii\web\Controller;
use yii\helpers\Yii;
use yii\web\Response;
use yii\exceptions\InvalidConfigException;

class SiteController extends Controller
{
    private $db;

    public function __construct($id, $module, ConnectionInterface $db)
    {
        parent::__construct($id, $module);
        $this->db = $db;
    }

    public function actions()
    {
        return [
            'error' => [
                '__class' => \yii\web\ErrorAction::class,
            ],
        ];
    }
    
    public function actionIndex()
    {
        //$articles = $this->db->createCommand('SELECT count(*) FROM article')->queryScalar();
        return $this->render('index');
    }

    public function actionIntro()
    {
        return $this->render('doc', [
            'document' => '1-Intro',
            'title' => 'What is Yii 3?',
            'subTitle' => 'Why was it made, and how',
        ]);
    }

    public function actionPackages()
    {

        $packages = $this->app->params['packages'];
        $dependenciesFile = Yii::getAlias('@runtime/github/dependencies.json');

        $hasDependencies = file_exists($dependenciesFile);

        return $this->render('packages', [
            'title' => 'New composer packages',
            'subTitle' => 'How was Yii 2 split into several packages',
            'packages' => $packages,
            'hasDependencies' => $hasDependencies,
        ]);
    }

    public function actionConfig()
    {
        $pluginOutputPath = Yii::getAlias('@vendor/hiqdev/composer-config-plugin-output');
        $configs = [];
        foreach (glob($pluginOutputPath . '/*.php') as $file) {
            if (strrpos($file, '__rebuild.php')) continue;
            $configs[basename($file)] = require($file);
        }

        $files = array_keys($configs);
        $items = [];
        foreach ($files as $id => $file) {
            ob_start();
            dump($configs[$file]);
            $content = ob_get_clean();
            $items[] = [
                'label' => $file,
                'content' => '<h4>@vendor/hiqdev/composer-config-plugin-output/' .  $file . '</h4>' . $content,
            ];
        }

        return $this->render('config', [
            'items' => $items,
        ]);
    }

    public function actionDependencyGraphData()
    {
        $this->app->response->format = Response::FORMAT_RAW;

        $dependenciesFile = Yii::getAlias('@runtime/github/dependencies.json');

        if (!file_exists($dependenciesFile)) {
            throw new InvalidConfigException("You need to compute dependencies first. See README.md");
        }

        $dependencies = json_decode(file_get_contents($dependenciesFile), true);

        echo "parent@child\n";
        foreach ($dependencies as $dep) {
            echo $dep['source'] . '@' . $dep['target'] . "\n";
        }
        
    }

}