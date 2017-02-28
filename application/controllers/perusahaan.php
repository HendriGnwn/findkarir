<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('fungsi_date');
	}

	public function index()
	{
		$loadDataCek = $this->fronModel->showById('job_tentang', array('id_tentang'=>'4'));
		$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang="2"', 'kategori', 'ASC');
		$tampil['row']['judul']=$loadDataCek->judul;
		$tampil['row']['kategori']=$loadDataCek->kategori;
		$tampil['row']['tgl_update']=$loadDataCek->tgl_update;
		$tampil['row']['deskripsi']=$loadDataCek->deskripsi;

		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | ".strtoupper($loadDataCek->judul);
		$tampil['page_title']="Perusahaan";

		$this->final_view('front/tentang/perusahaan', $tampil);
	}

	public function kategori($id)
	{
		if($id!=''){
			$loadDataCek = $this->fronModel->showById('job_tentang', array('id_tentang'=>$id));
			$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang="2"', 'kategori', 'ASC');

			$tampil['row']['judul']=$loadDataCek->judul;
			$tampil['row']['kategori']=$loadDataCek->kategori;
			$tampil['row']['tgl_update']=$loadDataCek->tgl_update;
			$tampil['row']['deskripsi']=$loadDataCek->deskripsi;
			//$tampil['row']['judul']=$loadDataCek->judul;

			$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | ".strtoupper($loadDataCek->judul);
			$tampil['page_title']="Perusahaan";

			$this->final_view('front/tentang/perusahaan', $tampil);
		}else{
			show_404();
		}
	}

	public function prosesLogin() {
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		if ($this->fronModel->cekLoginPerusahaan($id, $password) == TRUE) {
			$this->session->set_flashdata('berhasil', 'Anda Masuk ke Halaman Profil Perusahaan, Isi Identitas Perusahaan jika belum terisi..');
			redirect('company');
		} else {
			redirect('perusahaan');
		}
	}
}