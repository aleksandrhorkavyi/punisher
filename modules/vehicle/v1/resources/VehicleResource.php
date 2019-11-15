<?php

namespace app\modules\vehicle\v1\resources;

use app\modules\vehicle\v1\models\Vehicle;

class VehicleResource extends Vehicle
{
    public function fields()
    {
        return array_merge(parent::fields(), [
            'count_violations' => [$this, 'countViolations']
        ]);
    }

    public function extraFields()
    {
        return ['violations'];
    }

    public function countViolations(): int
    {
        return $this->getViolations()->count();
    }
}