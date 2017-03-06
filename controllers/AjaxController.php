<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use app\models\City;
use app\models\Province;
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
					->orWhere(['like', 'p.name', $username])
					->orWhere(['like', 'username', $username])
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
	 * list province query where country_id
	 * 
	 * @param type $id
	 * @param type $selected
	 * @return string
	 */
	public function actionListProvince($id = null, $selected = null)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$out = [['id'=>'', 'name'=>'Choose One', 'selected'=>'']];
		if (!is_null($id)) {
			$query = Province::find()
					->select('id, name')
					->where(['country_id' => $id])
					->orderBy(['name'=>SORT_ASC])
					->all();
			$no = 1;
			foreach($query as $item) {
				$out[$no]['id'] = $item->id;
				$out[$no]['name'] = $item->name;
				
				if ($item->id == $selected) {
					$out[$no]['selected'] = 'selected';
				} else {
					$out[$no]['selected'] = '';
				}
				$no++;
			}
		}
		
		return $out;
	}
	
	/**
	 * list city query where province_id
	 * 
	 * @param type $id
	 * @param type $selected
	 * @return string
	 */
	public function actionListCity($id = null, $selected = null)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$out = [['id'=>'', 'name'=>'Choose One', 'selected'=>'']];
		if (!is_null($id)) {
			$query = City::find()
					->select('id, name')
					->where(['province_id' => $id])
					->orderBy(['name'=>SORT_ASC])
					->all();
			$no = 1;
			foreach($query as $item) {
				$out[$no]['id'] = $item->id;
				$out[$no]['name'] = $item->name;
				
				if ($item->id == $selected) {
					$out[$no]['selected'] = 'selected';
				} else {
					$out[$no]['selected'] = '';
				}
				$no++;
			}
		}
		
		return $out;
	}
}
