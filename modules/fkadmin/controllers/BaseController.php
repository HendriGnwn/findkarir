<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\fkadmin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Description of BaseController
 *
 * @author Hendri
 */
class BaseController extends Controller
{
	/**
     * @inheritdoc
     */
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
			],
		];
	}
}
