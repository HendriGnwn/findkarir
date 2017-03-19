<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use dektrium\user\models\LoginForm as BaseLoginForm;
use Yii;

/**
 * LoginForm get user's login and password, validates them and logs the user in. If user has been blocked, it adds
 * an error to login form.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class LoginForm extends BaseLoginForm
{
    public $category;
    
    /** @inheritdoc */
    public function rules()
    {
        $rules = [
            'loginTrim' => ['login', 'trim'],
            'requiredFields' => [['login'], 'required'],
            'confirmationValidate' => [
                'login',
                function ($attribute) {
                    if ($this->user !== null) {
                        if (!$this->user->getIsConfirmed()) {
                            $this->addError($attribute, Yii::t('user', 'You need to confirm your email address'));
                        }
                        if ($this->user->getIsBlocked()) {
                            $this->addError($attribute, Yii::t('user', 'Your account has been blocked'));
                        }
                        switch ($this->category) {
                            case User::ROLE_APPLICANT :
                                if (!$this->user->getIsCategoryApplicant()) {
                                    $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
                                }
                                break;
                            case User::ROLE_GENERAL_COMPANY :
                                if (!$this->user->getIsCategoryGeneralCompany()) {
                                    $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
                                }
                                break;
                            case User::ROLE_MEMBER :
                                if (!$this->user->getIsCategoryMember()) {
                                    $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
                                }
                                break;
                            case User::ROLE_SUPERADMIN :
                            //case User::ROLE_USER :
                                if (!$this->user->getIsCategorySuperAdmin()) {
                                    $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
                                }
                                break;
                        }
                    }
                }
            ],
            'rememberMe' => ['rememberMe', 'boolean'],
            'safe' => ['category', 'safe'],
        ];

        return $rules;
    }
}
