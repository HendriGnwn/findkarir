<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller 
{
	public function index()
	{
		redirect(site_url('login/masuk'));
	}

	public function masuk()
	{
		$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Login Masuk ke Halaman Pribadi Pelamar";
		$tampil['page_title']="Login Masuk";
		$tampil['formAction']=base_url('login/prosesLogin');
		
		$this->final_view('front/login/login', $tampil);
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
		$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Login Masuk ke Halaman Pribadi Pelamar";
		$tampil['page_title']="Login Masuk";
		$tampil['formAction']=base_url('login/prosesLoginDulu/'.$id);

		$this->final_view('front/login/login', $tampil);
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
		$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Login Masuk Lupa Password";
		$tampil['page_title']="Lupa Password";
		$tampil['formAction']=base_url('login/prosesLupaPassword');

		$this->final_view('front/login/lupa', $tampil);
	}
	public function prosesLupaPassword()
	{
		if($this->fronModel->cekId(array('id_pelamar'=>$this->input->post('id'), 'email'=>$this->input->post('email')), 'job_pelamar')==TRUE){
			$cek = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$this->input->post('id'), 'email'=>$this->input->post('email')));
			if (!$cek) {
				$this->session->set_flashdata('gagal', 'Data tidak ada.');
				redirect(site_url('login/lupaPassword'));
			}

			$params = array(
				'body' => $this->load->view('mail/auth/forgot-password-applicant', array(
					'row' => $cek
				), true),
				'to' => $cek->email,
				'subject' => "Lupa Password"
			);
			if ($this->send_email($params)) {
				$this->session->set_flashdata('berhasil', 'Password Bisa Lihat di Email Anda');
				redirect(site_url('login/masuk'));
			} else {
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
		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Login Masuk Lupa Password Perusahaan";
		$tampil['page_title']="Lupa Password Perusahaan";
		$tampil['formAction']=base_url('login/prosesLupaPasswordPerusahaan');

		$this->final_view('front/login/lupa_perusahaan', $tampil);
	}

	public function prosesLupaPasswordPerusahaan() 
	{
		if ($this->fronModel->cekId(array('id_perusahaan' => $this->input->post('id'), 'email' => $this->input->post('email')), 'job_perusahaan') == TRUE) {
			$cek = $this->fronModel->showById('job_perusahaan', array('id_perusahaan' => $this->input->post('id'), 'email' => $this->input->post('email')));
			if (!$cek) {
				$this->session->set_flashdata('gagal', 'Data tidak ada.');
				redirect(site_url('login/lupaPasswordPerusahaan'));
			}

			$params = array(
				'to' => $cek->email,
				'subject' => "Lupa Password",
				'body' => $this->load->view('mail/auth/forgot-password-company', array(
					'row' => $cek,
				), true),
			);
			if ($this->send_email($params)) {
				$this->session->set_flashdata('berhasil', 'Password Bisa Lihat di Email Anda');
				redirect(site_url('perusahaan'));
			} else {
				$this->session->set_flashdata('gagal', 'Lupa Password Gagal mengirim, Koneksi tidak Ada...');
				redirect(site_url('login/lupaPasswordPerusahaan'));
			}
		} else {
			$this->session->set_flashdata('gagal', 'ID dan Email tidak terdaftar ..');
			redirect(site_url('login/lupaPasswordPerusahaan'));
		}
	}

	public function daftar()
	{
		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Daftar untuk Mencari Lowongan Kerja";
		$tampil['page_title']="Mendaftar";

		$tampil['formAction']=base_url('login/prosesDaftar');
		$tampil['captcha']=$this->fronModel->setCaptcha();

		$this->final_view('front/daftar/daftar', $tampil);
	}

	public function prosesDaftar() 
	{
		if ($this->input->post('captcha') == $this->session->userdata('captcha')) {
			if ($this->input->post('password') == $this->input->post('passkonf')) {
				if ($this->fronModel->cekId(array('email' => $this->input->post('email')), 'job_pelamar') == TRUE) {
					$this->session->set_flashdata('gagal', 'Email sudah terpakai sebelumnya, silahkan input alamat email selain ini ...');
					redirect(site_url('login/daftar'));
				} else {
					$auto_number = $this->fronModel->setAutoNumber('job_pelamar', date('mj'));
					$pass = str_replace(' ', '', $this->input->post('password'));
					$password = md5($pass);
					$data = array(
						'id_pelamar' => $auto_number,
						'nama' => strtoupper($this->input->post('nama')),
						'no_ktp' => null,
						'tmp_lhr' => null,
						'tgl_lhr' => null,
						'jk' => null,
						'agama' => null,
						'alamat' => null,
						'kota' => null,
						'kodepos' => null,
						'email' => $this->input->post('email'),
						'no_telp' => null,
						'sts_kawin' => null,
						'pendidikan' => null,
						'deskripsi' => null,
						'foto' => null,
						'tgl_create' => date('Y-m-d h:i:s'),
						'password' => $password,
						'pass_view' => $pass,
						'last_login' => '0000-00-00 00:00:00',
						'sts_login' => '0',
					);
					$this->fronModel->insert('job_pelamar', $data);
					$row = $this->fronModel->showById('job_pelamar', array('id_pelamar'=>$auto_number));
					$params = array(
						'to' => $row->email,
						'subject' => 'Selamat bergabung di '. $this->Config_Model->get_app_name_url(),
						'body' => $this->load->view('mail/auth/new-applicant', array(
							'row' => $row,
						), true),
					);
					$this->send_email($params);
					
					$this->session->set_flashdata('berhasil', 'Berhasil Mendaftar, silahkan Anda Login menggunakan Email dan Password Anda ..');
					redirect(site_url('login/daftar'));
				}
			} else {
				$this->session->set_flashdata('gagal', 'Gagal Mendaftar, Password dan Konfirmasi salah Input Password tidak boleh menggunakan Spasi, silahkan Input Kembali.');
				redirect(site_url('login/daftar'));
			}
		} else {
			$this->session->set_flashdata('gagal', 'Gagal Mendaftar Karena Hasil Salah, Silahkan Input Kembali.');
			redirect(site_url('login/daftar'));
		}
	}

	public function daftarPerusahaan()
	{
		$tampil['meta_deskripsi']=$this->Config_Model->get_app_name_url() . " | Gudangnya Informasi Lowongan Kerja. Daftar untuk Mencari Lowongan Kerja";
		$tampil['page_title']="Mendaftar Perusahaan";

		$tampil['captcha']=$this->fronModel->setCaptcha();
		$tampil['formAction']=base_url('login/prosesDaftarPerusahaan');

		$this->final_view('front/daftar/daftar_perusahaan', $tampil);
	}

	public function prosesDaftarPerusahaan() 
	{
		if ($this->input->post('captcha') == $this->session->userdata('captcha')) {
			if ($this->fronModel->cekId(array('email' => $this->input->post('email')), 'job_pelamar') == TRUE) {
				$this->session->set_flashdata('gagal', 'Email sudah terpakai sebelumnya, silahkan input alamat email selain ini ...');
				redirect(site_url('login/daftarPerusahaan'));
			} else {
				$this->session->set_userdata(array('password' => random_string('alnum', 8)));
				$auto_number = $this->fronModel->setAutoNumber('job_perusahaan', date('mjs'));

				$data = array(
					'id_perusahaan' => $auto_number,
					'kode'=>$this->my_model->generate_kode_perusahaan(1),
					'nm_perusahaan' => strtoupper($this->input->post('nama')),
					'logo' => null,
					'alamat' => $this->input->post('alamat'),
					'almt_web' => null,
					'no_izin' => null,
					'tentang' => null,
					'no_telp' => $this->input->post('no_telp'),
					'no_fax' => $this->input->post('no_fax'),
					'email' => $this->input->post('email'),
					'aktif' => '1',
					'tgl_create' => date('Y-m-d h:i:s'),
					'password' => md5($this->session->userdata('password')),
					'pass_view' => $this->session->userdata('password'),
					'last_login' => '0000:00:00 00:00:00',
					'sts_login' => '0',
				);
				$this->fronModel->insert('job_perusahaan', $data);
				$row = $this->fronModel->showById('job_perusahaan', array('id_perusahaan'=>$auto_number));
				
				$this->session->set_flashdata('berhasil', 'Berhasil Mendaftar, silahkan Cek Email Anda, terdapat ID dan Password untuk Login Perusahaan ..');
				
				$params = array(
					'to' => $row->email,
					'subject' => 'Selamat bergabung di '. $this->Config_Model->get_app_name_url(),
					'body' => $this->load->view('mail/auth/new-company', array(
						'row' => $row,
					), true),
				);
				$this->send_email($params);
				
				$this->session->unset_userdata('password');
				redirect(site_url('perusahaan'));
			}
		} else {
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