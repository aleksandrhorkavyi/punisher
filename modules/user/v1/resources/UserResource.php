<?php

namespace app\modules\user\v1\resources;

use app\modules\user\v1\models\User;

class UserResource extends User
{
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'status',
            'created_at',
            'count_reports' => [$this, 'countReports']
        ];
    }

    public function extraFields()
    {
        return ['violations']; // TODO: Change the autogenerated stub
    }

    public function countReports(): int
    {
        return $this->getViolations()->count();
    }
}