<?php

namespace app\modules\file\v1\components;


use yii\base\ErrorException;
use yii\base\Exception;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class FileUploader implements UploaderInterface
{
    /**
     * @var string
     */
    public $storagePath = '@tests/storage';
    /**
     * @var string
     */
    public $parentFolder = '';
    /**
     * @var UploadedFile
     */
    protected $file;
    /**
     * @var string
     */
    private $filePath;

    /**
     * @param UploadedFile $file
     * @return bool
     * @throws ErrorException
     * @throws \yii\base\Exception
     */
    public function upload(UploadedFile $file): bool
    {
        $this->setFile($file);
        $this->setFilePath($this->generateFilePath());

        if (!is_dir($this->getPathToFileFolder())) {
            try {
                mkdir($this->getPathToFileFolder());
            } catch (ErrorException $exception) {
                throw new ErrorException("Parent folder $this->storagePath does not exists.");
            }
        }

        return $this->file->saveAs($this->getFilePath());
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function generateFilePath(): string
    {
        return sprintf('%s/%s.%s',
            $this->getPathToFileFolder(),
            \Yii::$app->security->generateRandomString(10),
            $this->file->getExtension()
        );
    }

    /**
     * @return string
     */
    public function getPathToFileFolder(): string
    {
        return \Yii::getAlias(implode('/', [$this->storagePath, $this->parentFolder]));
    }

    public function setParentFolder(string $folder): void
    {
       $this->parentFolder = $folder;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @param $file
     * @throws HttpException
     */
    public function throwExceptionIfNotFile($file): void
    {
        if (empty($file) || !$file instanceof UploadedFile) {
            throw new HttpException(422, 'file not set.');
        }
    }

    /**
     * @param string $absolutePath
     * @return bool
     * @throws NotFoundHttpException
     */
    public function removeFile(string $absolutePath): bool
    {
        if (file_exists($absolutePath)) {
            return unlink($absolutePath);
        }
        throw new NotFoundHttpException('file "'.$absolutePath.'" does not exists.');
    }
}