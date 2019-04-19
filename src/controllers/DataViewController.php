<?php

namespace app\controllers;

use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DataViewController extends Controller
{

    public function actionIndex()
    {
        $dataProvider = new ArrayDataProvider();
        $dataProvider->allModels = $this->app->params['packages'];

        return $this->render('grid-view', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListView()
    {
        $dataProvider = new ArrayDataProvider();
        $dataProvider->allModels = $this->app->params['packages'];

        return $this->render('list-view', [
            'dataProvider' => $dataProvider,
        ]);
    }

}