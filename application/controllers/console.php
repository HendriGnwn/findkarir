<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Console extends MY_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');

		$this->load->model('my_model');

		// Sets the server not to have a time out. 
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		// Expand the array displays
		ini_set('xdebug.var_display_max_depth', 5);
		ini_set('xdebug.var_display_max_children', 256);
		ini_set('xdebug.var_display_max_data', 1024);
	}

	public function index() {
		echo "Hello" . PHP_EOL;
	}
	
	/**
	 * update status lowongan via cron job
	 */
	public function update_status_lowongan()
	{
		$looping = $this->my_model->get_jobs_expire_activation();
		if($looping!=''){
			foreach($looping as $data){
				$data1=array(
						'aktif'=>'2',
				);
				$this->my_model->update('job_lowongan', $data1, array('id_lowongan'=>$data->id_lowongan));
				echo '    > update lowongan: '. $data->id_lowongan . PHP_EOL;
			}
			echo '    > selesai' . PHP_EOL;
			return;
		}
		echo '    > tidak ada update-an' . PHP_EOL;
	}
	
	public function send_email_to_applicant_that_new_jobs()
	{
		// query ambil di pelamar_bidang relasi ke id_pelamar (ambil email) dan kirim
		echo '    > selesai' . PHP_EOL;
	}
}