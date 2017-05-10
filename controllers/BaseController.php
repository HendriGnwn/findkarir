<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Description of BaseController
 *
 * @author Hendri
 */
class BaseController extends Controller
{
    public function init()
    {
        parent::init();
        
        $this->view->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
        $this->view->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
    }
}
