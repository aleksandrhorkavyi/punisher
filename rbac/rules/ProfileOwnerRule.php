<?php

namespace app\rbac\rules;

class ProfileOwnerRule extends \yii\rbac\Rule
{
    public $name = 'profileOwner';

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param \yii\rbac\Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (empty($params['user'])) {
            throw new \yii\base\InvalidCallException('You must specify user.');
        }
        return $params['user']->id == $user;
    }
}