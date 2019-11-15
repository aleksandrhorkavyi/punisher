<?php

return [
    'request' => [
        'cookieValidationKey' => 'ya1txP-3JCSnVYSKL4EvV9MNZHk_RrCf',
        'parsers' => [
            'application/json' => 'yii\web\JsonParser',
        ]
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => $db,
    'urlManager' => [
        'enablePrettyUrl' => true,
        'enableStrictParsing' => true,
        'showScriptName' => false,
        'rules' => $rules,
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => 'redis',
        'port' => 6379,
        'database' => 0,
    ],
];