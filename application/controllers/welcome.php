<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$row = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>7404001));
		$params = array(
			'to' => $row->email,
			'subject' => 'Selamat bergabung di '. $this->Config_Model->get_app_name_url(),
			'body' => $this->load->view('mail/auth/new-company', array(
				'row' => $row,
			), true),
		);
		$mail = $this->send_email($params);
		die($mail);
		
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */