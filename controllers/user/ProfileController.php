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

use dektrium\user\controllers\ProfileController as BaseProfileController;
use dektrium\user\Module;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ProfileController shows users profiles.
 *
 * @property Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ProfileController extends BaseProfileController
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
                    ['allow' => true, 'actions' => ['show'], 'roles' => ['?', '@']],
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
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
        ]);
    }
}
