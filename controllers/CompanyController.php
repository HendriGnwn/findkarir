<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;

class CompanyController extends \dektrium\user\controllers\SecurityController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);
        $model->category = User::ROLE_GENERAL_COMPANY;

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            return $this->goBack(['user-dashboard/index']);
        }
        
        return $this->render('@app/views/company/security/login', [
            'model'  => $model,
            'module' => Yii::$app->getModule('user'),
        ]);
    }

}
