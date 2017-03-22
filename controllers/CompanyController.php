<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use dektrium\user\controllers\SecurityController;
use dektrium\user\models\RegistrationForm;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\web\HttpException;

class CompanyController extends SecurityController
{
    use AjaxValidationTrait;
    use EventTrait;
    
    /** @inheritdoc */
    public function behaviors()
    {
        return [];
    }
    
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
            return $this->goBack(['company-dashboard/index']);
        }
        
        return $this->render('@app/views/company/security/login', [
            'model'  => $model,
            'module' => Yii::$app->getModule('user'),
        ]);
    }
    
    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise
     * redirects to home page.
     *
     * @return string
     * @throws HttpException
     */
    public function actionRegister()
    {
        /** @var RegistrationForm $model */
        $model = Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('success', 'Your account has been created');
            return $this->redirect(['/company/login']);
        }
        
        return $this->render('@app/views/user/registration/register', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }
}
