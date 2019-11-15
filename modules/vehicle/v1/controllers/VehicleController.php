<?php

namespace app\modules\vehicle\v1\controllers;


use app\controllers\ActiveController;
use app\modules\vehicle\v1\resources\VehicleResource;

class VehicleController extends ActiveController
{
    public $modelClass = VehicleResource::class;
}