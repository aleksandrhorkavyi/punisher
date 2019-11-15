<?php

use yii\faker\FixtureController;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'timeZone' => 'Europe/Kiev',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@tests' => '@app/tests',
    ],
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'php:Y-m-d H:i:s'
        ],
        'authManager' => [
            'class' => \yii\rbac\PhpManager::class,
            'itemFile' => '@app/rbac/items/items.php',
            'assignmentFile' => '@app/rbac/items/assignments.php',
            'ruleFile' => '@app/rbac/items/rules.php',
            'defaultRoles' => ['user'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => FixtureController::class,
        ],
        'migrate-modules' => [
            'class' => \app\commands\MigrateController::class,
            'migrationNamespaces' => []
        ],
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
