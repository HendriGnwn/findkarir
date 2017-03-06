<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends \dektrium\user\models\LoginForm
{
    public function init() 
    {
        parent::init();
    }
}
