<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_model');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$row = $this->my_model->showById('job_hit', array('id_hit'=>'1'));
		$id=($row->jml_hit)+(1);
		$update_hit = array('jml_hit'=>$id);
		$this->my_model->update('job_hit', $update_hit, array('id_hit'=>'1'));
		
		$data['logo']=base_url('assets/img/logo.png');
		$data['message']="Login khusus untuk ADMIN";
		$data['formAction']="administrator_login/prosesLogin";
		$this->load->view('login', $data);
	}
		public function prosesLogin()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($this->my_model->cekLogin($username, $password)==TRUE){
				redirect('admin');
			}else{
				redirect('administrator_login');
			}
		}
}