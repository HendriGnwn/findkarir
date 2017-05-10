<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Description of BaseUserControler
 *
 * @author acer
 */
class BaseCompanyController extends BaseController
{
    /* @var app\models\User */
    protected $user;

    /** @inheritdoc */
    public function init() 
    {
        parent::init();
        
        $this->user = User::find()
                ->andWhere(['id' => Yii::$app->user->id])
                ->andWhere(['in', 'category', [User::ROLE_GENERAL_COMPANY, User::ROLE_MEMBER]])
                ->one();
        if (!$this->user) {
            throw new NotFoundHttpException('Page is not found');
        }
        
        $this->view->registerMetaTag(['name' => 'robots',  'content' => 'noindex,nofollow']);
        $this->view->registerMetaTag(['name' => 'googlebot',  'content' => 'noindex,nofollow']);
        
        $this->layout = 'main-company';
        return true;
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
                'denyCallback' => function () {
                    Yii::$app->user->logout();
                    return $this->redirect(['/company/login']);
                }
            ],
        ];
    }
    
    
}
