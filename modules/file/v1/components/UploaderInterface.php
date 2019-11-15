<?php


namespace app\modules\file\v1\components;

use yii\web\UploadedFile;

interface UploaderInterface
{
    public function upload(UploadedFile $file): bool ;

    public function generateFilePath(): string ;

    public function getFile(): UploadedFile;

    public function throwExceptionIfNotFile($file);

    public function removeFile(string $absolutePath): bool ;

}