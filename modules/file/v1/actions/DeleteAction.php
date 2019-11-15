<?php

namespace app\modules\file\v1\actions;

use app\modules\file\v1\forms\FileForm;
use Yii;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class DeleteAction extends Action
{
    /**
     * @param $id
     * @throws ServerErrorHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id)
    {
        /** @var FileForm $model */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        if (file_exists($model->path)) {
            unlink($model->path);
        }

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        Yii::$app->getResponse()->setStatusCode(204);

    }
}