<?php

namespace app\modules\user\v1\controllers;

use app\controllers\ActiveController;
use app\modules\user\v1\forms\LoginForm;
use app\modules\user\v1\forms\SignupForm;
use app\modules\user\v1\resources\UserResource;
use yii\filters\auth\HttpBearerAuth;

class UserController extends ActiveController
{
    public $modelClass = UserResource::class;

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
                'except' => ['login', 'signup']
            ]
        ]);
    }

    /**
     * @return LoginForm|\app\modules\user\v1\models\Token|null
     * @throws \yii\base\Exception
     */
    public function actionLogin()
    {
        $form = new LoginForm();
        $form->load(\Yii::$app->request->bodyParams, '');
        if ($token = $form->auth()) {
            return $token;
        } else {
            return $form;
        }
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        $form = new SignupForm();
        $form->load(\Yii::$app->request->bodyParams, '');
        if ($user = $form->signup()) {
            return $user;
        }
        return $form->errors;
    }
}