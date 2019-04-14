<?php

namespace idk\app\controllers;

use yii\web\Controller;
use yii\helpers\Yii;

class DataViewController extends Controller
{
   
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ArrayDataProvider();
        $dataProvider->allModels = $this->app->params['packages'];
       
        return $this->render('grid-view', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListView()
    {
        $dataProvider = new \yii\data\ArrayDataProvider();
        $dataProvider->allModels = $this->app->params['packages'];
       
        return $this->render('list-view', [
            'dataProvider' => $dataProvider,
        ]);
    }

}