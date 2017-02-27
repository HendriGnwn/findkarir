<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bantuan extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fronModel');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['page_title']="Bantuan";
		
		$tampil['captcha']=$this->fronModel->setCaptcha();

		$tampil['formAction']=base_url('bantuan/proses');
		
		$this->final_view('front/bantuan/bantuan', $tampil);
	}

	public function proses() {
		$data = array(
			'id_bantuan' => '',
			'nama' => $this->input->post('nama'),
			'subjek' => $this->input->post('subjek'),
			'email' => $this->input->post('email'),
			'pesan' => $this->input->post('pesan'),
			'tgl' => date('Y-m-d h:i:s'),
			'sts' => '0',
		);

		if ($this->input->post('captcha') == $this->session->userdata('captcha')) {

			$this->load->helper('email');
			if (valid_email($this->input->post('email'))) {
				$this->fronModel->insert('job_bantuan', $data);
				$this->session->set_flashdata('berhasil', 'Proses Pengiriman Pesan berhasil di lakukan.');
				redirect(site_url('bantuan'));
			} else {
				$this->session->set_flashdata('gagal', 'Email tidak Valid, Gagal mengirim Informasi kepada jeLoker.com');
				redirect(site_url('bantuan'));
			}
		} else {
			$this->session->set_flashdata('gagal', 'Gagal Mengirim Pesan Karena Hasil Salah, Silahkan Input Kembali.');
			redirect(site_url('bantuan'));
		}
	}

}