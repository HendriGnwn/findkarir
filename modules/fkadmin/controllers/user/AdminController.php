<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\fkadmin\controllers\user;

use app\models\Company;
use app\models\User;
use dektrium\user\controllers\AdminController as BaseAdminController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Description of AdminController
 *
 * @author Carbon
 */
class AdminController extends BaseAdminController
{
	public function behaviors() 
	{
		return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'  => ['post'],
                    'confirm' => ['post'],
                    'block'   => ['post'],
                ],
            ],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
    
    public function actionCompany($id)
    {
        $user = User::findOne($id);
        if (!$user->getIsCategoryGeneralCompany()) {
            throw new NotFoundHttpException('Page is not found');
        }
        
        return $this->render('_company', [
            'user' => $user,
            'company' => $user->company,
        ]);
    }
}
