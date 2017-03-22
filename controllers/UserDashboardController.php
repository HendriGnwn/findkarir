<?php

namespace app\controllers;

class UserDashboardController extends \app\controllers\BaseUserController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionJobApply()
    {
        return $this->render('job-apply');
    }

}
