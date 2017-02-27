<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fronModel');
		$this->load->helper('fungsi_date');
		date_default_timezone_set("Asia/Jakarta");
		
		$this->visitor_statistic();
	}

	public function index()
	{
		$data['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja, Segala Informasi tentang Lowongan Kerja bisa Anda dapatkan di sini dari mulai Posisi Rentan Gaji dan Daerah yang Anda inginkan ada di ".$this->Config_Model->get_app_name_url();
		$data['page_title'] = 'Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini';
		$statistik=$this->fronModel->showById('job_hit', array('id_hit'=>1));
		$data['statistik']['jml_hit']=$statistik->jml_hit;
		$data['statistik']['hari_ini']=$statistik->jml_hari_ini;
		$data['statistik']['perusahaan']=$this->fronModel->showNumRows('job_perusahaan');
		$data['statistik']['lowongan']=$this->fronModel->showNumRows('job_lowongan');

		$data['loker']=$this->fronModel->getPlatinumLowonganLim('15');

		$data['loadBerita'] = $this->fronModel->getBerita(10,0);

		$data['tentang']=$this->fronModel->show('page WHERE category="1"', 'name', 'ASC');
		$data['daftarPerusahaan']=$this->fronModel->show('job_perusahaan', 'tgl_create', 'ASC');
		
		$this->load->view('front/beranda/beranda', $data);
	}
}