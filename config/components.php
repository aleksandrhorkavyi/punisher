<?php

return [
    'user' => [
        'identityClass' => \app\modules\user\v1\models\User::class,
        'enableAutoLogin' => false,
        'enableSession' => false
    ],
    'formatter' => [
        'datetimeFormat' => 'php:Y-m-d H:i:s'
    ],
    'settings' => [
        'class' => 'yii2mod\settings\components\Settings',
    ],
    'cache' => [
        'class' => 'yii\redis\Cache',
    ],
];