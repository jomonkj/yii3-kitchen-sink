<?php

namespace idk\app\commands;

use yii\console\Controller;
use yii\console\ExitCode;


class StatusController extends Controller
{
    /**
     * My command description
     */
    public function actionIndex($message = 'No message')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

}