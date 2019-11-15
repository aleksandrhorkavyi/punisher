<?php

namespace app\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\Serializer;

abstract class ActiveController extends \yii\rest\ActiveController
{
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'authenticator' => ['class' => HttpBearerAuth::class]
        ]);
    }
}