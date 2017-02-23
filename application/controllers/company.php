<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
	
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

		if($this->session->userdata('id_login')==null || $this->session->userdata('hak_akses')=='pelamar'){
			redirect(base_url('error/error404'));
		}else
		if($this->session->userdata('id_login')==null && $this->session->userdata('hak_akses')=='pelamar'){
			redirect(base_url('error/error404'));
		}
	}

	public function index()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Akun Perusahaan";
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

		//$tampil['loadAkun']=$this->fronModel->getAkunPerusahaan();
		$akun = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$this->session->userdata('id_login')));
		$tampil['row']['nm_perusahaan']=$akun->nm_perusahaan;
		$tampil['row']['no_izin']=$akun->no_izin;
		$tampil['row']['tentang']=$akun->tentang;
		$tampil['row']['no_telp']=$akun->no_telp;
		$tampil['row']['no_fax']=$akun->no_fax;
		$tampil['row']['web_url']=$akun->almt_web;
		$tampil['row']['alamat']=$akun->alamat;
		$tampil['row']['email']=$akun->email;
		$tampil['row']['logo']=$akun->logo;

		$tampil['loadLowongan']= $this->fronModel->getLowonganPerusahaan();
		$tampil['numRowsLowongan']=$this->fronModel->getLowonganPerusahaanNumRows();
		$tampil['loadKonfirmasi']=$this->fronModel->aktivasiLim('5');


		$data['content']=$this->load->view('front/perusahaan/akun_perusahaan', $tampil, true);
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

			$unlink = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$this->session->userdata('id_login')));
			if($unlink->logo=='' || $unlink->logo==null){
				echo "";
			}else{
				$source = './assets/upload/img/'.$unlink->logo;
				unlink($source);
			}
			
			/* PATH */
			$source = "./assets/upload/img/".$data['file_name'] ;
			$logo = $data['file_name'];
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
			$this->image_lib->clear() ;

			$data1 = array(
					'nm_perusahaan'=>strtoupper($this->input->post('nm_perusahaan')),
					'logo'=>$logo,
					'almt_web'=>$this->input->post('web_url'),
					'no_izin'=>$this->input->post('no_izin'),
					'alamat'=>$this->input->post('alamat'),
					'tentang'=>$this->input->post('tentang'),
					'no_telp'=>$this->input->post('no_telp'),
					'no_fax'=>$this->input->post('no_fax'),
					'email'=>$this->input->post('email'),
				);
			$this->session->set_userdata(array('nama'=>strtoupper($this->input->post('nm_perusahaan'))));
			$this->fronModel->update('job_perusahaan', $data1, array('id_perusahaan'=> $this->session->userdata('id_login')));
			$this->session->set_flashdata('berhasil', 'Data dengan Upload Logo berhasil di Edit');
			redirect('company', 'refresh');
		}else{
			$data = $this->upload->data();
			if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
				$this->session->set_flashdata('gagal', 'Size upload Logo melebihi 1MB, Gagal Edit, Silahkan Edit Kembali');
				redirect('company', 'refresh');
			}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
				if($data['file_ext']==null || $data['file_ext']==''){
					$data1 = array(
						'nm_perusahaan'=>strtoupper($this->input->post('nm_perusahaan')),
						'almt_web'=>$this->input->post('web_url'),
						'no_izin'=>$this->input->post('no_izin'),
						'alamat'=>$this->input->post('alamat'),
						'tentang'=>$this->input->post('tentang'),
						'no_telp'=>$this->input->post('no_telp'),
						'no_fax'=>$this->input->post('no_fax'),
						'email'=>$this->input->post('email'),
					);
					$this->session->set_userdata(array('nama'=>strtoupper($this->input->post('nm_perusahaan'))));
					
					$this->fronModel->update('job_perusahaan', $data1, array('id_perusahaan'=> $this->session->userdata('id_login')));
					$this->session->set_flashdata('berhasil', 'Data Tanpa Upload Logo berhasil di Edit');
					redirect('company', 'refresh');
				}else{
					$this->session->set_flashdata('gagal', 'File Extension yang diperbolehkan adalah <b>.pdf</b>, bukan extension <b>'.$data['file_ext'].'</b>, silahkan Edit Kembali');
					redirect('company', 'refresh');
				}
			}
		}
	}

	public function prosesEditPassword()
	{
		$passlama = $this->input->post('passlama');
		$passbaru = $this->input->post('passbaru');
		$konfpass = $this->input->post('konfpass');
		if($this->fronModel->cekPassword($passlama, 'job_perusahaan')==TRUE){
			if(md5($passbaru)==md5($konfpass)){
				$data = array(
						'password' => md5($passbaru),
						'pass_view'=> $passbaru,
					);
				$this->fronModel->update('job_perusahaan', $data, array('id_perusahaan'=>$this->session->userdata('id_login')));
				$this->session->set_flashdata('berhasil', 'Password berhasil di Ubah');
				redirect('company', 'refresh');
			}else{
				$this->session->set_flashdata('gagal', 'Password & Konfirmasi Password beda, Silahkan Input Kembali');
				redirect('company', 'refresh');
			}
		}else{
			$this->session->set_flashdata('gagal', 'Password Lama tidak cocok, Silahkan Input Kembali');
			redirect('company', 'refresh');
		}
	}

	public function tambahIklan()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Paket Pembayaran";
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

		$tampil['loadGolongan']=$this->fronModel->show('job_golongan', 'id_golongan', 'asc');

		$data['content']=$this->load->view('front/perusahaan/golongan', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

	public function tambahIklanLanjut()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Pasang Iklan Lowongan";
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

		$tampil['formAction']=base_url("company/prosesTambahIklan");
		$tampil['button']="SIMPAN DATA &nbsp;-&nbsp; SELANJUTNYA &nbsp;&nbsp;<i class='fa fa-angle-right'></i>";
		$tampil['title']="Pasang Iklan Lowongan";
		$tampil['kat_lowongan']=$this->fronModel->show('job_k_lowongan', 'nm_k_lowongan', 'ASC');
		$tampil['kat']=$this->fronModel->show('job_type', 'id_type', 'ASC');
		$tampil['gol']=$this->fronModel->show('job_golongan', 'id_golongan', 'ASC');
		$tampil['row']['date_post']=date('Y-m-d');

		$tampil['loadGolongan']=$this->fronModel->show('job_golongan', 'id_golongan', 'asc');

		$data['content']=$this->load->view('front/perusahaan/tambahIklan', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

			public function golDetailKategori()
			{
            	$query=$this->fronModel->getKatGolongan($this->input->post('golongan'));
		        echo '<option value="">... Pilih Limit Waktu // Harga ...</option>';
	            foreach($query as $row)
                { 
                 echo "<option value='".$row->id_k_golongan."'>".$row->limit_waktu." Hari // Rp. ".number_format($row->harga, 0, ',', '.').",-</option>";
                }
			}
				public function golKetKategori()
				{
					$query=$this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$this->input->post('kGol')));
					//echo "<input type='text' name='close' value='".$query->."' class='form-control' />";
					$tambah = $query->limit_waktu." day";
					echo tgl_indo(addDate(date('Y-m-d'), $tambah));
				}

		public function prosesTambahIklan()
		{
			$data = array(
					'id_lowongan'=>$this->fronModel->setAutoNumber('job_lowongan', date('mjh')),
					'id_perusahaan'=>$this->session->userdata('id_login'),
					'id_k_low'=>$this->input->post('katLowongan'),
					'nm_lowongan'=>$this->input->post('lowongan'),
					'kualifikasi'=>$this->input->post('kualifikasi'),
					'benefit'=>$this->input->post('benefit'),
					'gaji'=>$this->input->post('gaji'),
					'kota'=>$this->input->post('kota'),
					'provinsi'=>$this->input->post('provinsi'),
					'date_post'=>$this->input->post('date_post'),
					'date_close'=>$this->input->post('date_close'),
					'aktif'=>'3',
					'id_golongan'=>$this->input->post('golongan'),
					'id_type'=>$this->input->post('type'),
				);

				$id_lowongan = $this->fronModel->insert('job_lowongan', $data);

				$setHarga = $this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$this->input->post('kGol')));
				$tambah = $setHarga->limit_waktu." day";
				$date_limit = addDate(date('Y-m-d'), $tambah);
				$data1 = array(
					'id_aktivasi'=>$this->fronModel->setAutoNumber('job_aktivasi', date('dmi')),
					'id_lowongan'=>$id_lowongan,
					'id_perusahaan'=>$this->session->userdata('id_login'),
					'id_k_golongan'=>$this->input->post('kGol'),
					'harga'=>$setHarga->harga,
					'date_bill'=>date('Y-m-d'),
					'date_limit'=>$date_limit,
					'upload_bukti'=>null,
					'ket'=>null,
					'status'=>'0',
					);
				//echo var_dump($data);
				//echo "<br>";
				//echo var_dump($data1);
				$insert_id=$this->fronModel->insert('job_aktivasi', $data1);
				$this->session->set_flashdata('berhasil', 'Data '.$this->input->post('lowongan').' Sukses di Simpan, Proses Transfer Anda lakukan agar Iklan bisa tampil..');
				redirect(site_url('company/pembayaran/'.$id_lowongan.'/'.$insert_id));
		}

	public function cetakStrukLowongan($id)
	{
		$cek = $this->fronModel->showById('job_aktivasi', array('id_aktivasi'=>$id));
		$cek1 = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
		$cek2 = $this->fronModel->showById('job_lowongan', array('id_lowongan'=>$cek->id_lowongan));
		$cek3 = $this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
		$cek4 = $this->fronModel->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

		$tampil['row']['id_perusahaan']=$cek1->id_perusahaan;
		$tampil['row']['perusahaan']=$cek1->nm_perusahaan;
		$tampil['row']['alamat']=$cek1->alamat;
		$tampil['row']['web']=$cek1->almt_web;

		$tampil['row']['id_lowongan']=$cek2->id_lowongan;
		$tampil['row']['nm_lowongan']=$cek2->nm_lowongan;
		$tampil['row']['kota']=$cek2->kota.", ".$cek2->provinsi;

		$tampil['row']['nm_golongan']=$cek4->nm_golongan;
		$tampil['row']['rating']=$cek4->rating;
		$tampil['row']['kode']=$cek4->kode;
		$tampil['row']['id_user']=$cek->id_user;

		$tampil['row']['id_aktivasi']="<b>".$cek->id_aktivasi."</b>";
		$tampil['row']['aktivasi_id']=$cek->id_aktivasi;
		$tampil['row']['struk']=base_url('assets/upload/img/'.$cek->upload_bukti);
		$tampil['row']['ket']=$cek->ket;
		$tampil['row']['harga']= "Rp. ".number_format($cek->harga, 0, ',', '.').",-";
		$tampil['row']['limit']=tgl_indo($cek->date_bill)." s/d <b>".tgl_indo($cek->date_limit)."</b>";
		$tampil['title']="STRUK BUKTI PEMBAYARAN";
		$this->load->view('front/perusahaan/cetak_data', $tampil);
	}

	public function detaiLIklan($id)
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Detail Iklan";
		$cek = $this->fronModel->detailLowonganById($id);
		$tampil['row']['pelamar']=$this->fronModel->showNumRowsById('job_lamar', array('id_lowongan'=>$id));
		$tampil['row']['id']=$cek->id_lowongan;
		$tampil['row']['lowongan']=$cek->nm_lowongan;
		$tampil['row']['alamat']=$cek->alamat;
		$tampil['row']['k_lowongan']=$cek->nm_k_lowongan;
		$tampil['row']['nm_perusahaan']=$cek->nm_perusahaan;
		$tampil['row']['email']=$cek->email;
		$tampil['row']['telp']=$cek->no_telp;
		$tampil['row']['kualifikasi']=$cek->kualifikasi;
		$tampil['row']['benefit']=$cek->benefit;
		$tampil['row']['gaji']=$cek->gaji;
		$tampil['row']['kota']=$cek->kota;
		$tampil['row']['provinsi']=$cek->provinsi;
		$tampil['row']['date_post']=$cek->date_post;
		$tampil['row']['date_close']=$cek->date_close;
		$tampil['row']['aktif']=$cek->aktif;
		$tampil['row']['status']=$cek->status;
		$tampil['row']['id_golongan']=$cek->id_golongan;
		$tampil['row']['golongan']=$cek->nm_golongan;
		$tampil['row']['rating']=$cek->rating;
		$tampil['row']['type']=$cek->nm_type;
		$tampil['row']['ket']=$cek->ket;
		$tampil['row']['bukti']=$cek->upload_bukti;

		
		if($cek->aktif=='1'){
			$tampil['loadData']=$this->fronModel->showPelamar($id);
			$tampil['alert_detail']="Iklan Lowongan sementara tidak ada Pelamar";
		}else{
			$tampil['loadData']='';
			$tampil['alert_detail']="Lihat Status Penayangan Iklan ini, selain Status TAYANG, Detail Pelamar tidak bisa di lihat oleh Anda.. Konfirmasi segera ke jeLoker.com";
		}

		$data['content']=$this->load->view('front/perusahaan/detail_iklan', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

	public function excelPelamar($low){
		$data['loadData']=$this->fronModel->showPelamar($low);
		$cek = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$this->session->userdata('id_login')));
		$data['perusahaan']=$cek->nm_perusahaan;
		$this->load->view('back/pelamar/excel', $data);
	}

	public function aktifLamar($link2, $id)
	{
		$tampil['title']="Keterangan Datang";
		$tampil['formAction']=base_url('company/prosesAktifLamar/'.$link2.'/'.$id);
		$data['content']=$this->load->view('front/perusahaan/aktif_lamar', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);	
	}
		public function prosesAktifLamar($link2, $id)
		{
			$cek = $this->fronModel->showById('job_lamar', array('id_lamar'=>$id));
			$cekPerusahaan = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
			$cekEmail = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$cek->id_pelamar));
			$this->load->library('upload');
			$this->load->library('email');
			
			//konfigurasi email
			$config = array();
			$config['charset'] = 'iso-8859-1';
			$config['useragent'] = 'Codeigniter';
			$config['protocol']= "smtp";
			$config['mailtype']= "html";
			$config['smtp_host']= "ssl://smtp.gmail.com";
			$config['smtp_port']= "465";
			$config['smtp_timeout']= "5";
			$config['smtp_user']= "hendrigunawan195@gmail.com"; //email hendrigunawan
			$config['smtp_pass']= "085718061049"; //password
			$config['crlf']="\r\n"; 
			$config['newline']="\r\n"; 
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['wordwrap'] = TRUE;
			//memanggil library email dan set konfigurasi untuk pengiriman email
			
			$this->email->initialize($config);
			//konfigurasi pengiriman
			$this->email->from('hendrigunawan195@gmail.com', 'KONFIRMASI LOWONGAN KERJA | INTERVIEW');
			$this->email->cc("hendrigunawan195@gmail.com","KONFIRMASI LOWONGAN KERJA | INTERVIEW");  //email address that receives the response
			$this->email->to($cekEmail->email);
			$this->email->subject("DI TUNGGU KEDATANGAN ANDA DI ".$cekPerusahaan->nm_perusahaan);
			$this->email->message("Datang ke Alamat <b>'".$this->input->post('ket')."'</b> Tanggal <b>'".$this->input->post('tgl_datang')."'</b> Pukul <b>'".$this->input->post('jam_datang')."'</b>");
			//Configure upload.
			
			if($this->email->send())
			{
				$data = array(
					'tgl_datang'=>$this->input->post('tgl_datang'),
					'jam_datang'=>$this->input->post('jam_datang'),
					'almt_datang'=>$this->input->post('ket'),
					'sts_lamar'=>'1',
				);
				$this->fronModel->update('job_lamar', $data, array('id_lamar'=>$id));
				$this->session->set_flashdata('berhasil', 'Data Sukses di Edit dan sudah kirim Email');
				redirect(site_url('company/detailIklan/'.$link2));
			}else
			{
				$data = array(
					'tgl_datang'=>$this->input->post('tgl_datang'),
					'jam_datang'=>$this->input->post('jam_datang'),
					'almt_datang'=>$this->input->post('ket'),
					'sts_lamar'=>'1',
				);
				$this->fronModel->update('job_lamar', $data, array('id_lamar'=>$id));
				$this->session->set_flashdata('berhasil', 'Data Sukses di Edit dan sudah tidak mengirim Email karenna Gangguan jaringan');
				redirect(site_url('company/detailIklan/'.$link2));
			}
		}

	public function detailPelamar($id)
		{
			$cek = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$id));
			//echo var_dump($cek);
			$tampil['row']['id']=$cek->id_pelamar;
			$tampil['row']['nama']=$cek->nama;
			$tampil['row']['ktp']=$cek->no_ktp;
			$tampil['row']['nama']=$cek->nama;
			$tampil['row']['foto']=$cek->foto;
			$tampil['row']['tmp_lhr']=$cek->tmp_lhr.", ".tgl_indo($cek->tgl_lhr);
			$tampil['row']['jk']=$cek->jk;
			$tampil['row']['agama']=$cek->agama;
			$tampil['row']['alamat']=$cek->alamat;
			$tampil['row']['kota']=$cek->kota." ".$cek->kodepos;
			$tampil['row']['email']=$cek->email;
			$tampil['row']['no_telp']=$cek->no_telp;
			$tampil['row']['sts_kawin']=$cek->sts_kawin;
			$tampil['row']['password']=$cek->pass_view;
			$tampil['row']['pendidikan']=$cek->pendidikan;
			$tampil['row']['jml_lamar']=$this->fronModel->showNumRowsById('job_lamar', array('id_pelamar'=>$id));;
			$tampil['row']['tgl_create']=tgl_indo_time1($cek->tgl_create);
			$this->load->view('front/perusahaan/detail_pelamar', $tampil);
		}

		public function pembayaran($id_low, $id_akt)
		{
			$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
			$tampil['title_head']="Konfirmasi Pembayaran";
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

			$tampil['formAction']=base_url("company/prosesPembayaran/".$id_low."/".$id_akt);
			$tampil['button']="KONFIRMASI";
			$tampil['title']="Konfirmasi Pembayaran";
			$tampil['kat_lowongan']=$this->fronModel->show('job_k_lowongan', 'nm_k_lowongan', 'ASC');
			$tampil['kat']=$this->fronModel->show('job_type', 'id_type', 'ASC');
			$tampil['gol']=$this->fronModel->show('job_golongan', 'id_golongan', 'ASC');
			$tampil['row']['date_post']=date('Y-m-d');

			$tampil['loadPembayaran']=$this->fronModel->show('job_golongan', 'id_golongan', 'asc');
			$tampil['loadBank']=$this->fronModel->show('job_rekening', 'id_rekening', 'asc');

			$cek = $this->fronModel->showById('job_aktivasi', array('id_aktivasi'=>$id_akt));
			$cek1 = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
			$cek2 = $this->fronModel->showById('job_lowongan', array('id_lowongan'=>$id_low));
			$cek3 = $this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
			$cek4 = $this->fronModel->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

			$tampil['row']['id_perusahaan']=$cek1->id_perusahaan;
			$tampil['row']['perusahaan']=$cek1->nm_perusahaan;
			$tampil['row']['alamat']=$cek1->alamat;
			$tampil['row']['web']=$cek1->almt_web;

			$tampil['row']['id_lowongan']=$cek2->id_lowongan;
			$tampil['row']['nm_lowongan']=$cek2->nm_lowongan;
			$tampil['row']['kota']=$cek2->kota.", ".$cek2->provinsi;

			$tampil['row']['nm_golongan']=$cek4->nm_golongan;
			$tampil['row']['rating']=$cek4->rating;
			$tampil['row']['kode']=$cek4->kode;
			$tampil['row']['iklan']=tgl_indo($cek2->date_post)." s/d ".tgl_indo($cek2->date_close);

			$tampil['row']['id_aktivasi']="<b>".$cek->id_aktivasi."</b>";
			$tampil['row']['aktivasi_id']=$cek->id_aktivasi;
			$tampil['row']['harga']= "Rp. ".number_format($cek->harga, 0, ',', '.').",-";
			$tampil['row']['limit']=tgl_indo($cek->date_bill)." s/d <b>".tgl_indo($cek->date_limit)."</b>";

			$data['content']=$this->load->view('front/perusahaan/pembayaran', $tampil, true);
			$data['footer']=$this->load->view('front/object/footer', $tampil, true);
			$this->load->view('front/object/template_utama', $data);
		}

		public function prosesPembayaran($id_low, $id_akt)
		{
			$config['upload_path'] = "./assets/upload/img/";
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$config['max_size'] = '1000';
			$config['file_name']= $id_akt;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload("file")) {
				$data = $this->upload->data();
				
				/* PATH */
				$source = "./assets/upload/img/".$data['file_name'] ;
				$bukti = $data['file_name'];
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
				$this->image_lib->clear() ;
		
				$data1 = array(
						'id_user'=>null,
						'upload_bukti'=>$bukti,
						'ket'=>'(Transfer ke BANK '.$this->input->post('bank').') '.$this->input->post('ket'),
						'status'=>'1',
					);
				$this->fronModel->update('job_aktivasi', $data1, array('id_aktivasi'=> $id_akt));
				redirect('company/cetakStrukLowongan/'.$id_akt, 'refresh');
			}else{
				$data = $this->upload->data();
				//echo var_dump($data);
				//echo $this->upload->display_errors();
				if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
					$this->session->set_flashdata('gagal', 'Size Foto melebihi 1MB');
					redirect('company/pembayaran/'.$id_low.'/'.$id_akt, 'refresh');
				}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
					$this->session->set_flashdata('gagal', 'File Extension yang diperbolehkan adalah <b>.gif| .jpg | .png | .jpeg</b>, bukan extension <b>'.$data['file_ext'].'</b>');
					redirect('company/pembayaran/'.$id_low.'/'.$id_akt, 'refresh');
				}
			}
		}

		public function cetakDataPembayaran($id_low, $id_akt)
		{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Konfirmasi Pembayaran";
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

		$tampil['formAction']=base_url("company/prosesPembayaran/".$id_low."/".$id_akt);
		$tampil['button']="KONFIRMASI";
		$tampil['title']="Konfirmasi Pembayaran";
		$tampil['kat_lowongan']=$this->fronModel->show('job_k_lowongan', 'nm_k_lowongan', 'ASC');
		$tampil['kat']=$this->fronModel->show('job_type', 'id_type', 'ASC');
		$tampil['gol']=$this->fronModel->show('job_golongan', 'id_golongan', 'ASC');
		$tampil['row']['date_post']=date('Y-m-d');

		$tampil['loadPembayaran']=$this->fronModel->show('job_golongan', 'id_golongan', 'asc');
		$tampil['loadBank']=$this->fronModel->show('job_rekening', 'id_rekening', 'asc');

		$cek = $this->fronModel->showById('job_aktivasi', array('id_aktivasi'=>$id_akt));
		$cek1 = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
		$cek2 = $this->fronModel->showById('job_lowongan', array('id_lowongan'=>$id_low));
		$cek3 = $this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
		$cek4 = $this->fronModel->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

		$tampil['row']['id_perusahaan']=$cek1->id_perusahaan;
		$tampil['row']['perusahaan']=$cek1->nm_perusahaan;
		$tampil['row']['alamat']=$cek1->alamat;
		$tampil['row']['web']=$cek1->almt_web;

		$tampil['row']['id_lowongan']=$cek2->id_lowongan;
		$tampil['row']['nm_lowongan']=$cek2->nm_lowongan;
		$tampil['row']['kota']=$cek2->kota.", ".$cek2->provinsi;

		$tampil['row']['nm_golongan']=$cek4->nm_golongan;
		$tampil['row']['rating']=$cek4->rating;
		$tampil['row']['kode']=$cek4->kode;
		$tampil['row']['iklan']=tgl_indo($cek2->date_post)." s/d ".tgl_indo($cek2->date_close);

		$tampil['row']['id_aktivasi']="<b>".$cek->id_aktivasi."</b>";
		$tampil['row']['aktivasi_id']=$cek->id_aktivasi;
		$tampil['row']['harga']= "Rp. ".number_format($cek->harga, 0, ',', '.').",-";
		$tampil['row']['limit']=tgl_indo($cek->date_bill)." s/d <b>".tgl_indo($cek->date_limit)."</b>";

		$data['content']=$this->load->view('front/perusahaan/cetak_data_pembayaran', $tampil);
		}

		public function perpanjang($id_low, $id_akt)
		{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Dapatkan Informasi Lowongan Kerja di sini";
		$tampil['title_head']="Perpanjang Iklan Lowongan";
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

		$tampil['formAction']=base_url("company/prosesPerpanjang/".$id_low."/".$id_akt);
		$tampil['button']="PERPANJANG";
		$tampil['title']="Perpanjang Iklan Lowongan";
		$tampil['kat_lowongan']=$this->fronModel->show('job_k_lowongan', 'nm_k_lowongan', 'ASC');
		$tampil['kat']=$this->fronModel->show('job_type', 'id_type', 'ASC');
		$tampil['gol']=$this->fronModel->show('job_golongan', 'id_golongan', 'ASC');
		$tampil['row']['date_post']=date('Y-m-d');

		$tampil['loadPembayaran']=$this->fronModel->show('job_golongan', 'id_golongan', 'asc');
		$tampil['loadBank']=$this->fronModel->show('job_rekening', 'id_rekening', 'asc');

		$cek = $this->fronModel->showById('job_aktivasi', array('id_aktivasi'=>$id_akt));
		$cek1 = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
		$cek2 = $this->fronModel->showById('job_lowongan', array('id_lowongan'=>$id_low));
		$cek3 = $this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
		$cek4 = $this->fronModel->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

		$tampil['row']['id_perusahaan']=$cek1->id_perusahaan;
		$tampil['row']['perusahaan']=$cek1->nm_perusahaan;
		$tampil['row']['alamat']=$cek1->alamat;
		$tampil['row']['web']=$cek1->almt_web;
		$tampil['row']['date_post']=$cek2->date_post;
		$tampil['row']['date_close']=$cek2->date_close;

		$tampil['row']['id_lowongan']=$cek2->id_lowongan;
		$tampil['row']['nm_lowongan']=$cek2->nm_lowongan;
		$tampil['row']['kota']=$cek2->kota.", ".$cek2->provinsi;

		$tampil['row']['nm_golongan']=$cek4->nm_golongan;
		$tampil['row']['rating']=$cek4->rating;
		$tampil['row']['kode']=$cek4->kode;
		$tampil['row']['iklan']=tgl_indo($cek2->date_post)." s/d ".tgl_indo($cek2->date_close);

		$tampil['row']['id_aktivasi']="<b>".$cek->id_aktivasi."</b>";
		$tampil['row']['aktivasi_id']=$cek->id_aktivasi;
		$tampil['row']['harga']= "Rp. ".number_format($cek->harga, 0, ',', '.').",-";
		$tampil['row']['limit']=tgl_indo($cek->date_bill)." s/d <b>".tgl_indo($cek->date_limit)."</b>";

		$data['content']=$this->load->view('front/perusahaan/perpanjang', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
		}

		public function prosesPerpanjang($id_low, $id_akt)
		{
			$config['upload_path'] = "./assets/upload/img/";
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';
				$config['file_name']= $id_akt;
				$this->load->library('upload', $config);

				if ($this->upload->do_upload("file")) {
					$data = $this->upload->data();

					$unlink = $this->fronModel->showById('job_aktivasi', array('id_aktivasi'=>$id_akt));
					if($unlink->upload_bukti=='' || $unlink->upload_bukti==null){
						echo "";
					}else{
						$source = './assets/upload/img/'.$unlink->upload_bukti;
						unlink($source);
					}
					
					/* PATH */
					$source = "./assets/upload/img/".$data['file_name'] ;
					$bukti = $data['file_name'];
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
					$this->image_lib->clear() ;

					$setHarga = $this->fronModel->showById('job_k_golongan', array('id_k_golongan'=>$this->input->post('kGol')));
					$tambah = $setHarga->limit_waktu." day";
					$date_limit = addDate(date('Y-m-d'), $tambah);
			
					$data1 = array(
							'id_golongan'=>$this->input->post('golongan'),
							'aktif'=>'3',
						);
					$data2 = array(
							'id_k_golongan'=>$this->input->post('kGol'),
							'harga'=>$setHarga->harga,
							'date_bill'=>date('Y-m-d'),
							'date_limit'=>$date_limit,
							'upload_bukti'=>$bukti,
							'status'=>'1',
							'ket'=>'(Transfer ke BANK '.$this->input->post('bank').') '.$this->input->post('ket'),
						);
					$this->fronModel->update('job_lowongan', $data1, array('id_lowongan'=> $id_low));
					$this->fronModel->update('job_aktivasi', $data2, array('id_aktivasi'=> $id_akt));
					redirect('company/cetakStrukLowongan/'.$id_akt, 'refresh');
				}else{
					$data = $this->upload->data();
					if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
						$this->session->set_flashdata('gagal', 'Size Foto melebihi 1MB');
						redirect('admin/perpanjang/'.$id_low.'/'.$id_akt, 'refresh');
					}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
						$this->session->set_flashdata('gagal', 'File Extension yang diperbolehkan adalah <b>.gif| .jpg | .png | .jpeg</b>, bukan extension <b>'.$data['file_ext'].'</b>');
						redirect('admin/perpanjang/'.$id_low.'/'.$id_akt, 'refresh');
					}
				}
		}

}