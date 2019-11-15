<?php

namespace app\modules\violation\v1\models;

use app\db\ResourceActiveRecord;
use app\modules\file\v1\models\File;
use app\modules\vehicle\v1\models\Vehicle;


/**
 * This is the model class for table "violations".
 *
 * @property int $id
 * @property int $user_id
 * @property int $vehicle_id
 * @property string $description
 * @property string $incident_datetime
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Vehicle $vehicle
 * @property File[] $files
 */
class Violation extends ResourceActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'violations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['description', 'user_id', 'incident_datetime'], 'required'],
            [['description'], 'string'],
            [['user_id', 'vehicle_id'], 'integer'],
            [['incident_datetime', 'created_at', 'updated_at'], 'safe'],
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicle::class, ['id' => 'vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::class, ['violation_id' => 'id']);
    }
}
