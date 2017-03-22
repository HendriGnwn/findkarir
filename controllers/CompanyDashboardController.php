<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of CompanyDashboard
 *
 * @author Hendri <hendri.gnw@gmail.com>
 */
class CompanyDashboardController extends BaseCompanyController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
