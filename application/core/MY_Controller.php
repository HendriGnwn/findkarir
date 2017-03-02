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
	 * - body    | required | viewContent | $this->load->view('path/to/content,' array(), true)
	 * - to      | required | array(email)
	 * - subject | required | text
	 * - from
	 * - fromName
	 * - attachments (array)
	 * 
	 * @param string $params
	 * @return boolean
	 * @throws Exception
	 */
	public function send_email($params = array())
	{
		$testMode = true;
		
		if (
			!isset($params['body']) ||
			!isset($params['to']) ||
			!isset($params['subject'])
		) {
			throw new Exception('body, to, and subject must be defined.');
		}
		
		if (!is_array($params['to'])) {
			$params['to'] = array($params['to']);
		}
		if (!isset($params['from'])) {
			$params['from'] = 'no-reply@findkarir.com';
		}
		if (!isset($params['fromName'])) {
			$params['fromName'] = $this->Config_Model->get_app_name_url();
		}
		if (!isset($params['isHtml'])) {
			$params['isHtml'] = true;
		}
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = 'server42533x.maintenis.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@atc.co.id';
		$mail->Password = 'mTemT.9pupRN';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';
		//$mail->SMTPDebug = 2;
		
		$mail->setFrom($params['from'], $params['fromName']);
		foreach ($params['to'] as $to) :
			$mail->addAddress($to);
		endforeach;
		
		$mail->isHTML(true);
		$mail->Subject = $params['subject'];
		
		$body['content'] = $params['body'];
		$params['body'] = $this->load->view('mail/layouts/html', $body, true);
		$mail->msgHTML($params['body']);
		
		if (isset($params['attachments'])) {
			foreach ($params['attachments'] as $attach) {
				$mail->addAttachment($attach);
			}
		}
		
		$mailer = false;
		if ($testMode) {
			$mail->preSend();
			$path = 'assets/mail';
			if (!is_dir(BASEPATH . '../' . $path)) {
				mkdir(BASEPATH . '../' . $path);
			}
			file_put_contents($path .'/'. date('ymd-His'). '.eml', $mail->getSentMIMEMessage());
			return true;
		} else {
			$mailer = $mail->send();
		}
		
		if ($mailer) {
			return true;
		}
		error_log($mail->ErrorInfo);
		return false;
	}
}
