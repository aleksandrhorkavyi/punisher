<?php

namespace app\modules\file\v1\actions;

use app\modules\file\v1\components\UploaderInterface;
use app\modules\file\v1\forms\FileForm;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\rest\Action;
use yii\web\HttpException;
use yii\web\UploadedFile;
use yii2mod\settings\components\Settings;
use yii2mod\settings\models\enumerables\SettingType;

class CreateAction extends Action
{
    public $scenario;

    /**
     * @return FileForm|array
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run()
    {
        $violation = $this->getViolationId();
        $form = new FileForm();
        $form->setAttribute('violation_id', $violation);

        /** @var UploaderInterface $uploader */
        $uploader = \Yii::$container->get(UploaderInterface::class);
        $uploader->setParentFolder($violation);
        $uploader->throwExceptionIfNotFile($file = UploadedFile::getInstanceByName('image'));

        $uploader->upload($file);

        if ($form->loadFile($uploader) && $form->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $form->primaryKey], true));
            return $form;
        }
        return $form->errors;
    }

    /**
     * @return array|mixed
     * @throws Exception
     */
    private function getViolationId()
    {
        if ($vid = \Yii::$app->request->post('violation_id')) {
            return $vid;
        }
        throw new HttpException(422,'"violation_id" does not set.');
    }
}