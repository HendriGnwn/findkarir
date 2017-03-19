<?php

namespace app\controllers;

class CompanyController extends \app\controllers\BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
