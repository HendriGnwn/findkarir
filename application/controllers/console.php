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
	
	/**
	 * cron is running every monday at 9 am
	 * 
	 * @return boolean
	 */
	public function send_email_to_applicant_that_new_jobs()
	{
		$this->load->helper('fungsi_date');
		$endDate = date('Y-m-d');
		$startDate = dateInIntervalFormat($endDate, '-7');
		$query = $this->db->query("SELECT jp.*, GROUP_CONCAT(id_k_lowongan) as group_k_lowongan FROM pelamar_bidang pb INNER JOIN job_pelamar jp ON pb.id_pelamar = jp.id_pelamar WHERE status = 1 GROUP BY id_pelamar");
		$count = $query->num_rows();
		$results = $query->result();
		if ($count <= 0) {
			echo '    > tidak ada pelamar yang minat' . PHP_EOL;
			return true;
		}
		foreach ($results as $result) :
			$q = $this->db->query("SELECT jl.*, jp.nm_perusahaan as nm_perusahaan, jkl.nm_k_lowongan as nm_k_lowongan FROM job_lowongan jl INNER JOIN job_k_lowongan jkl ON jl.id_k_low = jkl.id_k_low INNER JOIN job_perusahaan jp ON jp.id_perusahaan = jl.id_perusahaan WHERE jl.id_k_low IN ($result->group_k_lowongan) AND date_post BETWEEN '$startDate' AND '$endDate' AND jl.aktif = 1");
			$countJob = $q->num_rows();
			$jobs = $q->result();
			if ($countJob <= 0) {
				continue;
			}
			$name = '';
			foreach ($jobs as $job) {
				$name = $job->nm_k_lowongan;
				break;
			}
			$params = array(
				'to' => $result->email,
				'body' => $this->load->view('mail/send-jobs-weekly', array(
					'jobs' => $jobs,
					'row' => $result,
				), true),
				'subject' => ucwords(strtolower($name)) . ' dan ' . ($countJob - 1) . ' Lowongan tersedia',
			);
			$this->send_email($params);
		endforeach;
		echo '    > selesai' . PHP_EOL;
		return true;
	}
}