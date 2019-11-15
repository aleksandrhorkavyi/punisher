<?php


namespace app\controllers;


use yii\web\Controller;

class SwaggerController extends Controller
{
    /**
     * @OA\Info(title="My First API", version="0.1")
     */

    /**
     * @OA\Get(
     *     path="/api/resource.json",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}