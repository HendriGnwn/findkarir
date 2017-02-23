<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {
	
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

			$tampil['loadBerita'] = $this->fronModel->show('job_berita', 'tgl', 'DESC');
			$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang=1', 'kategori', 'ASC');

			$tampil['meta_deskripsi']="jeLoker.com | Berita jeLoker.com";
			$tampil['title_head']="Berita jeLoker.com";

			$config['base_url'] = base_url('berita/index/');
			//jumlah total data
	        $config['total_rows'] = $this->fronModel->showNumRows('job_berita');
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
			$config['first_link']='<span class="glyphicon glyphicon-fast-backward"></span>';
		//class bootstrap untuk akhir halaman
			$config['last_link']='<span class="glyphicon glyphicon-fast-forward"></span>';
		//class bootstrap untuk  halaman berikutnya
			$config['next_link']='<span class="glyphicon glyphicon-step-forward"></span>';
		//class bootstrap untuk  halaman sebelumnya
			$config['prev_link']='<span class="glyphicon glyphicon-step-backward"></span>';
	// inisialisasi paging
	        $this->pagination->initialize($config);
	// membuat paging dan disimpan dalam array $halaman
			$tampil['halaman']=$this->pagination->create_links();
	// mengambil data per halaman

			$tampil['loadBerita'] = $this->fronModel->getBerita($config['per_page'], $this->uri->segment('3'));
			if($tampil['loadBerita']==''){
				$tampil['alert_kosong']="Data Lowongan Kerja sementara tidak tampil ..";
			}

			$data['content']=$this->load->view('front/tentang/berita', $tampil, true);
			$data['footer']=$this->load->view('front/object/footer', $tampil, true);
			$this->load->view('front/object/template_utama', $data);
	}

		public function detail($id)
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

			$loadDataCek = $this->fronModel->showById('job_berita', array('id_berita'=>$id));
			$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang=1', 'kategori', 'ASC');

			$tampil['meta_deskripsi']="jeLoker.com ".$loadDataCek->judul;
			$tampil['title_head']="Detail Berita jeLoker.com";

			$tampil['row']['judul']=$loadDataCek->judul;
			$tampil['row']['foto']=$loadDataCek->foto;
			$tampil['row']['tgl']=$loadDataCek->tgl;
			$tampil['row']['deskripsi']=$loadDataCek->deskripsi;

			$data['content']=$this->load->view('front/tentang/detail', $tampil, true);
			$data['footer']=$this->load->view('front/object/footer', $tampil, true);
			$this->load->view('front/object/template_utama', $data);
		}

	public function tentang($id)
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
			$k_tentang = $this->fronModel->showById('job_k_tentang', array('id_k_tentang'=>$loadDataCek->id_k_tentang));
			$tampil['kategoriData']=$this->fronModel->show('job_tentang WHERE id_k_tentang="'.$loadDataCek->id_k_tentang.'"', 'kategori', 'ASC');

			$tampil['meta_deskripsi']="jeLoker.com ".$loadDataCek->judul;
			$tampil['title_head']="Tentang jeLoker.com";

			$tampil['row']['judul']=$loadDataCek->judul;
			$tampil['row']['kategori']=$loadDataCek->kategori;
			$tampil['row']['tgl_update']=$loadDataCek->tgl_update;
			$tampil['row']['deskripsi']=$loadDataCek->deskripsi;
			$tampil['row']['untuk']=$k_tentang->nm_k_tentang;
			//$tampil['row']['judul']=$loadDataCek->judul;

			$data['content']=$this->load->view('front/tentang/tentang', $tampil, true);
			$data['footer']=$this->load->view('front/object/footer', $tampil, true);
			$this->load->view('front/object/template_utama', $data);
		}else{
			redirect(site_url('error/error404'));
		}
	}

}