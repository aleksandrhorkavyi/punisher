<?php

namespace app\modules\vehicle\v1\models;

use app\modules\violation\v1\models\Violation;
use Yii;

/**
 * This is the model class for table "vehicles".
 *
 * @property int $id
 * @property string $reg_number
 * @property string $owner
 * @property string $model
 * @property string $created_at
 * @property string $updated_at
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_number'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['reg_number'], 'string', 'max' => 32],
            [['owner', 'model'], 'string', 'max' => 255],
        ];
    }

    public function getViolations()
    {
        return $this->hasMany(Violation::class, ['vehicle_id' => 'id']);
    }
}
