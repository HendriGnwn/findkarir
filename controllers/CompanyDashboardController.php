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
        return $this->render($this->viewPath . 'profile/update');
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
