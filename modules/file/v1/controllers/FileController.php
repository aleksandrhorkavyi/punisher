<?php

namespace app\modules\file\v1\controllers;


use app\controllers\ActiveController;
use app\modules\file\v1\actions\CreateAction;
use app\modules\file\v1\actions\DeleteAction;
use app\modules\file\v1\actions\UpdateAction;
use app\modules\file\v1\resources\FileResource;


class FileController extends ActiveController
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
    public $modelClass = FileResource::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['create']['class'] = CreateAction::class;
        $actions['update']['class'] = UpdateAction::class;
        $actions['delete']['class'] = DeleteAction::class;
        return $actions;
    }

    public function verbs()
    {
        return array_merge(parent::verbs(), [
            'update' => ['POST'],
        ]);
    }


}