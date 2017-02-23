<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fronModel');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		redirect(site_url('login/masuk'));
	}

	public function hit()
	{
		$row = $this->fronModel->showById('job_hit', array('id_hit'=>'1'));
		$id=($row->jml_hit)+(1);
		$update_hit = array('jml_hit'=>$id);
		$this->fronModel->update('job_hit', $update_hit, array('id_hit'=>'1'));
	}

	public function masuk()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Login Masuk ke Halaman Pribadi Pelamar";
		$tampil['title_head']="Login Masuk";
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
		$tampil['formAction']=base_url('login/prosesLogin');

		$data['content']=$this->load->view('front/login/login', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}
		public function prosesLogin()
		{
			$id = $this->input->post('email');
			$password = $this->input->post('password');
			if($this->fronModel->cekLoginPelamar($id, $password)==TRUE){
				$this->session->set_flashdata('berhasil', 'Anda Masuk ke Halaman Profil Anda, Isi Identitas Perusahaan jika belum terisi..');
				redirect('pelamar');
			}else{
				redirect('login/masuk');
			}
		}

	public function masukDulu($id)
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Login Masuk ke Halaman Pribadi Pelamar";
		$tampil['title_head']="Login Masuk";
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
		$tampil['formAction']=base_url('login/prosesLoginDulu/'.$id);

		$data['content']=$this->load->view('front/login/login', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}
		public function prosesLoginDulu($link)
		{
			$id = $this->input->post('email');
			$password = $this->input->post('password');
			if($this->fronModel->cekLoginPelamar($id, $password)==TRUE){
				$this->session->set_flashdata('berhasil', 'Login berhasil, silahkan ikuti Proses Selanjutnya ...');
				redirect('lowongan/melamar/'.$link);
			}else{
				redirect('login/masukDulu/'.$link);
			}
		}

	public function lupaPassword()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Login Masuk Lupa Password";
		$tampil['title_head']="Lupa Password";
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

		$tampil['formAction']=base_url('login/prosesLupaPassword');

		$data['content']=$this->load->view('front/login/lupa', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}
		public function prosesLupaPassword()
		{
			if($this->fronModel->cekId(array('id_pelamar'=>$this->input->post('id'), 'email'=>$this->input->post('email')), 'job_pelamar')==TRUE){
				$cek = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$this->input->post('id')));

				$pesan = "Anda Lupa Password, ini Identitas Anda...<ul><li>ID = ".$cek->id_pelamar."</li><li>email = ".$cek->email."</li><li>Password = ".$cek->pass_view."</li></ul>";

				$this->load->library('upload');
				$this->load->library('email');
				
				//konfigurasi email
				$config = array();
				$config['charset'] = 'iso-8859-1';
				$config['useragent'] = 'Codeigniter';
				$config['protocol']= "smtp";
				$config['mailtype']= "html";
				$config['smtp_host']= "mail.atc.co.id";
				$config['smtp_port']= "25";
				$config['smtp_timeout']= "5";
				$config['smtp_user']= "no-reply@atc.co.id";
				$config['smtp_pass']= "mTemT.9pupRN";
				$config['crlf']="\r\n"; 
				$config['newline']="\r\n"; 
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email
				
				$this->email->initialize($config);

				//konfigurasi pengiriman
				$this->email->from('no-reply@atc.co.id', 'Jeloker.com');
				$this->email->to($this->input->post('email'));
				$this->email->subject("Lupa Password | Jeloker.com");
				$this->email->message($pesan);
				//Configure upload.
				
				if($this->email->send())
				{
					$this->session->set_flashdata('berhasil', 'Password Bisa Lihat di Email Anda');
					redirect(site_url('login/masuk'));
				}else
				{
					$this->session->set_flashdata('gagal', 'Lupa Password Gagal mengirim, Koneksi tidak Ada...');
					redirect(site_url('login/lupaPassword'));
				}

			}else{
				$this->session->set_flashdata('gagal', 'ID dan Email tidak terdaftar ..');
				redirect(site_url('login/lupaPassword'));
			}
			
		}

	public function lupaPasswordPerusahaan()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Login Masuk Lupa Password Perusahaan";
		$tampil['title_head']="Lupa Password Perusahaan";
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
		$tampil['formAction']=base_url('login/prosesLupaPasswordPerusahaan');

		$data['content']=$this->load->view('front/login/lupa_perusahaan', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

		public function prosesLupaPasswordPerusahaan()
		{
			if($this->fronModel->cekId(array('id_perusahaan'=>$this->input->post('id'), 'email'=>$this->input->post('email')), 'job_perusahaan')==TRUE){
				$cek = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$this->input->post('id')));

				$pesan = "Anda Lupa Password, ini Identitas Anda...<ul><li>ID = ".$cek->id_perusahaan."</li><li>email = ".$cek->email."</li><li>Password = ".$cek->pass_view."</li></ul>";

				$this->load->library('upload');
				$this->load->library('email');
				
				//konfigurasi email
				$config = array();
				$config['charset'] = 'iso-8859-1';
				$config['useragent'] = 'Codeigniter';
				$config['protocol']= "smtp";
				$config['mailtype']= "html";
				$config['smtp_host']= "mail.atc.co.id";
				$config['smtp_port']= "25";
				$config['smtp_timeout']= "5";
				$config['smtp_user']= "no-reply@atc.co.id";
				$config['smtp_pass']= "mTemT.9pupRN";
				$config['crlf']="\r\n"; 
				$config['newline']="\r\n"; 
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email
				
				$this->email->initialize($config);

				//konfigurasi pengiriman
				$this->email->from('no-reply@atc.co.id', 'Jeloker.com');
				$this->email->to($this->input->post('email'));
				$this->email->subject("Lupa Password | Jeloker.com");
				$this->email->message($pesan);
				//Configure upload.
				
				if($this->email->send())
				{
					$this->session->set_flashdata('berhasil', 'Password Bisa Lihat di Email Anda');
					redirect(site_url('perusahaan'));
				}else
				{
					$this->session->set_flashdata('gagal', 'Lupa Password Gagal mengirim, Koneksi tidak Ada...');
					redirect(site_url('login/lupaPasswordPerusahaan'));
				}

			}else{
				$this->session->set_flashdata('gagal', 'ID dan Email tidak terdaftar ..');
				redirect(site_url('login/lupaPasswordPerusahaan'));
			}
			
		}

	public function daftar()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Daftar untuk Mencari Lowongan Kerja";
		$tampil['title_head']="Mendaftar";

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

		$tampil['formAction']=base_url('login/prosesDaftar');
		$tampil['captcha']=$this->fronModel->setCaptcha();

		$data['content']=$this->load->view('front/daftar/daftar', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

		public function prosesDaftar()
		{
			if($this->input->post('captcha')==$this->session->userdata('captcha')){
				if($this->input->post('password')==$this->input->post('passkonf')){
					if($this->fronModel->cekId(array('email'=>$this->input->post('email')), 'job_pelamar')==TRUE){
						$this->session->set_flashdata('gagal', 'Email sudah terpakai sebelumnya, silahkan input alamat email selain ini ...');
						redirect(site_url('login/daftar'));
					}else{
						$auto_number = $this->fronModel->setAutoNumber('job_pelamar', date('mj'));
						$pass = str_replace(' ', '', $this->input->post('password'));
						$password = md5($pass);
						$data = array(
							'id_pelamar'	=> $auto_number,
							'nama'			=> strtoupper($this->input->post('nama')),
							'no_ktp'		=>null,
							'tmp_lhr'		=>null,
							'tgl_lhr'		=>null,
							'jk'		=>null,
							'agama'		=>null,
							'alamat'		=>null,
							'kota'		=>null,
							'kodepos'		=>null,
							'email'			=> $this->input->post('email'),
							'no_telp'		=>null,
							'sts_kawin'		=>null,
							'pendidikan'	=>null,
							'deskripsi'		=>null,
							'foto'			=>null,
							'tgl_create'	=>date('Y-m-d h:i:s'),
							'password'		=> $password,
							'pass_view'		=> $pass,
							'last_login'	=>'0000-00-00 00:00:00',
							'sts_login'		=>'0',
							);
						$this->fronModel->insert('job_pelamar', $data);
						$this->session->set_flashdata('berhasil', 'Berhasil Mendaftar, silahkan Anda Login menggunakan Email dan Password Anda ..');
						redirect(site_url('login/daftar'));
					}
				}else{
					$this->session->set_flashdata('gagal', 'Gagal Mendaftar, Password dan Konfirmasi salah Input Password tidak boleh menggunakan Spasi, silahkan Input Kembali.');
					redirect(site_url('login/daftar'));
				}
			}else{
				$this->session->set_flashdata('gagal', 'Gagal Mendaftar Karena Hasil Salah, Silahkan Input Kembali.');
				redirect(site_url('login/daftar'));
			}
		}

	public function daftarPerusahaan()
	{
		$tampil['meta_deskripsi']="jeLoker.com | Gudangnya Informasi Lowongan Kerja. Daftar untuk Mencari Lowongan Kerja";
		$tampil['title_head']="Mendaftar Perusahaan";

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

		$tampil['captcha']=$this->fronModel->setCaptcha();

		$tampil['formAction']=base_url('login/prosesDaftarPerusahaan');

		$data['content']=$this->load->view('front/daftar/daftar_perusahaan', $tampil, true);
		$data['footer']=$this->load->view('front/object/footer', $tampil, true);
		$this->load->view('front/object/template_utama', $data);
	}

		public function prosesDaftarPerusahaan()
		{
			if($this->input->post('captcha')==$this->session->userdata('captcha')){
				if($this->fronModel->cekId(array('email'=>$this->input->post('email')), 'job_pelamar')==TRUE){
					$this->session->set_flashdata('gagal', 'Email sudah terpakai sebelumnya, silahkan input alamat email selain ini ...');
					redirect(site_url('login/daftarPerusahaan'));
				}else{
					$this->session->set_userdata(array('password'=>random_string('alnum', 8)));

					$this->load->library('upload');
					$this->load->library('email');
					
					//konfigurasi email
					$config = array();
					$config['charset'] = 'iso-8859-1';
					$config['useragent'] = 'Codeigniter';
					$config['protocol']= "smtp";
					$config['mailtype']= "html";
					$config['smtp_host']= "mail.atc.co.id";
					$config['smtp_port']= "25";
					$config['smtp_timeout']= "5";
					$config['smtp_user']= "no-reply@atc.co.id";
					$config['smtp_pass']= "mTemT.9pupRN";
					$config['crlf']="\r\n"; 
					$config['newline']="\r\n"; 
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['wordwrap'] = TRUE;
					//memanggil library email dan set konfigurasi untuk pengiriman email


					$auto_number = $this->fronModel->setAutoNumber('job_perusahaan', date('mjs'));
					$pesan = "Anda sudah terdaftar di JELOKER.COM sebagai Perusahaan, identitas untuk Login sebagai berikut.<ul><li>ID = ".$auto_number."</li><li>Email = ".$this->input->post('email')."</li><li>Password = ".$this->session->userdata('password')."</li></ul> Login Segera di (".base_url('perusahaan').")";
					
					$this->email->initialize($config);
					//konfigurasi pengiriman
					$this->email->from('no-reply@atc.co.id', 'Jeloker.com');

					$this->email->to($this->input->post('email'));
					$this->email->subject("Identitas ID dan Password Anda | Jeloker.com");
					$this->email->message($pesan);
					//Configure upload.
					
					if($this->email->send())
					{
						
						$data = array(
							'id_perusahaan'	=> $auto_number,
							'nm_perusahaan'	=> strtoupper($this->input->post('nama')),
							'logo'			=>null,
							'alamat'		=> $this->input->post('alamat'),
							'almt_web'		=>null,
							'no_izin'		=>null,
							'tentang'		=>null,
							'no_telp'		=> $this->input->post('no_telp'),
							'no_fax'		=> $this->input->post('no_fax'),
							'email'			=> $this->input->post('email'),
							'aktif'			=> '1',
							'tgl_create'	=> date('Y-m-d h:i:s'),
							'password'		=>md5($this->session->userdata('password')),
							'pass_view'		=>$this->session->userdata('password'),
							'last_login'	=>'0000:00:00 00:00:00',
							'sts_login'		=>'0',
						);
						//echo var_dump($data);
						$this->fronModel->insert('job_perusahaan', $data);
						$this->session->set_flashdata('berhasil', 'Berhasil Mendaftar, silahkan Cek Email Anda, terdapat ID dan Password untuk Login Perusahaan ..');
						$this->session->unset_userdata('password');
						redirect(site_url('perusahaan'));

					}else{
						$this->session->set_flashdata('gagal', 'Koneksi Internet Anda kurang, Gagal Mendaftar ...');
						redirect(site_url('login/daftarPerusahaan'));
					}
				}
			}else{
				$this->session->set_flashdata('gagal', 'Gagal Mendaftar Karena Hasil Salah, Silahkan Input Kembali.');
				redirect(site_url('login/daftarPerusahaan'));
			}
		}


	public function logout($hak_akses)
	{
		$data=array('sts_login' => '0');
		if($hak_akses=='perusahaan'){
			$table="job_perusahaan";
			$field="id_perusahaan";
		}elseif($hak_akses=='pelamar'){
			$table="job_pelamar";
			$field="id_pelamar";
		}
		$where=array($field=> $this->session->userdata('id_login'));
		$update=$this->fronModel->update($table, $data, $where);
		if($update){
			$this->fronModel->logout();
			redirect(site_url('beranda'));
		}else{
			echo "error";
		}
	}

}