<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\fkadmin\controllers\user;

use app\models\Profile;
use app\models\User;
use dektrium\user\controllers\AdminController as BaseAdminController;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
        
        $company = $user->company;
        
        if ($company->load(Yii::$app->request->post())) {
			$company->photoFile = UploadedFile::getInstance($company, 'photoFile');
			if ($company->save()) {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Data is successfully saved'));
                return $this->redirect(['company', 'id' => $user->id]);
            }
        }
        
        return $this->render('_company', [
            'user' => $user,
            'company' => $company,
        ]);
    }
    
    /**
     * Updates an existing profile.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdateProfile($id)
    {
        Url::remember('', 'actions-redirect');
        $user    = $this->findModel($id);
        $profile = $user->profile;

        if ($profile == null) {
            $profile = \Yii::createObject(Profile::className());
            $profile->link('user', $user);
        }
        $event = $this->getProfileEvent($profile);

        $this->performAjaxValidation($profile);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);

        if ($profile->load(\Yii::$app->request->post())) {
            $profile->photoFile = UploadedFile::getInstance($profile, 'photoFile');
            $profile->cvFile = UploadedFile::getInstance($profile, 'cvFile');
			if ($profile->save()) {
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Profile details have been updated'));
                $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
                return $this->refresh();
            }
        }

        return $this->render('_profile', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }
}
