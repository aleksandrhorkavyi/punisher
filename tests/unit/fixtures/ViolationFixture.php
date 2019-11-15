<?php

namespace tests\unit\fixtures;

use app\modules\user\v1\models\User;
use app\modules\violation\v1\models\Violation;
use Faker\Factory;
use yii\test\ActiveFixture;

class ViolationFixture extends ActiveFixture
{
    public $modelClass = Violation::class;

    public $depends = [UserFixture::class];

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function getData()
    {
        $data = [];
        $datetime = \Yii::$app->formatter->asDatetime(time());
        $faker = Factory::create();

        for ($i = 0; $i < 83; $i++) {
            $randVehicleId = mt_rand(0, 23);
            $data[] = [
                'description' => $faker->text,
                'user_id' => mt_rand(1, 12),
                'vehicle_id' => $randVehicleId === 0 ? null : $randVehicleId,

                'incident_datetime' => $faker->dateTime()->format('Y-m-d H:i:s'),

                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }
        return $data;
    }

}