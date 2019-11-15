<?php

namespace app\modules\violation\v2\controllers;

use yii\rest\Controller;

class ViolationController extends Controller
{
    public function actionIndex()
    {
        return ['v2'];
    }
}