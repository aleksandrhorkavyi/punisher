<?php

namespace app\modules\user\v1\migrations;

use app\modules\user\v1\models\Token;
use app\modules\user\v1\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 */
class m191106_103814_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Token::tableName(), [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'expired_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-token-user_id', Token::tableName(), 'user_id');

        $this->addForeignKey(
            'fk-token-user_id',
            Token::tableName(),
            'user_id',
            User::tableName(),
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Token::tableName());
    }
}
