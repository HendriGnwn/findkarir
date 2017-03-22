<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\fkadmin\controllers;

use app\models\Company;
use app\models\Offer;
use app\models\Partner;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Description of AjaxController
 *
 * @author Hendri
 */
class AjaxController extends BaseController
{
	/* @var yii\web\Request */
	protected $request;
	
	public function init() 
	{
		parent::init();
		
		$this->request = Yii::$app->request;
		
		if (!$this->request->isAjax) {
			throw new NotFoundHttpException();
		}
		
		return true;
	}
	
	/**
	 * list company for use in select2
	 * 
	 * @param type $username
	 * @param type $id
	 * @return json
	 */
	public function actionListUser($username = null, $id = null)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$out = ['results' => ['id'=>'', 'text'=>'']];
		if (!is_null($username)) {
			$query = User::find()
					->joinWith('profile p', true, 'INNER JOIN')
					->joinWith('company c', true, 'INNER JOIN')
					->orWhere(['like', 'p.name', $username])
					->orWhere(['like', 'username', $username])
					->orWhere(['like', 'c.name', $username])
					->orderBy(['username'=>SORT_ASC])
					->limit(50)
					->all();
			$results = [];
			$no = 0;
			foreach($query as $data) {
				$results[$no]['id'] = $data->id;
				$results[$no]['text'] = $data->getName();
				$no++;
			}
			$out['results'] = $results;
		}
		else if ($id > 0) {
			$out['results'] = ['id'=>$id, 'text'=> User::findOne($id)->username];
		}
		
		return $out;
	}
    
    /**
	 * list partner for use in select2
	 * 
	 * @param type $name
	 * @param type $id
	 * @return json
	 */
	public function actionListPartner($name = null, $id = null)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$out = ['results' => ['id'=>'', 'text'=>'']];
		if (!is_null($name)) {
			$query = Partner::find()
					->orWhere(['like', 'name', $name])
					->orderBy(['name'=>SORT_ASC])
					->limit(50)
					->all();
			$results = [];
			$no = 0;
			foreach($query as $data) {
				$results[$no]['id'] = $data->id;
				$results[$no]['text'] = $data->name;
				$no++;
			}
			$out['results'] = $results;
		}
		else if ($id > 0) {
			$out['results'] = ['id'=>$id, 'text'=> Partner::findOne($id)->name];
		}
		
		return $out;
	}
    
    /**
	 * list partner for use in select2
	 * 
	 * @param type $name
	 * @param type $id
	 * @return json
	 */
	public function actionListCompany($name = null, $id = null)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$out = ['results' => ['id'=>'', 'text'=>'']];
		if (!is_null($name)) {
			$query = Company::find()
					->orWhere(['like', 'name', $name])
					->orderBy(['name'=>SORT_ASC])
					->limit(50)
					->all();
			$results = [];
			$no = 0;
			foreach($query as $data) {
				$results[$no]['id'] = $data->id;
				$results[$no]['text'] = $data->name;
				$no++;
			}
			$out['results'] = $results;
		}
		else if ($id > 0) {
			$out['results'] = ['id'=>$id, 'text'=> Company::findOne($id)->name];
		}
		
		return $out;
	}
    
	/**
	 * get user with relation
	 * 
	 * @return json
	 */
	public function actionGetUser()
	{
		$id = $this->request->post('id');
		$model = User::findOne($id);
		if (!$model) {
			return false;
		}
		
		$relations = $model->getRelationData();
		
		echo json_encode(ArrayHelper::merge($model->attributes, $relations));
	}
    
    
    /**
     * get offer by id
     * 
     * @param type $id
     * @return boolean
     */
    public function actionGetOffer($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $offer = Offer::findOne($id);
        if (!$offer) {
            return false;
        }
        
        return $offer->attributes;
    }
}
