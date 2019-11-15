<?php

namespace app\modules\file\v1\migrations;

use app\modules\file\v1\models\File;
use app\modules\violation\v1\models\Violation;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m191106_184721_add_name_and_size_columns_to_file_table extends Migration
{
    public function up()
    {
        $this->addColumn(File::tableName(), 'name', $this->string(255));
        $this->addColumn(File::tableName(), 'size', $this->integer());
    }

    public function down()
    {
        $this->dropColumn(File::tableName(), 'name');
        $this->dropColumn(File::tableName(), 'size');
    }
}
