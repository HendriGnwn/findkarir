<?php

namespace app\controllers;

use app\models\Job;
use app\models\search\ViewJobSearch;
use app\models\ViewJob;
use Yii;
use yii\web\NotFoundHttpException;

class JobController extends BaseController
{
    /**
     * listing jobs
     * 
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ViewJobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDetail($code)
    {
        $model = $this->findModel($code);
        
        return $this->render('detail', [
            'model' => $model
        ]);
    }
    
    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code)
    {
        if (($model = ViewJob::find()->where(['code' => $code])->actived()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
