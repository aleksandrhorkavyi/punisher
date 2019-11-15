<?php

namespace app\commands;

use app\rbac\Rbac;
use app\rbac\rules\ProfileOwnerRule;
use yii\console\ExitCode;

class RbacController extends \yii\console\Controller
{
    /**
     * @return int
     * @throws \Exception
     */
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $rule = new ProfileOwnerRule();
        $auth->add($rule);

        $manageProfile = $auth->createPermission(Rbac::MANAGE_PROFILE);
        $manageProfile->ruleName = $rule->name;
        $auth->add($manageProfile);

        $user = $auth->createRole(Rbac::DEFAULT_ROLE);
        $auth->add($user);
        $auth->addChild($user, $manageProfile);

        return ExitCode::OK;
    }
}