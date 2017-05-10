<?php

namespace app\modules\fkadmin\controllers;

use app\models\Partner;
use app\modules\fkadmin\controllers\BaseController;
use app\modules\fkadmin\models\PartnerSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends BaseController
{
    /**
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Partner();

        if ($model->load(Yii::$app->request->post())) {
			$model->photoFile = UploadedFile::getInstance($model, 'photoFile');
			if ($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Data is successfully saved'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
            goto render;
        } else {
            render:
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
			if ($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('app', 'Data is successfully saved'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
            goto render;
        } else {
            render:
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
