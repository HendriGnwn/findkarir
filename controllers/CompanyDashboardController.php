<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use dektrium\user\Finder;
use Yii;
use yii\base\Module;
use yii\web\NotFoundHttpException;

/**
 * Description of CompanyDashboard
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class CompanyDashboardController extends BaseCompanyController
{
    private $viewPath = '@app/views/company/';
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionJob()
    {
        return $this->render('job');
    }
    
    public function actionProfile()
    {
        $profile = $this->user->company;
        
        if (!$this->user->getIsCategoryGeneralCompany()) {
            throw new NotFoundHttpException('Page is not found.');
        }

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render($this->viewPath . 'profile/view', [
            'profile' => $profile,
        ]);
    }
    
    public function actionUpdateProfile()
    {
        $model = $this->user->company;

        if ($model->load(Yii::$app->request->post())) {
            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
			if ($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Data is successfully saved'));
                return $this->redirect(['profile']);
            }
            goto render;
        } else {
            render:
            return $this->render($this->viewPath . 'profile/update', [
                'model' => $model,
                'profile' => $this->user->company,
            ]);
        }
    }
    
    public function actionAccount()
    {
        return $this->render($this->viewPath . 'settings/account');
    }
    
    public function actionOrder()
    {
        return $this->render('order');
    }
}
