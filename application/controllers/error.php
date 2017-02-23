<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fronModel');
		$this->load->model('my_model');
		date_default_timezone_set("Asia/Jakarta");
	}


	public function index404()
	{
		// $data['logo']=base_url('assets/img/logo.png');
		// $data['message']="Login khusus untuk <b>USER</b>";
		if($this->session->userdata('hak_akses')=='2'){
			$judul = "user";
			$tampil['title']=$judul;
			$data['content']=$this->load->view('back/object/404', $tampil, true);
			$this->load->view('back/object/template', $data);
		}elseif($this->session->userdata('hak_akses')=='1'){
			$judul = "admin";
			$tampil['title']=$judul;
			$data['content']=$this->load->view('back/object/404', $tampil, true);
			$this->load->view('back/object/template', $data);
		}else{
			redirect('error/error404');
		}
	}

	public function error404()
	{
		$tampil['meta_deskripsi']="Lokeria.com | Gudangnya Informasi Lowongan Kerja. Error 404";
		$tampil['title_head']="Error 404";

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

		$data['content']=$this->load->view('front/object/404', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}
}