<?php

namespace app\modules\file\v1\resources;

use app\modules\file\v1\components\FileUploader;
use app\modules\file\v1\components\UploaderInterface;
use app\modules\file\v1\models\File;

class FileResource extends File
{
    public function fields()
    {
        return array_merge(parent::fields(), [
            'path' => [$this, 'getPathAsUrl']
        ]);
    }

    /**
     * @return FileUploader
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function getPathAsUrl()
    {
        /** @var FileUploader $uploader */
        $uploader = \Yii::$container->get(UploaderInterface::class);

        return str_replace(
            \Yii::getAlias('@app'),
            \Yii::$app->request->hostInfo,
            $this->path
        );
    }
}