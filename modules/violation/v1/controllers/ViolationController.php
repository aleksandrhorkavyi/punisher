<?php

namespace app\modules\violation\v1\controllers;

use app\controllers\ActiveController;
use app\modules\violation\v1\resources\ViolationResource;

class ViolationController extends ActiveController
{
    public $modelClass = ViolationResource::class;
}