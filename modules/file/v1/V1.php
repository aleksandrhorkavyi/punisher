<?php

namespace app\modules\file\v1;

use app\modules\file\v1\components\FileUploader;
use app\modules\file\v1\components\UploaderInterface;
use Yii;
use yii\base\InvalidConfigException;

class V1 extends \yii\base\Module
{
    /**
     * @var FileUploader
     */
    public $uploader;

    public $controllerNamespace = 'app\modules\file\v1\controllers';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (null === $this->uploader) {
            throw new InvalidConfigException('You should configure the uploader.');
        }
        $this->registerDependencies();
    }

    protected function registerDependencies()
    {
        Yii::$container->setDefinitions([
            UploaderInterface::class => $this->uploader,
        ]);
    }
}