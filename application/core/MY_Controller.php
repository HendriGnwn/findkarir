<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Carbon
 */
class MY_Controller extends CI_Controller  
{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @param string $params
	 * @throws Exception
	 */
	public function final_view($view, $params = array())
	{
		if (!isset($params['layout'])) {
			$params['layout'] = 'front/layouts/main';
		}
		
		$params['content'] = $this->load->view($view, $params, true);
		$this->load->view($params['layout'], $params);
	}
	
	/**
	 * hit statistic
	 */
	public function visitor_statistic()
	{
		$row = $this->fronModel->showById('job_hit', array('id_hit'=>'1'));
		$id=($row->jml_hit)+(1);
		if($row->tgl==date('Y-m-d')){
			$hari_ini = ($row->jml_hari_ini)+(1);
		}else{
			$hari_ini = '1';
		}
		$update_hit = array(
			'jml_hit'=>$id, 
			'jml_hari_ini'=>$hari_ini,
			'tgl'=>date('Y-m-d'),
			);
		$this->fronModel->update('job_hit', $update_hit, array('id_hit'=>'1'));
	}
}
