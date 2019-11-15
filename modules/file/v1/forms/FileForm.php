<?php


namespace app\modules\file\v1\forms;

use app\modules\file\v1\components\FileUploader;
use app\modules\file\v1\components\UploaderInterface;
use app\modules\file\v1\models\File;

class FileForm extends File
{
    /**
     * @param FileUploader $uploader
     * @return bool
     */
    public function loadFile(UploaderInterface $uploader): bool
    {
        $this->name = $uploader->getFile()->name;
        $this->size = $uploader->getFile()->size;
        $this->mime_type = $uploader->getFile()->type;
        $this->path = $uploader->getFilePath();
        return $this->validate();
    }
}