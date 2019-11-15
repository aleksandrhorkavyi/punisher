<?php

return [
    'violation.v1' => [
        'class' => 'app\modules\violation\v1\V1',
    ],
    'vehicle.v1' => [
        'class' => 'app\modules\vehicle\v1\V1',
    ],
    'file.v1' => [
        'class' => 'app\modules\file\v1\V1',
        'uploader' => [
            'class' => \app\modules\file\v1\components\FileUploader::class,
            'storagePath' => '@app/storage/violations',
        ]
    ],
    'user.v1' => [
        'class' => 'app\modules\user\v1\V1',
    ],

    'settings' => [
        'class' => 'yii2mod\settings\Module',
    ],
];