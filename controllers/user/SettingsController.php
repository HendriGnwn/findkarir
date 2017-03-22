<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\user;

use dektrium\user\models\SettingsForm;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Description of SettingsController
 *
 * @author 
 */
class SettingsController extends \app\controllers\BaseUserController 
{	
    use AjaxValidationTrait;
    use EventTrait;
    
    /**
     * Displays page where user can update account settings (username, email or password).
     *
     * @return string|Response
     */
    public function actionAccount()
    {
        /** @var SettingsForm $model */
        $model = Yii::createObject(SettingsForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('user', 'Your account details have been updated'));
            return $this->refresh();
        }

        return $this->render('@app/views/user/settings/account', [
            'model' => $model,
        ]);
    }
}
