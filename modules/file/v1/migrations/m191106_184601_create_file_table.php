<?php

namespace app\modules\file\v1\migrations;

use app\modules\file\v1\models\File;
use app\modules\violation\v1\models\Violation;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m191106_184601_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(File::tableName(), [
            'id' => $this->primaryKey(),
            'violation_id' => $this->integer()->notNull(),
            'mime_type' => $this->string(255),
            'path' => $this->string(512),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
        $this->createIndex('idx-files-violation_id', File::tableName(), 'violation_id');

        $this->addForeignKey(
            'fk-files-violation_id',
            File::tableName(), 'violation_id',
            Violation::tableName(), 'id',
            'CASCADE', 'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(File::tableName());
    }
}
