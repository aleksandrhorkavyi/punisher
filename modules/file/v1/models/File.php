<?php

namespace app\modules\file\v1\models;

use app\db\ResourceActiveRecord;
use app\modules\violation\v1\models\Violation;
use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $violation_id
 * @property string $mime_type
 * @property string $path
 * @property string $name
 * @property int $size
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Violation $violation
 */
class File extends ResourceActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['violation_id', 'path', 'mime_type', 'name', 'size'], 'required'],
            [['violation_id', 'size'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['mime_type', 'name'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 512],
            [['violation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Violation::class, 'targetAttribute' => ['violation_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViolation()
    {
        return $this->hasOne(Violation::class, ['id' => 'violation_id']);
    }
}
