<?php

namespace app\controllers;

use app\controllers\BaseController;
use yii\filters\AccessControl;

class SkillController extends BaseController
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true, 
                        'actions' => ['index'], 
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
