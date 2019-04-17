<?php

namespace idk\app\controllers;

use idk\app\helpers\DocHelper;
use yii\db\ConnectionInterface;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
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
        $readme = DocHelper::doc($this->app->getAlias('@app/README.md'));
        return $this->render('index', [
            'readme' => $readme,
        ]);
    }

    public function actionDocs()
    {
        $buffer = '';
        foreach (glob($this->app->getAlias('@doc/*.md')) as $doc) {
            $buffer .= DocHelper::doc($doc);
        }
        return $this->render('docs', [
            'buffer' => $buffer
        ]);
    }

    public function actionPackages()
    {

        $sections = ArrayHelper::index($this->app->params['packages'], 'id', 'section');
        $dependenciesFile = $this->app->getAlias('@runtime/github/dependencies.json');

        $hasDependencies = file_exists($dependenciesFile);

        return $this->render('packages', [
            'title' => 'New composer packages',
            'subTitle' => 'How was Yii 2 split into several packages',
            'sections' => $sections,
            'hasDependencies' => $hasDependencies,
        ]);
    }

    public function actionDependencyGraphData()
    {
        $this->app->response->format = Response::FORMAT_RAW;

        $dependenciesFile = $this->app->getAlias('@runtime/github/dependencies.json');

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