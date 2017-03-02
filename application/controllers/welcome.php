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
		$row = $this->my_model->showById('job_bantuan', array('id_bantuan' => 4));
		$params = array(
			'to' => $row->email,
			'subject' => 'Re: ' . 'Maeesio sjals aamJ Jswlm',
			'body' => $this->load->view('mail/help', array(
				'body' => 'isdufh asfhasf iosadfiusdafh asdfsadifu hsad fsdfuhwier asfdsd f',
				'row' => $row,
			), true)
		);
		$mail = $this->send_email($params);
		die($mail);
		
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */