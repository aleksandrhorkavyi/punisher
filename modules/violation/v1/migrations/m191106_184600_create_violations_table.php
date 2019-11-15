<?php

namespace app\modules\violation\v1\migrations;

use app\modules\user\v1\models\User;
use app\modules\violation\v1\models\Violation;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%violations}}`.
 */
class m191106_184600_create_violations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Violation::tableName(), [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'vehicle_id' => $this->integer()->defaultValue(null),
            'incident_datetime' => $this->timestamp()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull()
        ]);
        $this->createIndex('idx-violations-user_id', Violation::tableName(), 'user_id');
        $this->addForeignKey(
            'fk-violations-user_id',
            Violation::tableName(), 'user_id',
            User::tableName(), 'id',
            'CASCADE', 'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Violation::tableName());
    }
}
