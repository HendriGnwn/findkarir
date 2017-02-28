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
		date_default_timezone_set("Asia/Jakarta");
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
		$row = $this->fronModel->showById('job_hit', array('id_hit'=>'1', 'is_real'=>0));
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
		$this->fronModel->update('job_hit', $update_hit, array('id_hit'=>'1', 'is_real'=>0));
		
		$real = $this->fronModel->showById('job_hit', array('tgl'=>date('Y-m-d'), 'is_real'=>1));
		if (!$real) {
			$data = array(
				'jml_hit' => 1,
				'jml_hari_ini' => 1,
				'tgl' => date('Y-m-d'),
				'is_real' => 1,
			);
			$this->fronModel->insert('job_hit', $data);
		} else {
			$data = array(
				'jml_hit' => ($real->jml_hit)+(1),
				'jml_hari_ini' => ($real->jml_hari_ini)+(1),
			);
			$this->fronModel->update('job_hit', $data, array('tgl'=>date('Y-m-d'), 'is_real'=>1));
		}
	}
	
	/**
	 * - body    | required
	 * - to      | required
	 * - subject | required
	 * - from
	 * - attachments (array)
	 * 
	 * @param string $params
	 * @return boolean
	 * @throws Exception
	 */
	public function send_email($params = array())
	{
		if (
			!isset($params['body']) ||
			!isset($params['to']) ||
			!isset($params['subject'])
		) {
			throw new Exception('body, to, and subject must be defined.');
		}
		
		if (!isset($params['from'])) {
			$params['from'] = 'no-reply@findkarir.com';
		}
		
		$this->load->library('upload');
		$this->load->library('email');

		//konfigurasi email
		$config = array();
		$config['charset'] = 'iso-8859-1';
		$config['useragent'] = 'Codeigniter';
		$config['protocol']= "smtp";
		$config['mailtype']= "html";
		$config['smtp_host']= "mail.atc.co.id";
		$config['smtp_port']= "25";
		$config['smtp_timeout']= "5";
		$config['smtp_user']= "no-reply@atc.co.id";
		$config['smtp_pass']= "mTemT.9pupRN";
		$config['crlf']="\r\n"; 
		$config['newline']="\r\n"; 
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['wordwrap'] = TRUE;
		//memanggil library email dan set konfigurasi untuk pengiriman email

		$this->email->initialize($config);
		$this->email->clear();
		
		//konfigurasi pengiriman
		$this->email->from($params['from'], $this->Config_Model->get_app_name_url());
		$this->email->to($params['to']);
		$this->email->subject($params['subject']);
		$this->email->message($params['body']);
		
		if (isset($params['attachments'])) {
			foreach ($params['attachments'] as $attach) {
				$this->email->attach($attach);
			}
		}

		if($this->email->send()) {
			return true;
		}
		
		return false;
	}
}
