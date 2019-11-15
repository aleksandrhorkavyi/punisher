<?php

return [
    'swagger' => 'swagger/index',
    [
        'class' => \yii\rest\UrlRule::class,
        'controller' => ['v1/violations' => 'violation.v1/violation'],
    ],
    ['class' => \yii\rest\UrlRule::class, 'controller' => ['v1/vehicles' => 'vehicle.v1/vehicle']],
    [
        'class' => \yii\rest\UrlRule::class,
        'controller' => ['v1/files' => 'file.v1/file'],
        'extraPatterns' => [
            'POST {id}' => 'update',
        ]
    ],
    [
        'class' => \yii\rest\UrlRule::class,
        'controller' => ['v1/users' => 'user.v1/user'],
        'extraPatterns' => [
            'POST login' => 'login',
            'POST signup' => 'signup',
        ]
    ]
];