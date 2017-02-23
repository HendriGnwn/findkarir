<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fronModel');
		$this->load->helper('fungsi_date');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function hit()
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

	public function index()
	{
		//menghitung statistik
		$this->hit();
		//query job_kontak
		$kontak = $this->fronModel->showById('job_kontak', array('id_kontak'=>'1'));
		$data['alamat']=$kontak->alamat;
		$data['web']=$kontak->web_url;
		$data['no_telp']=$kontak->no_telp;
		$data['email']=$kontak->email;
		$data['facebook']=$kontak->facebook;
		$data['twitter']=$kontak->twitter;
		$data['google']=$kontak->google;
		$data['dribbble']=$kontak->dribble;
		$data['linkedin']=$kontak->linkedin;
		$data['skype']=$kontak->skype;

		$statistik=$this->fronModel->showById('job_hit', array('id_hit'=>1));
		$data['statistik']['jml_hit']=$statistik->jml_hit;
		$data['statistik']['hari_ini']=$statistik->jml_hari_ini;
		$data['statistik']['perusahaan']=$this->fronModel->showNumRows('job_perusahaan');
		$data['statistik']['lowongan']=$this->fronModel->showNumRows('job_lowongan');

		$data['loker']=$this->fronModel->getPlatinumLowonganLim('15');

		$data['loadBerita'] = $this->fronModel->getBerita(10,0);

		$data['tentang']=$this->fronModel->show('job_tentang WHERE id_k_tentang="1"', 'kategori', 'ASC');
		$data['daftarPerusahaan']=$this->fronModel->show('job_perusahaan', 'tgl_create', 'ASC');

		$this->load->view('front/beranda/beranda', $data);
		$this->load->view('front/object/footer', $data);
	}
}