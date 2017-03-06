<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 * @property User $user
 *
 */
class LoginForm extends \dektrium\user\models\LoginForm
{
    public function init() 
    {
        parent::init();
    }
    
	/**
     * Validates form and logs the user in.
     *
     * @return bool whether the user is logged in successfully
     */
    public function loginAdmin()
    {
        if ($this->validate()) {
			if (!$this->user->category == User::ROLE_SUPERADMIN) {
				return false;
			}
			
            $this->user->updateAttributes(['last_login_at' => time()]);
            return Yii::$app->getUser()->login($this->user, $this->rememberMe ? $this->module->rememberFor : 0);
        }

        return false;
    }
}
