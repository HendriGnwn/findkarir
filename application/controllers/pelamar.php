<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelamar extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('fungsi_date');
		$this->load->model('fronModel');
		date_default_timezone_set("Asia/Jakarta");
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		if($this->session->userdata('id_login')==null || $this->session->userdata('hak_akses')=='perusahaan'){
			redirect(base_url('error/error404'));
		}else
		if($this->session->userdata('id_login')==null && $this->session->userdata('hak_akses')=='perusahaan'){
			redirect(base_url('error/error404'));
		}
	}

	public function index()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Akun Pelamar";
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

		$akun = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$this->session->userdata('id_login')));
		$tampil['row']['nm_pelamar']=$akun->nama;
		$tampil['row']['no_ktp']=$akun->no_ktp;
		$tampil['row']['tmp_lhr']=$akun->tmp_lhr;
		if($akun->tgl_lhr!=''){
			$tampil['row']['tgl_lhr']=$akun->tgl_lhr;
			$tampil['row']['tanggalLahir']=tgl_indo($akun->tgl_lhr);
		}
		$tampil['row']['jk']=$akun->jk;
		$tampil['row']['agama']=$akun->agama;
		$tampil['row']['alamat']=$akun->alamat;
		$tampil['row']['kota']=$akun->kota;
		$tampil['row']['kodepos']=$akun->kodepos;
		$tampil['row']['email']=$akun->email;
		$tampil['row']['no_telp']=$akun->no_telp;
		$tampil['row']['sts_kawin']=$akun->sts_kawin;
		$tampil['row']['pendidikan']=$akun->pendidikan;
		$tampil['row']['deskripsi']=$akun->deskripsi;
		$tampil['row']['foto']=$akun->foto;


		$tampil['loadLamaran']= $this->fronModel->showLamaran();
		$tampil['loadJadwal']= $this->fronModel->showLamaranById();
		//$tampil['numRowsLowongan']=$this->fronModel->getLowonganPerusahaanNumRows();


		$data['content']=$this->load->view('front/pelamar/akun_pelamar', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

	public function prosesEditProfil()
	{
		$config['upload_path'] = "./assets/upload/img/";
		$config['allowed_types']= 'gif|jpg|png|jpeg';
		$config['max_size'] = '1000';
		$config['file_name']= $this->session->userdata('id_login');
		$this->load->library('upload', $config);

		if ($this->upload->do_upload("file")) {
			$data = $this->upload->data();

			$unlink = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$this->session->userdata('id_login')));
			if($unlink->foto=='' || $unlink->foto==null){
				echo "";
			}else{
				$source = './assets/upload/img/'.$unlink->foto;
				unlink($source);
			}
			
			/* PATH */
			$source = "./assets/upload/img/".$data['file_name'] ;
			$foto = $data['file_name'];
			$destination_medium = "./assets/upload/img/" ;

			// Configuration Of Image Manisulation :: Static
			$this->load->library('image_lib') ;
			$img['image_library'] = 'GD2';
			$img['create_thumb'] = TRUE;
			$img['maintain_ratio']= TRUE;
			/// Limit Width Resize
			$limit_medium = 300 ;
			// Size Image Limit was using (LIMIT TOP)
			$limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			// Percentase Resize
			if ($limit_use > $limit_medium) {
				$percent_medium = $limit_medium/$limit_use ;
			}
			
			////// Making MEDIUM /////////////
			$img['width'] = $limit_use > $limit_medium ? $data['image_width'] * $percent_medium : $data['image_width'] ;
			$img['height'] = $limit_use > $limit_medium ? $data['image_height'] * $percent_medium : $data['image_height'] ;

			// Configuration Of Image Manisulation :: Dynamic
			$img['thumb_marker'] = '' ;
			$img['quality'] = '100%' ;
			$img['source_image'] = $source ;
			$img['new_image'] = $destination_medium ;

			// Do Resizing
			$this->image_lib->initialize($img);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$data1 = array(
					'nama'=>strtoupper($this->input->post('nm_pelamar')),
					'no_ktp'=>$this->input->post('no_ktp'),
					'tmp_lhr'=>$this->input->post('tmp_lhr'),
					'tgl_lhr'=>$this->input->post('tgl_lhr'),
					'jk'=>$this->input->post('jk'),
					'agama'=>$this->input->post('agama'),
					'alamat'=>$this->input->post('alamat'),
					'kota'=>$this->input->post('kota'),
					'kodepos'=>$this->input->post('kodepos'),
					'email'=>$this->input->post('email'),
					'foto'=>$foto,
					'no_telp'=>$this->input->post('no_telp'),
					'sts_kawin'=>$this->input->post('sts_kawin'),
					'pendidikan'=>$this->input->post('pendidikan'),
					'deskripsi'=>$this->input->post('deskripsi'),
				);
			$this->session->set_userdata(array('nama'=>strtoupper($this->input->post('nm_pelamar'))));
			$this->fronModel->update('job_pelamar', $data1, array('id_pelamar'=> $this->session->userdata('id_login')));
			$this->session->set_flashdata('berhasil', 'Data dengan Upload Foto berhasil di Edit');
			redirect('pelamar', 'refresh');
		}else{
			$data = $this->upload->data();
			if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
				$this->session->set_flashdata('gagal', 'Size upload Logo melebihi 1MB, Gagal Edit, Silahkan Edit Kembali');
				redirect('pelamar', 'refresh');
			}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
				if($data['file_ext']==null || $data['file_ext']==''){
					$data1 = array(
							'nama'=>strtoupper($this->input->post('nm_pelamar')),
							'no_ktp'=>$this->input->post('no_ktp'),
							'tmp_lhr'=>$this->input->post('tmp_lhr'),
							'tgl_lhr'=>$this->input->post('tgl_lhr'),
							'jk'=>$this->input->post('jk'),
							'agama'=>$this->input->post('agama'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'kodepos'=>$this->input->post('kodepos'),
							'email'=>$this->input->post('email'),
							'no_telp'=>$this->input->post('no_telp'),
							'sts_kawin'=>$this->input->post('sts_kawin'),
							'pendidikan'=>$this->input->post('pendidikan'),
							'deskripsi'=>$this->input->post('deskripsi'),
						);
					$this->session->set_userdata(array('nama'=>strtoupper($this->input->post('nm_pelamar'))));
					$this->fronModel->update('job_pelamar', $data1, array('id_pelamar'=> $this->session->userdata('id_login')));
					$this->session->set_flashdata('berhasil', 'Data tanpa Upload Foto berhasil di Edit');
					redirect('pelamar', 'refresh');
				}else{
					$this->session->set_flashdata('gagal', 'File Extension yang diperbolehkan adalah <b>.pdf</b>, bukan extension <b>'.$data['file_ext'].'</b>, silahkan Edit Kembali');
					redirect('pelamar', 'refresh');
				}
			}
		}
	}

	public function prosesEditPassword()
	{
		$passlama = $this->input->post('passlama');
		$passbaru = $this->input->post('passbaru');
		$konfpass = $this->input->post('konfpass');
		if($this->fronModel->cekPassword($passlama, 'job_pelamar')==TRUE){
			if(md5($passbaru)==md5($konfpass)){
				$data = array(
						'password' => md5($passbaru),
						'pass_view'=> $passbaru,
					);
				$this->fronModel->update('job_pelamar', $data, array('id_pelamar'=>$this->session->userdata('id_login')));
				$this->session->set_flashdata('berhasil', 'Password berhasil di Ubah');
				redirect('pelamar', 'refresh');
			}else{
				$this->session->set_flashdata('gagal', 'Password & Konfirmasi Password beda, Silahkan Input Kembali');
				redirect('pelamar', 'refresh');
			}
		}else{
			$this->session->set_flashdata('gagal', 'Password Lama tidak cocok, Silahkan Input Kembali');
			redirect('pelamar', 'refresh');
		}
	}
}