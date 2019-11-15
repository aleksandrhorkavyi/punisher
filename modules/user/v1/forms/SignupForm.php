<?php


namespace app\modules\user\v1\forms;


use app\modules\user\v1\models\User;
use yii\base\Model;

/**
 * Class SignupForm
 * @property string $email
 * @property string $password
 * @property string $username
 */
class SignupForm extends User
{
    public $email;
    public $username;
    public $password;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['email', 'username'], 'unique'],
            [['username', 'password', 'email'], 'required']
        ]);
    }

    /**
     * @return User|null
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->email = $this->email;
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->status = User::STATUS_ACTIVE;
            $user->generateAuthKey();
            $user->generatePasswordResetToken();
            return $user->save() ? $user : null;
        }
        return null;
    }
}