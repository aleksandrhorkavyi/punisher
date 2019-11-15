<?php

namespace app\modules\file\v1\actions;

use app\modules\file\v1\components\UploaderInterface;
use app\modules\file\v1\forms\FileForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\helpers\Url;
use yii\rest\Action;
use yii\web\UploadedFile;

class UpdateAction extends Action
{
    public $scenario;

    /**
     * @return FileForm|array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run(int $id)
    {
        $form = FileForm::findOne($id);

        /** @var UploaderInterface $uploader */
        $uploader = \Yii::$container->get(UploaderInterface::class);
        $uploader->setParentFolder($id);
        $uploader->throwExceptionIfNotFile($file = UploadedFile::getInstanceByName('image'));
        $uploader->removeFile($form->path);
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
     * @param int $violationId
     * @return FileForm
     */
    protected function getScenarioForm(int $violationId): FileForm
    {
        echo "<pre>";
        var_dump($this->scenario);
        echo "</pre>";
        die;
        switch ($this->scenario) {
            case self::SCENARIO_CREATE:
                return new FileForm($violationId);
                break;
            case self::SCENARIO_UPDATE:
                return FileForm::findOne($violationId);
                break;
            default:
                throw new InvalidArgumentException("Scenario does not exists.");
        }
    }
}