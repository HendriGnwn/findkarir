<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\controllers\user;

use app\models\Profile;
use dektrium\user\controllers\ProfileController as BaseProfileController;
use dektrium\user\Module;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProfileController shows users profiles.
 *
 * @property Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ProfileController extends BaseProfileController
{
    use EventTrait;
    
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true, 
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * Redirects to current user's profile.
     *
     * @return Response
     */
    public function actionIndex()
    {
        $profile = $this->finder->findProfileById(Yii::$app->user->id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('@app/views/user/profile/view', [
            'profile' => $profile,
        ]);
    }

    /**
     * Shows user's profile.
     *
     * @param int $id
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate()
    {
        $profile = $this->finder->findProfileById(Yii::$app->user->id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }
        
        $profile->setScenario(Profile::SCENARIO_UPDATE_APPLICANT);
        $event = $this->getProfileEvent($profile);
        $this->performAjaxValidation($profile);

        if ($profile->load(\Yii::$app->request->post())) {
            $profile->photoFile = UploadedFile::getInstance($profile, 'photoFile');
            $profile->cvFile = UploadedFile::getInstance($profile, 'cvFile');
			if ($profile->save()) {
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Profile details have been updated'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('@app/views/user/profile/update', [
            'profile' => $profile,
        ]);
    }
    
    /**
     * Performs AJAX validation.
     *
     * @param array|Model $model
     *
     * @throws ExitException
     */
    protected function performAjaxValidation($model)
    {
        if (\Yii::$app->request->isAjax && !\Yii::$app->request->isPjax) {
            if ($model->load(\Yii::$app->request->post())) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode(ActiveForm::validate($model));
                \Yii::$app->end();
            }
        }
    }
}
