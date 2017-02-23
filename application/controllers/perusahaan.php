<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('fungsi_date');
		$this->load->model('fronModel');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		//query job_kontak
		$kontak = $this->fronModel->showById('job_kontak', array('id_kontak'=>'1'));
		$tampil['alamat']=$kontak->alamat;
		$tampil['web']=$kontak->web_url;
		$tampil['no_telp']=$kontak->no_telp;
		$tampil['email']=$kontak->email;
		$tampil['facebook']=$kontak->facebook;
		$tampil['twitter']=$kontak->twitter;
		$tampil['google']=$kontak->google;
		$tampil['dribbble']=$kontak->dribble;
		$tampil['linkedin']=$kontak->linkedin;
		$tampil['skype']=$kontak->skype;

		$loadDataCek = $this->fronModel->showById('job_tentang', array('id_tentang'=>'4'));
		$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang="2"', 'kategori', 'ASC');
		$tampil['row']['judul']=$loadDataCek->judul;
		$tampil['row']['kategori']=$loadDataCek->kategori;
		$tampil['row']['tgl_update']=$loadDataCek->tgl_update;
		$tampil['row']['deskripsi']=$loadDataCek->deskripsi;

		$tampil['meta_deskripsi']="jeLoker.com | ".strtoupper($loadDataCek->judul);
		$tampil['title_head']="Perusahaan";

		$data['content']=$this->load->view('front/tentang/perusahaan', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

	public function kategori($id)
	{
		if($id!=''){
			//query job_kontak
			$kontak = $this->fronModel->showById('job_kontak', array('id_kontak'=>'1'));
			$tampil['alamat']=$kontak->alamat;
			$tampil['web']=$kontak->web_url;
			$tampil['no_telp']=$kontak->no_telp;
			$tampil['email']=$kontak->email;
			$tampil['facebook']=$kontak->facebook;
			$tampil['twitter']=$kontak->twitter;
			$tampil['google']=$kontak->google;
			$tampil['dribbble']=$kontak->dribble;
			$tampil['linkedin']=$kontak->linkedin;
			$tampil['skype']=$kontak->skype;

			$loadDataCek = $this->fronModel->showById('job_tentang', array('id_tentang'=>$id));
			$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang="2"', 'kategori', 'ASC');

			$tampil['row']['judul']=$loadDataCek->judul;
			$tampil['row']['kategori']=$loadDataCek->kategori;
			$tampil['row']['tgl_update']=$loadDataCek->tgl_update;
			$tampil['row']['deskripsi']=$loadDataCek->deskripsi;
			//$tampil['row']['judul']=$loadDataCek->judul;

			$tampil['meta_deskripsi']="jeLoker.com | ".strtoupper($loadDataCek->judul);
			$tampil['title_head']="Perusahaan";

			$data['content']=$this->load->view('front/tentang/perusahaan', $tampil, true);
			$data['footer']=$this->load->view('front/object/footer', $tampil, true);
			$this->load->view('front/object/template_utama', $data);
		}else{
			redirect(site_url('error/error404'));
		}
	}

		public function prosesLogin()
		{
			$id = $this->input->post('id');
			$password = $this->input->post('password');
			if($this->fronModel->cekLoginPerusahaan($id, $password)==TRUE){
				$this->session->set_flashdata('berhasil', 'Anda Masuk ke Halaman Profil Perusahaan, Isi Identitas Perusahaan jika belum terisi..');
				redirect('company');
			}else{
				redirect('perusahaan');
			}
		}


}