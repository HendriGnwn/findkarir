<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lowongan extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('fungsi_date');
		$this->load->model('fronModel');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Halaman Lowongan. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['page_title']="Lowongan Kerja";
		
		$config['base_url'] = base_url('lowongan/index/');
		//jumlah total data
        $config['total_rows'] = $this->fronModel->totalLowongan();
		//jumlah data per halaman
		$config['per_page']=20;
		//jumah link no halaman 
		$config['num_links'] = 10;
		//segment URL yang akan dijadikan pemotongan data
		//baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
		$config['uri_segment'] = 3;
		// awal membuka penomoran 
		// menggunakan class bootstrap
		$config['full_tag_open'] = '<ul class="pagination">';
		// akhi membuka penomoran 
		$config['full_tag_close'] = '</ul>';
		//pembuka link ke awal data
		$config['first_tag_open'] = '<li class="page-num">';
		//penutup link ke akhir data
		$config['first_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev-page">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next-page">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		//class untuk halaman aktif
		$config['cur_tag_open'] = '<li class=""><a class="current page-num" style="background: #EE3733; color: #fff;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-num">';
		$config['num_tag_close'] = '</li>';
		//class bootstrap untuk awal halaman
		$config['first_link'] = '<span class="glyphicon glyphicon-fast-backward"></span>';
		//class bootstrap untuk akhir halaman
		$config['last_link'] = '<span class="glyphicon glyphicon-fast-forward"></span>';
		//class bootstrap untuk  halaman berikutnya
		$config['next_link'] = '<span class="glyphicon glyphicon-step-forward"></span>';
		//class bootstrap untuk  halaman sebelumnya
		$config['prev_link'] = '<span class="glyphicon glyphicon-step-backward"></span>';
		// inisialisasi paging
		$this->pagination->initialize($config);
		// membuat paging dan disimpan dalam array $halaman
		$tampil['halaman'] = $this->pagination->create_links();
		// mengambil data per halaman

		$tampil['loadLowongan'] = $this->fronModel->getLowongan($config['per_page'], $this->uri->segment('3'));
		if($tampil['loadLowongan']==''){
			$tampil['alert_kosong']="Data Lowongan Kerja sementara tidak tampil ..";
		}
		$this->final_view('front/lowongan/lowongan', $tampil);
	}

	public function detailLowongan($id)
	{
		$tampil['loadLowongan'] = $this->fronModel->getLowonganById($id);
		foreach($tampil['loadLowongan'] as $lowongan):
			$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " Lowongan Kerja | ".$lowongan->nm_lowongan.", ".$lowongan->nm_k_lowongan.", ".$lowongan->kota." - ".$lowongan->provinsi.", Tanggal ".tgl_indo($lowongan->date_post)." - ".tgl_indo($lowongan->date_close);
			$tampil['page_title'] = $lowongan->nm_lowongan;
		endforeach;

		$this->final_view('front/lowongan/detail', $tampil);
	}

	public function melamar($id)
	{
		if(($this->session->userdata('id_login')=='' || $this->session->userdata('id_login')==null) && $this->session->userdata('hak_akses')==''){
			$this->session->set_flashdata('gagal', 'Anda harus Login terlebih dahulu sebelum Melamar ...');
			redirect(site_url('login/masukDulu/'.$id));
		}elseif(($this->session->userdata('id_login')!='' || $this->session->userdata('id_login')!=null) && $this->session->userdata('hak_akses')=='pelamar'){
			
			$tampil['loadLowongan'] = $this->fronModel->getLowonganById($id);
			foreach($tampil['loadLowongan'] as $lowongan):
				$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " Lowongan Kerja | ".$lowongan->nm_lowongan.", ".$lowongan->nm_k_lowongan.", ".$lowongan->kota." - ".$lowongan->provinsi.", Tanggal ".tgl_indo($lowongan->date_post)." - ".tgl_indo($lowongan->date_close);
				$tampil['title_head'] = $lowongan->nm_lowongan;
			endforeach;

			$tampil['formAction']=base_url('lowongan/prosesMelamar/'.$id);

			$this->final_view('front/lowongan/melamar', $tampil);
		}else{
			$this->session->set_flashdata('gagal', 'Perusahaan tidak bisa melamar ...');
			redirect(site_url('lowingan/detailLowongan/'.$id));
		}
	}

	public function prosesMelamar($id) 
	{
		if ($this->fronModel->cekId(array('id_lowongan' => $id, 'id_pelamar' => $this->session->userdata('id_login')), 'job_lamar') == TRUE) {
			$this->session->set_flashdata('gagal', 'Anda Sudah Melamar kesini sebelumnya, Tidak bisa melamar kembali karena sudah terdata ..');
			redirect('lowongan/melamar/' . $id, 'refresh');
		} else {

			$auto_number = $this->fronModel->setAutoNumber('job_lamar', date('mds'));
			$config['upload_path'] = "./assets/upload/pelamar/";
			$config['max_size'] = "1000";
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['file_name'] = $auto_number;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload("file")) {
				$data = $this->upload->data();

				$cek = $this->fronModel->showById('job_lowongan', array('id_lowongan' => $id));
				$cek1 = $this->fronModel->showById('job_perusahaan', array('id_perusahaan' => $cek->id_perusahaan));

				$data1 = array(
					'id_lamar' => $auto_number,
					'id_lowongan' => $id,
					'id_perusahaan' => $cek->id_perusahaan,
					'id_pelamar' => $this->session->userdata('id_login'),
					'cv' => $data['file_name'],
					'sts_lamar' => 0,
					'tgl_create' => date('Y-m-d h:i:s'),
					'tgl_datang' => null,
					'jam_datang' => null,
					'almt_datang' => null,
					'ket' => $this->input->post('ket'),
				);
				$this->fronModel->insert('job_lamar', $data1);
				$this->session->set_flashdata('berhasil', 'Anda Sudah Melamar sebagai ' . $cek->nm_lowongan . ' di ' . $cek1->nm_perusahaan);
				redirect('lowongan', 'refresh');
			} else {
				$data = $this->upload->data();
				if (($data['file_ext'] == '.doc' || $data['file_ext'] == '.docx' || $data['file_ext'] == '.pdf') && ($data['file_size'] == '' || $data['file_size'] == null || $data['file_size'] > 1000)) {
					$this->session->set_flashdata('gagal', 'Max Size 1MB, melebihi batas upload PDF');
				} else
				if ($data['file_ext'] != '.pdf' || $data['file_ext'] != '.doc' || $data['file_ext'] != '.docx') {
					$this->session->set_flashdata('gagal', 'File Extension yang diperbolehkan adalah <b>.pdf, .doc, .docx</b>, bukan extension <b>' . $data['file_ext'] . '</b>');
				}
				redirect('lowongan/melamar/' . $id, 'refresh');
			}
		}
	}

	public function cari()
	{
		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Halaman Lowongan. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['page_title']="Pencarian Lowongan Kerja";
		
		$config['base_url'] = base_url('lowongan/cari/');
		//jumlah total data
        $config['total_rows'] = $this->fronModel->totalCariLowongan($this->input->get('search'));
		//jumlah data per halaman
		$config['per_page']=20;
		//jumah link no halaman 
		$config['num_links'] = 10;
		//segment URL yang akan dijadikan pemotongan data
		//baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
		$config['uri_segment'] = 3;
		// awal membuka penomoran 
		// menggunakan class bootstrap
		$config['full_tag_open'] = '<ul class="pagination">';
		// akhi membuka penomoran 
		$config['full_tag_close'] = '</ul>';
		//pembuka link ke awal data
		$config['first_tag_open'] = '<li class="page-num">';
		//penutup link ke akhir data
		$config['first_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev-page">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next-page">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		//class untuk halaman aktif
		$config['cur_tag_open'] = '<li class=""><a class="current page-num" style="background: #EE3733; color: #fff;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-num">';
		$config['num_tag_close'] = '</li>';
		//class bootstrap untuk awal halaman
		$config['first_link'] = '<span class="glyphicon glyphicon-fast-backward"></span>';
		//class bootstrap untuk akhir halaman
		$config['last_link'] = '<span class="glyphicon glyphicon-fast-forward"></span>';
		//class bootstrap untuk  halaman berikutnya
		$config['next_link'] = '<span class="glyphicon glyphicon-step-forward"></span>';
		//class bootstrap untuk  halaman sebelumnya
		$config['prev_link'] = '<span class="glyphicon glyphicon-step-backward"></span>';
		// inisialisasi paging
		$this->pagination->initialize($config);
		// membuat paging dan disimpan dalam array $halaman
		$tampil['halaman'] = $this->pagination->create_links();
		// mengambil data per halaman

		$tampil['loadLowongan'] = $this->fronModel->cariLowongan($this->input->get('search'), $config['per_page'], $this->uri->segment('3'));
		if($tampil['loadLowongan']==''){
			$tampil['alert_kosong']="Pencarian Keyword '<b>".$this->input->get('search')."</b>' Data Lowongan Kerja tidak di Temukan";
		}

		$this->final_view('front/lowongan/lowongan', $tampil);
	}

	public function search()
	{
		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Halaman Lowongan. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['page_title']="Pencarian Lowongan Kerja";
		
		$config['base_url'] = base_url('lowongan/search/');
		//jumlah total data
        $config['total_rows'] = $this->fronModel->totalCariLowonganBerdasarkan($this->input->get('posisi'));
		//jumlah data per halaman
		$config['per_page']=10;
		//jumah link no halaman 
		$config['num_links'] = 10;
		//segment URL yang akan dijadikan pemotongan data
		//baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
		$config['uri_segment'] = 3;
		// awal membuka penomoran 
		// menggunakan class bootstrap
		$config['full_tag_open'] = '<ul class="pagination">';
		// akhi membuka penomoran 
		$config['full_tag_close'] = '</ul>';
		//pembuka link ke awal data
		$config['first_tag_open'] = '<li class="page-num">';
		//penutup link ke akhir data
		$config['first_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev-page">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next-page">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		//class untuk halaman aktif
		$config['cur_tag_open'] = '<li class=""><a class="current page-num" style="background: #EE3733; color: #fff;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-num">';
		$config['num_tag_close'] = '</li>';
		//class bootstrap untuk awal halaman
		$config['first_link'] = '<span class="glyphicon glyphicon-fast-backward"></span>';
		//class bootstrap untuk akhir halaman
		$config['last_link'] = '<span class="glyphicon glyphicon-fast-forward"></span>';
		//class bootstrap untuk  halaman berikutnya
		$config['next_link'] = '<span class="glyphicon glyphicon-step-forward"></span>';
		//class bootstrap untuk  halaman sebelumnya
		$config['prev_link'] = '<span class="glyphicon glyphicon-step-backward"></span>';
		// inisialisasi paging
		$this->pagination->initialize($config);
		// membuat paging dan disimpan dalam array $halaman
		$tampil['halaman'] = $this->pagination->create_links();
		// mengambil data per halaman

		$tampil['loadLowongan'] = $this->fronModel->cariLowonganBerdasarkan($this->input->get('posisi'), $config['per_page'], $this->uri->segment('3'));
		if($tampil['loadLowongan']==''){
			$tampil['alert_kosong']="Pencarian Keyword '<b>".$this->input->get('posisi')."</b>' Data Lowongan Kerja tidak di Temukan";
		}

		$this->final_view('front/lowongan/lowongan', $tampil);
	}
}