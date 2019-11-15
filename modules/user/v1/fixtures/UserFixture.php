<?php

namespace app\modules\user\v1;

use app\modules\user\v1\models\User;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}