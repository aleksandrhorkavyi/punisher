<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$rules = require __DIR__ . '/rules.php';
$modules = require __DIR__ . '/modules.php';
$baseComponents = require __DIR__ . '/base_components.php';
$components = require __DIR__ . '/components.php';

$config = [
    'id' => 'basic',
    'timeZone' => 'Europe/Kiev',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [],
    'components' => array_merge($baseComponents, $components),
    'modules' => $modules,
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
