<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%violations}}`.
 */
class m191105_184719_create_violations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%violations}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%violations}}');
    }
}
