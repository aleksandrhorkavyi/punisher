<?php

namespace app\modules\vehicle\v1\migrations;

use app\modules\vehicle\v1\models\Vehicle;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicles}}`.
 */
class m191106_155029_create_vehicle_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Vehicle::tableName(), [
            'id' => $this->primaryKey(),
            'reg_number' => $this->string(32),
            'owner' => $this->string(255),
            'model' => $this->string(255),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Vehicle::tableName());
    }
}
