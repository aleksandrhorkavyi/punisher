<?php

namespace app\modules\violation\v1\resources;

use app\modules\violation\v1\models\Violation;

class ViolationResource extends Violation
{
    public function fields()
    {
        return array_merge(parent::fields(), ['vehicle']);
    }
}