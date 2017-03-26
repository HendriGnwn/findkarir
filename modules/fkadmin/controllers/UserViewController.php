<?php

namespace app\modules\fkadmin\controllers;

use app\models\User;
use app\modules\fkadmin\controllers\BaseController;
use yii\web\NotFoundHttpException;

/**
 * UserViewController implements the CRUD actions for JobApply model.
 */
class UserViewController extends BaseController
{
    /**
     * @param type $id
     * @return type
     */
    public function actionIndex($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model
        ]);
    }
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
