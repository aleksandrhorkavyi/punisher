<?php

namespace tests\unit\fixtures;

use app\modules\user\v1\models\User;
use app\modules\vehicle\v1\models\Vehicle;
use app\modules\violation\v1\models\Violation;
use Faker\Factory;
use yii\test\ActiveFixture;

class VehicleFixture extends ActiveFixture
{
    public $modelClass = Vehicle::class;
    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \Exception
     */
    public function getData()
    {
        $data = [];
        $datetime = \Yii::$app->formatter->asDatetime(time());
        $faker = Factory::create();

        for ($i = 0; $i < 23; $i++) {
            $data[] = [
                'reg_number' => $this->generateRegNumber(),
                'owner' => $faker->name,
                'model' => $faker->company,

                'created_at' => $datetime,
                'updated_at' => $datetime,
            ];
        }
        return $data;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function generateRegNumber()
    {
        return implode('', [
            'aa', random_int(1000, 9999), 'dg'
        ]);
    }

}