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
class BaseUserController extends BaseController
{
    /* @var app\models\User */
    protected $user;

    /** @inheritdoc */
    public function init() 
    {
        parent::init();
        
        $this->user = User::findOne(Yii::$app->user->id);
        if (!$this->user) {
            throw new NotFoundHttpException('Page is not found');
        }
        
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
                        'actions' => ['job-apply'], 
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true, 
                        'actions' => ['index', 'create', 'delete', 'view', 'update'], 
                        'roles' => ['@']
                    ],
                ],
                'denyCallback' => function () {
                    Yii::$app->user->logout();
                    return $this->redirect(['/user/login']);
                }
            ],
        ];
    }
    
    
}
