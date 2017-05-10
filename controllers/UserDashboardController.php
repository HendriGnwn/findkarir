<?php

namespace app\controllers;

use app\models\JobApply;
use app\models\search\JobApplySearch;
use Yii;

class UserDashboardController extends BaseUserController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * @return type
     */
    public function actionJobApply()
    {
        $searchModel = new JobApplySearch();
        $searchModel->user_id = $this->user->id;
        $searchModel->status = JobApply::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('job-apply', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * @return type
     */
    public function actionWalkInterview()
    {
        $searchModel = new JobApplySearch();
        $searchModel->user_id = $this->user->id;
        $searchModel->status = JobApply::STATUS_INTERVIEW;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('walk-interview', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
