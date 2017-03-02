<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//avendo
class Admin extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('my_model');
		$this->load->helper('fungsi_date');
		$this->load->helper('help');
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		if($this->session->userdata('id_user')==null || $this->session->userdata('hak_akses')=='2'){
			show_404();
		}else
		if($this->session->userdata('id_user')==null && $this->session->userdata('hak_akses')=='2'){
			show_404();
		}
	}

	public function statusLowongan()
	{
		$looping = $this->my_model->get_jobs_expire_activation();
		if($looping!=''){
			foreach($looping as $data){
				$data1=array(
					'aktif'=>'2',
				);
				$this->my_model->update('job_lowongan', $data1, array('id_lowongan'=>$data->id_lowongan));
			}
		}
	}

	public function index()
	{
		$this->statusLowongan();
		$tampil['statistics'] = $this->my_model->show('job_hit WHERE is_real=1', 'tgl', 'DESC');
		$tampil['dataPerusahaan']=$this->my_model->showNumRows('job_perusahaan');
		$tampil['dataLowongan']=$this->my_model->showNumRows('job_lowongan');
		$tampil['konfirmasiOrder']=$this->my_model->showNumRowsById('job_aktivasi', array('status'=>0));
		$cek = $this->my_model->showById('job_hit', array('id_hit'=>1));
		$tampil['statistik']=$cek->jml_hit;
		// $tampil['loadData']=$this->my_model->show('user WHERE hak_akses="2"', 'username' ,'asc');

		$tampil['orderKonfirmasi']=$this->my_model->show('job_aktivasi, job_lowongan WHERE job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND aktif="3" AND status="1"', 'date_bill', 'DESC');
		$tampil['orderPending']=$this->my_model->show('job_aktivasi, job_lowongan WHERE job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND aktif="3" AND status="0"', 'date_bill', 'DESC');
		$tampil['loadGolongan']=$this->my_model->show('job_golongan','id_golongan', 'ASC');
		$tampil['limit']=$this->my_model->getLimit();
		//echo var_dump($tampil['orderKonfirmasi']);
		$data['content']=$this->load->view('back/dashboard/dashboard', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function statistik()
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('job_hit', array('id_hit'=>1));
			$tampil['row']['jml_hit']=$cek->jml_hit;
			$tampil['row']['jml_hari_ini']=$cek->jml_hari_ini;
			$tampil['row']['tgl']=$cek->tgl;
			$data['content']=$this->load->view('back/dashboard/statistik', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesStatistik()
			{
				$data = array(
					'jml_hit'=>$this->input->post('statistik'), 
					'jml_hari_ini'=>$this->input->post('hari_ini'), 
					'tgl'=>date('Y-m-d'),
					);
				$this->my_model->update('job_hit',$data, array('id_hit'=>1));
				$this->session->set_flashdata('notification', 'Data Statistik Berhasil di Ubah');
				redirect(site_url('admin'));
			}
	public function logout()
	{
		$this->statusLowongan();
		$data=array('sts_login' => '0');
		$where=array('id_user'=> $this->session->userdata('id_user'));
		$update=$this->my_model->update('job_user', $data, $where);
		if($update){
			$this->my_model->logout();
			redirect(site_url('beranda'));
		}else{
			echo "error";
		}
	}

	/*
		- Manajemen User
	*/

	public function user()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_user', 'username', 'asc');
		$data['content']=$this->load->view('back/user/user', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function aktifUser($id, $ids)
		{
			$this->statusLowongan();
			$aktif=$this->my_model->setAktifUser($id, $ids);
			if($aktif){
				$this->session->set_flashdata('notification', 'Data Sukses di Ubah');
				redirect(site_url('admin/user'));
			}else{
				$this->session->set_flashdata('notification', 'Data Gagal di Ubah');
				redirect(site_url('admin/user'));
			}
		}

		public function tambahUser()
		{
			$this->statusLowongan();
			$tampil['formAction']=base_url("admin/prosesTambahUser");
			$tampil['button']="SIMPAN DATA";
			$tampil['title']="Tambah User Baru";
			$data['content']=$this->load->view('back/user/tambah', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesTambahUser()
			{
				$this->statusLowongan();
				if($this->my_model->cekId(array('username'=>str_replace(' ', '', $this->input->post('username'))), 'job_user')==TRUE){
					$this->session->set_flashdata('notification', 'Username <b>'.str_replace(' ', '', $this->input->post('username')).'</b> Sudah terpakai');
					redirect(site_url('admin/tambahUser'));
				}else{
					
					$date = explode("-", date('y-m-d'));
					$autoNumber = $this->my_model->setAutoNumber('job_user', $date[0].$date[1].$date[2]);
					if($this->input->post('aktif')==''){
						$aktif='1';
					}else{
						$aktif=$this->input->post('aktif');
					}
					$pass = str_replace(' ', '', $this->input->post('password'));
					$password = md5($pass);


					$data = array(
							'id_user'	=> $autoNumber,
							'username'	=> str_replace(' ', '', $this->input->post('username')),
							'password'	=> $password,
							'pass_view'	=> $pass,
							'nama'		=> strtoupper($this->input->post('namaLengkap')),
							'alamat'	=> $this->input->post('deskripsi'),
							'hak_akses'	=> $this->input->post('hakAkses'),
							'sts_login'		=> '0',
							'aktif'		=> $aktif,
							'tgl_create'=> date('Y-m-d')
						);
					//echo var_dump($data);
					$this->my_model->insert('job_user', $data);
					$this->session->set_flashdata('notification', 'Data User Username <b>'.str_replace(' ', '', $this->input->post('username')).'</b> Sukses di Simpan');
					redirect(site_url('admin/user'));
				}

			}

		public function editUser($id)
		{
			$this->statusLowongan();
			$tampil['title']="Edit User";
			$tampil['formAction']="admin/prosesEditUser/".$id;
			$tampil['button']="EDIT DATA";
			$cek=$this->my_model->showById('job_user', array('id_user'=>$id));
			$tampil['row']['username']=$cek->username;
			$tampil['row']['password']=$cek->pass_view;
			$tampil['row']['nama']=$cek->nama;
			$tampil['row']['deskripsi']=$cek->alamat;
			$tampil['row']['hakAkses']=$cek->hak_akses;
			$tampil['row']['aktif']=$cek->aktif;
			$tampil['row']['foto']=$cek->foto;
			$tampil['row']['keterangan']="Ket.<br>Tgl Create ".tgl_indo($cek->tgl_create)."<br>Terakhir Login ".tgl_indo_time1($cek->last_login)."";
			$data['content']=$this->load->view('back/user/tambah',$tampil,true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesEditUser($id)
			{
				$this->statusLowongan();
				if($this->my_model->cekEditUser(str_replace(' ', '', $this->input->post('username')), $id, 'id_user', 'job_user')==TRUE){
					$this->session->set_flashdata('notification', 'Username <b>'.str_replace(' ', '', $this->input->post('username')).'</b> Sudah terpakai');
					redirect(site_url('admin/editUser/'.$id));
				}else{
					
					$pass = str_replace(' ', '', $this->input->post('password'));
					$password = md5($pass);


					$data = array(
							'username'	=> str_replace(' ', '', $this->input->post('username')),
							'password'	=> $password,
							'pass_view'	=> $pass,
							'nama'		=> strtoupper($this->input->post('namaLengkap')),
							'alamat'	=> $this->input->post('deskripsi'),
							'hak_akses'	=> $this->input->post('hakAkses'),
							'aktif'		=> $this->input->post('aktif'),
						);
					//echo var_dump($data);
					$this->my_model->update('job_user', $data, array('id_user'=>$id));
					$this->session->set_flashdata('notification', 'Data User Username <b>'.str_replace(' ', '', $this->input->post('username')).'</b> Sukses di Edit');
					redirect(site_url('admin/user'));
				}

			}

		public function hapusUser($id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('user', array('id_user'=>$id));
			if($cek->foto!='' || $cek->foto!=null){
				$unlink = $this->my_model->showById('user', array('id_user'=>$id));
				$source = './assets/upload/img/'.$unlink->foto;
				unlink($source);
			}
			$this->my_model->delete('user', array('id_user'=> $id));
			$this->session->set_flashdata('notification', 'Data dengan ID <b>'.$id.'</b> berhasil di Hapus');
			redirect('admin/user', 'refresh');
		}

	public function editProfil()
	{
		$this->statusLowongan();
		$tampil['title']="Edit Profil";
		$tampil['formAction']="admin/prosesEditProfil";
		$tampil['button']="SIMPAN DATA";
		$cek=$this->my_model->showById('job_user', array('id_user'=>$this->session->userdata('id_user')));
		$tampil['row']['username']=$cek->username;
		$tampil['row']['nama']=$cek->nama;
		$tampil['row']['deskripsi']=$cek->alamat;
		$tampil['row']['foto']=$cek->foto;
		$data['content']=$this->load->view('back/user/edit_profil',$tampil,true);
		$this->load->view('back/object/template', $data);
	}
		public function prosesEditProfil()
		{
			$this->statusLowongan();
			$config['upload_path'] = "./assets/upload/img/";
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$config['max_size'] = '1000';
			$config['file_name']=$this->input->post('username');
			$this->load->library('upload', $config);

			if($this->upload->do_upload("foto")){
				$unlink = $this->my_model->showById('job_user', array('id_user'=>$this->session->userdata('id_user')));
				if($unlink->foto=='' || $unlink->foto==null){
					echo "";
				}else{
					$source = './assets/upload/img/'.$unlink->foto;
					unlink($source);
				}

				$data = $this->upload->data();
				/* PATH */
				$source = "./assets/upload/img/".$data['file_name'] ;
				$nama=$data['file_name'] ;
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


				$data5 = array(
					'username'			=> $this->input->post('username'),
					'nama'				=> strtoupper($this->input->post('namaLengkap')),
					'foto'				=>$nama,
					'alamat'			=> $this->input->post('deskripsi'),
				);
				$this->session->set_userdata(array('foto'=>$nama, 'nama'=>strtoupper($this->input->post('namaLengkap'))));
		
				$this->my_model->update('job_user', $data5, array('id_user'=>$this->session->userdata('id_user')));
				$this->session->set_flashdata('notification', 'Data Sukses di Simpan');
				redirect(site_url('admin/editProfil'));
			}else{
				$data = $this->upload->data();
				if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
					$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
					redirect('admin/editProfil', 'refresh');
				}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
					if($data['file_ext']==null || $data['file_ext']==''){
						$data5 = array(
							'username'			=> $this->input->post('username'),
							'nama'				=> strtoupper($this->input->post('namaLengkap')),
							'alamat'			=> $this->input->post('deskripsi'),
						);
						$this->session->set_userdata(array('nama'=>strtoupper($this->input->post('namaLengkap'))));
				
						$this->my_model->update('job_user', $data5, array('id_user'=>$this->session->userdata('id_user')));
						$this->session->set_flashdata('notification', 'Data tanpa upload Foto Sukses di Simpan');
						redirect(site_url('admin/editProfil'));
					}else{
						$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.jpg / .png / .jpeg / .gif</b>, bukan extension <b>'.$data['file_ext'].'</b>');
						redirect('admin/editProfil', 'refresh');
					}
				}
				
			}
		}

		public function password()
		{
			$this->statusLowongan();
			$tampil['title']="Ubah Password";
			$tampil['formAction']="admin/prosesPassword";
			$tampil['button']="SIMPAN DATA";
			$data['content']=$this->load->view('back/user/password', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesPassword()
			{
				$this->statusLowongan();
				$passlama = $this->input->post('passlama');
				$password = $this->input->post('password');
				$konfpassword = $this->input->post('konfpassword');
				if($this->my_model->cekPassword($passlama)==TRUE){
					if(md5($password)==md5($konfpassword)){
						$data = array(
								'password' => md5($password),
								'pass_view'=> $password,
							);
						$this->my_model->update('job_user', $data, array('id_user'=>$this->session->userdata('id_user')));
						$this->session->set_flashdata('notification', 'Password berhasil di Ubah');
						redirect('admin/password', 'refresh');
					}else{
						$this->session->set_flashdata('notification', 'Password & Konfirmasi Password beda, Silahkan Input Kembali');
						redirect('admin/password', 'refresh');
					}
				}else{
					$this->session->set_flashdata('notification', 'Password Lama tidak cocok, Silahkan Input Kembali');
					redirect('admin/password', 'refresh');
				}
			}

	/*
		- Perusahaan
	*/

	public function perusahaan()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_perusahaan', 'nm_perusahaan', 'ASC');
		$data['content']=$this->load->view('back/perusahaan/perusahaan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function aktifPer($id, $ids)
		{
			$this->statusLowongan();
			$aktif=$this->my_model->setAktifPer($id, $ids);
			if($aktif){
				$this->session->set_flashdata('notification', 'Data Sukses di Ubah');
				redirect(site_url('admin/perusahaan'));
			}else{
				$this->session->set_flashdata('notification', 'Data Gagal di Ubah');
				redirect(site_url('admin/perusahaan'));
			}
		}

	public function detailPerusahaan($id)
	{
		$this->statusLowongan();
		$cek=$this->my_model->showById('job_perusahaan',array('id_perusahaan'=>$id));
		$tampil['row']['id']=$cek->id_perusahaan;
		$tampil['row']['nm_perusahaan']=$cek->nm_perusahaan;
		$tampil['row']['logo']=$cek->logo;
		$tampil['row']['no_izin']=$cek->no_izin;
		$tampil['row']['web']=$cek->almt_web;
		$tampil['row']['alamat']=$cek->alamat;
		$tampil['row']['tentang']=$cek->tentang;
		$tampil['row']['no_telp']=$cek->no_telp;
		$tampil['row']['no_fax']=$cek->no_fax;
		$tampil['row']['email']=$cek->email;
		$tampil['row']['pass_view']=$cek->pass_view;
		$tampil['row']['last_login']=$cek->last_login;
		$tampil['row']['tgl_create']=$cek->tgl_create;
		$tampil['row']['aktif']=$cek->aktif;
		$tampil['row']['login']=$cek->sts_login;
		$tampil['row']['kode']=$cek->kode;
		$tampil['row']['category']=$cek->category;
		if ($cek->category == 2) {
			$tampil['perusahaanLimits'] = $this->my_model->show('job_limit WHERE job_perusahaan_id = "'.$id.'"', 'status', 'DESC');
		}
		$data['content']=$this->load->view('back/perusahaan/detail', $tampil, true);
		$this->load->view('back/object/template', $data);
	}

		public function tambahPerusahaan()
		{
			$this->statusLowongan();
			$tampil['formAction']=base_url("admin/prosesTambahPerusahaan");
			$tampil['button']="SIMPAN DATA";
			$tampil['title']="Tambah Perusahaan";
			$data['content']=$this->load->view('back/perusahaan/tambah', $tampil, true);
			$this->load->view('back/object/template', $data);
		}

			public function prosesTambahPerusahaan()
			{
					$this->statusLowongan();
					$auto_number = $this->my_model->setAutoNumber('job_perusahaan', date('mjs'));
					$nama=strtoupper($this->input->post('nama'));
					$config['upload_path'] = "./assets/upload/img/";
					$config['allowed_types']= 'gif|jpg|png|jpeg|pdf';
					$config['max_size'] = '1000';
					$config['file_name']= $this->my_model->setAutoNumber('job_perusahaan', date('mjs'));
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload("file")) {
						$data = $this->upload->data();
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

						$pass = str_replace(' ', '', $this->input->post('password'));
						$password = md5($pass);
				
						$data1 = array(
								'kode'=>$this->my_model->generate_kode_perusahaan($this->input->post('category')),
								'nm_perusahaan'=>$nama,
								'logo'=>$logo,
								'almt_web'=>$this->input->post('web'),
								'no_izin'=>$this->input->post('no_izin'),
								'alamat'=>$this->input->post('alamat'),
								'tentang'=>$this->input->post('tentang'),
								'no_telp'=>$this->input->post('no_telp'),
								'no_fax'=>$this->input->post('no_fax'),
								'email'=>$this->input->post('email'),
								'aktif'=>'1',
								'tgl_create'=>date('Y-m-d h:i:s'),
								'password'=>$password,
								'pass_view'=>$pass,
								'last_login'=>'0000-00-00 00:00:00',
								'category'=>$this->input->post('category'),
								'sts_login'=>'0',
							);
						$insertId = $this->my_model->insert('job_perusahaan', $data1);
						if ($data1['category'] == 2) {
							$dataLimit = array(
								'job_perusahaan_id' => $insertId,
								'limit' => 0,
								'date_start' => date('Y-m-d'),
								'date_end' => dateInIntervalFormat(date('Y-m-d'), 30),
								'status' => 1,
								'created_at' => date('Y-m-d H:i:s'),
							);
							$this->my_model->insert('job_limit', $dataLimit);
						}
						
						$this->session->set_flashdata('notification', 'Data <b>'.$nama.'</b> berhasil di Simpan');
						redirect('admin/perusahaan', 'refresh');
					}else{
						$data = $this->upload->data();
						if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
							$this->session->set_flashdata('notification', 'Size Foto Upload LOGO melebihi 1MB');
							redirect('admin/tambahPerusahaan', 'refresh');
						}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
							$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan Upload LOGO adalah <b>.jpg / .png / .jpeg / .gif</b>, bukan extension <b>'.$data['file_ext'].'</b>');
							redirect('admin/tambahPerusahaan', 'refresh');
						}
					}
			}

		public function editPerusahaan($id)
		{
			$this->statusLowongan();
			$tampil['title']="Edit Perusahaan";
			$tampil['formAction']="admin/prosesEditPerusahaan/".$id;
			$tampil['button']="EDIT DATA";
			$cek=$this->my_model->showById('job_perusahaan',array('id_perusahaan'=>$id));
			$tampil['row']['id']=$cek->id_perusahaan;
			$tampil['row']['nm_perusahaan']=$cek->nm_perusahaan;
			$tampil['row']['logo']=$cek->logo;
			$tampil['row']['no_izin']=$cek->no_izin;
			$tampil['row']['web']=$cek->almt_web;
			$tampil['row']['alamat']=$cek->alamat;
			$tampil['row']['tentang']=$cek->tentang;
			$tampil['row']['no_telp']=$cek->no_telp;
			$tampil['row']['no_fax']=$cek->no_fax;
			$tampil['row']['email']=$cek->email;
			$tampil['row']['pass_view']=$cek->pass_view;
			$tampil['row']['category']=$cek->category;
			$data['content']=$this->load->view('back/perusahaan/tambah',$tampil,true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesEditPerusahaan($id)
			{
					$this->statusLowongan();
					$config['upload_path'] = "./assets/upload/img/";
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['max_size'] = '1000';
					$config['file_name']= $id;
					$this->load->library('upload', $config);
	
					if ($this->upload->do_upload("file")) {
						$data = $this->upload->data();

						$unlink = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$id));
						$source = './assets/upload/img/'.$unlink->logo;

						unlink($source);
						
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

						$pass = str_replace(' ', '', $this->input->post('password'));
						$password = md5($pass);
						
						$data1 = array(
								'nm_perusahaan'=>strtoupper($this->input->post('nama')),
								'logo'=>$logo,
								'almt_web'=>$this->input->post('web'),
								'no_izin'=>$this->input->post('no_izin'),
								'alamat'=>$this->input->post('alamat'),
								'tentang'=>$this->input->post('tentang'),
								'no_telp'=>$this->input->post('no_telp'),
								'no_fax'=>$this->input->post('no_fax'),
								'email'=>$this->input->post('email'),
								'password'=>$password,
								'pass_view'=>$pass,
								'category'=>$this->input->post('category'),
							);
						$this->my_model->update('job_perusahaan', $data1, array('id_perusahaan'=> $id));
						$this->session->set_flashdata('notification', 'Data <b>'.strtoupper($this->input->post('nama')).'</b> berhasil di Edit');
						redirect('admin/perusahaan', 'refresh');
					}else{
						$data = $this->upload->data();
						if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
							$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
							redirect('admin/editPerusahaan/'.$id, 'refresh');
						}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
							if($data['file_ext']==null || $data['file_ext']==''){
								$pass = str_replace(' ', '', $this->input->post('password'));
								$password = md5($pass);
								$data1 = array(
									'nm_perusahaan'=>strtoupper($this->input->post('nama')),
									'alamat'=>$this->input->post('alamat'),
									'almt_web'=>$this->input->post('web'),
									'no_izin'=>$this->input->post('no_izin'),
									'tentang'=>$this->input->post('tentang'),
									'no_telp'=>$this->input->post('no_telp'),
									'no_fax'=>$this->input->post('no_fax'),
									'email'=>$this->input->post('email'),
									'password'=>$password,
									'pass_view'=>$pass,
									'category'=>$this->input->post('category'),
								);
								
								$this->my_model->update('job_perusahaan', $data1, array('id_perusahaan'=> $id));
								$this->session->set_flashdata('notification', 'Data <b>'.strtoupper($this->input->post('nama')).'</b> berhasil di Edit');
								redirect('admin/perusahaan', 'refresh');
							}else{
								$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.pdf</b>, bukan extension <b>'.$data['file_ext'].'</b>');
								redirect('admin/editPerusahaan/'.$id, 'refresh');
							}
						}
					}
			}

		public function hapusPerusahaan($id)
		{
			$this->statusLowongan();
			$unlink = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$id));
			if($unlink->logo!='' || $unlink->logo!=null){
				$source = './assets/upload/img/'.$unlink->logo;
				unlink($source);
			}
			if($this->my_model->showNumRowsById('job_lowongan', array('id_perusahaan'=>$id))>0){
				$this->my_model->delete('job_lowongan', array('id_perusahaan'=> $id));
			}
			if($this->my_model->showNumRowsById('job_aktivasi', array('id_perusahaan'=>$id))>0){
				$this->my_model->delete('job_aktivasi', array('id_perusahaan'=> $id));
			}
			$this->my_model->delete('job_perusahaan', array('id_perusahaan'=> $id));
			$this->session->set_flashdata('notification', 'Data dengan ID <b>'.$id.'</b> berhasil di Hapus');
			redirect('admin/perusahaan', 'refresh');
		}

	public function lowonganById($id)
	{
		$this->statusLowongan();
		$cek = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$id));
		$tampil['nm_perusahaan']=$cek->nm_perusahaan;
		$tampil['loadData']=$this->my_model->lowonganById($id);
		$data['content']=$this->load->view('back/lowongan/lowonganID', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function setAktifLow($link, $id, $ids)
		{
			$this->statusLowongan();
			$aktif=$this->my_model->setAktifLow($id, $ids);
			if($aktif){
				$this->session->set_flashdata('notification', 'Data Sukses di Ubah');
				redirect(site_url('admin/lowonganById/'.$link));
			}else{
				$this->session->set_flashdata('notification', 'Data Gagal di Ubah');
				redirect(site_url('admin/lowonganById/'.$link));
			}
		}
		public function panjangLow($link, $id, $ids){
			$cek = $this->my_model->showById('job_lowongan', array('id_lowongan'=>$id));
			$cek1 = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$ids));
			$cek2 = $this->my_model->showById('job_golongan', array('id_golongan'=>$cek->id_golongan));

			$tampil['gol']=$this->my_model->show('job_golongan', 'id_golongan', 'ASC');
			//$tampil['kgol']=$this->my_model->show('job_k_golongan WHERE id_golongan="'.$cek->id_golongan.'"', 'id_k_golongan', 'ASC');

			//$tampil['row']['id_golongan']=$cek->id_golongan;
			//$tampil['row']['id_k_golongan']=$cek1->id_k_golongan;
			$tampil['row']['date_post']=$cek->date_post;
			$tampil['row']['date_close']=$cek->date_close;
			$tampil['row']['kode']=$cek2->kode;

	
			$tampil['title']='Perpanjang Iklan ID <b>'.$cek->id_lowongan.'</b>';
			$tampil['formAction']=base_url('admin/prosesPanjangLow/'.$link.'/'.$id.'/'.$ids);
			$data['content']=$this->load->view('back/lowongan/perpanjang', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesPanjangLow($link, $id, $ids)
			{
				$this->statusLowongan();
				$config['upload_path'] = "./assets/upload/img/";
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';
				$config['file_name']= $id;
				$this->load->library('upload', $config);

				if ($this->upload->do_upload("file")) {
					$data = $this->upload->data();

					$unlink = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$ids));
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

					$setHarga = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$this->input->post('kGol')));
					$tambah = $setHarga->limit_waktu." day";
					$date_limit = addDate(date('Y-m-d'), $tambah);
			
					$data1 = array(
							'id_golongan'=>$this->input->post('golongan'),
							'aktif'=>'1',
						);
					$data2 = array(
							'id_k_golongan'=>$this->input->post('kGol'),
							'id_user'=>$this->session->userdata('id_user'),
							'harga'=>$setHarga->harga,
							'date_bill'=>date('Y-m-d'),
							'date_limit'=>$date_limit,
							'upload_bukti'=>$bukti,
							'status'=>'1',
							'ket'=>$this->input->post('ket'),
						);
					$this->my_model->update('job_lowongan', $data1, array('id_lowongan'=> $id));
					$this->my_model->update('job_aktivasi', $data2, array('id_aktivasi'=> $ids));
					redirect('admin/cetakStrukLowongan/'.$ids, 'refresh');
				}else{
					$data = $this->upload->data();
					if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
						$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
						redirect('admin/panjangLow/'.$link.'/'.$id.'/'.$ids, 'refresh');
					}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
						$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.pdf</b>, bukan extension <b>'.$data['file_ext'].'</b>');
						redirect('admin/panjangLow/'.$link.'/'.$id.'/'.$ids, 'refresh');
					}
				}
			}

		public function tambahLowongan($id=null)
		{
			$this->statusLowongan();
			$tampil['formAction']=base_url("admin/prosesTambahLowongan/".$id);
			$tampil['button']="SIMPAN DATA &nbsp;-&nbsp; SELANJUTNYA &nbsp;&nbsp;<i class='fa fa-angle-right'></i>";
			$tampil['title']="Tambah Lowongan";
			if($id!=null){
				$cek = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$id));
				$tampil['row']['id_perusahaan']=$cek->id_perusahaan;
				$tampil['row']['perusahaan']=$cek->nm_perusahaan;
			}
			$tampil['perusahaan']=$this->my_model->show('job_perusahaan', 'nm_perusahaan', 'ASC');
			$tampil['kat_lowongan']=$this->my_model->show('job_k_lowongan', 'nm_k_lowongan', 'ASC');
			$tampil['kat']=$this->my_model->show('job_type', 'id_type', 'ASC');
			$tampil['gol']=$this->my_model->show('job_golongan', 'id_golongan', 'ASC');
			$tampil['row']['date_post']=date('Y-m-d');
			$data['content']=$this->load->view('back/lowongan/tambah', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function golDetailKategori()
			{
            	$query=$this->my_model->getKatGolongan($this->input->post('golongan'));
		        echo '<option value="">... Pilih Limit Waktu // Harga ...</option>';
	            foreach($query as $row)
                { 
                 echo "<option value='".$row->id_k_golongan."'>".$row->limit_waktu." Hari // Rp. ".number_format($row->harga, 0, ',', '.').",-</option>";
                }
			}
				public function golKetKategori()
				{
					$this->statusLowongan();
					$query=$this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$this->input->post('kGol')));
					//echo "<input type='text' name='close' value='".$query->."' class='form-control' />";
					$tambah = $query->limit_waktu." day";
					echo tgl_indo(addDate(date('Y-m-d'), $tambah));
				}

			public function prosesTambahLowongan($id=null)
			{
				$this->statusLowongan();
				if($id!=null){
					$ids=$id;
				}else{
					$ids = $this->input->post('perusahaan');
				}
				$data = array(
					'id_lowongan'=>$this->my_model->setAutoNumber('job_lowongan', date('mjh')),
					'id_perusahaan'=>$ids,
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

				$id_lowongan = $this->my_model->insert('job_lowongan', $data);

				$setHarga = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$this->input->post('kGol')));
				$tambah = $setHarga->limit_waktu." day";
				$date_limit = addDate(date('Y-m-d'), $tambah);
				$data1 = array(
					'id_aktivasi'=>$this->my_model->setAutoNumber('job_aktivasi', date('dmi')),
					'id_lowongan'=>$id_lowongan,
					'id_perusahaan'=>$ids,
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
				$insert_id=$this->my_model->insert('job_aktivasi', $data1);
				$this->session->set_flashdata('notification', 'Data '.$this->input->post('lowongan').' Sukses di Simpan');
				redirect(site_url('admin/tambahAktivasi/'.$insert_id));
			}

			public function tambahAktivasi($id)
			{
				$this->statusLowongan();
				$cek = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$id));
				$cek1 = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
				$cek2 = $this->my_model->showById('job_lowongan', array('id_lowongan'=>$cek->id_lowongan));
				$cek3 = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
				$cek4 = $this->my_model->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

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

				$tampil['row']['id_aktivasi']="<b>".$cek->id_aktivasi."</b>";
				$tampil['row']['harga']= "Rp. ".number_format($cek->harga, 0, ',', '.').",-";
				$tampil['row']['limit']=tgl_indo($cek->date_bill)." s/d <b>".tgl_indo($cek->date_limit)."</b>";
				$tampil['title']="Form Lanjutan Lowongan ID ".$cek->id_lowongan;

				$tampil['formAction']=base_url("admin/prosesTambahAktivasi/".$cek->id_aktivasi);
				$tampil['button']="SIMPAN DATA &nbsp;-&nbsp; CETAK DATA &nbsp;&nbsp;<i class='fa fa-print'></i>";
				
				$data['content']=$this->load->view('back/lowongan/tambah_bukti', $tampil, true);
				$this->load->view('back/object/template', $data);
			}
				public function prosesTambahAktivasi($id){
					$this->statusLowongan();
					$config['upload_path'] = "./assets/upload/img/";
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['max_size'] = '1000';
					$config['file_name']= $id;
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
								'id_user'=>$this->session->userdata('id_user'),
								'upload_bukti'=>$bukti,
								'ket'=>$this->input->post('ket'),
								'status'=>'1',
							);
						$cek = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$id));
						$data2 = array(
								'aktif'=>'1'
							);
						$this->my_model->update('job_lowongan', $data2, array('id_lowongan'=> $cek->id_lowongan));
						$this->my_model->update('job_aktivasi', $data1, array('id_aktivasi'=> $id));
						redirect('admin/cetakStrukLowongan/'.$id, 'refresh');
					}else{
						$data = $this->upload->data();
						//echo var_dump($data);
						//echo $this->upload->display_errors();
						if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
							$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
							redirect('admin/tambahAktivasi/'.$id, 'refresh');
						}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
							$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.pdf</b>, bukan extension <b>'.$data['file_ext'].'</b>');
							redirect('admin/tambahAktivasi/'.$id, 'refresh');
						}
					}
				}
			public function cetakStrukLowongan($id){
				$this->statusLowongan();
				$cek = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$id));
				$cek1 = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
				$cek2 = $this->my_model->showById('job_lowongan', array('id_lowongan'=>$cek->id_lowongan));
				$cek3 = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
				$cek4 = $this->my_model->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

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
				$this->load->view('back/lowongan/cetak_data', $tampil);
			}
		public function detailLowongan($link, $id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->detailLowonganById($id);
			$tampil['row']['pelamar']=$this->my_model->showNumRowsById('job_lamar', array('id_lowongan'=>$id));
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
			$tampil['loadData']=$this->my_model->showPelamar($id);
			$data['content']=$this->load->view('back/lowongan/detail', $tampil, true);
			$this->load->view('back/object/template', $data);	
		}
			public function aktifLamar($link1, $link2, $id)
			{
				$tampil['title']="Keterangan Datang";
				$tampil['formAction']=base_url('admin/prosesAktifLamar/'.$link1.'/'.$link2.'/'.$id);
				$data['content']=$this->load->view('back/lowongan/aktif_lamar', $tampil, true);
				$this->load->view('back/object/template', $data);	
			}
				public function prosesAktifLamar($link1, $link2, $id)
				{
					$data = array(
							'tgl_datang'=>$this->input->post('tgl_datang'),
							'jam_datang'=>$this->input->post('jam_datang'),
							'almt_datang'=>$this->input->post('ket'),
							'sts_lamar'=>'1',
						);
					$this->my_model->update('job_lamar', $data, array('id_lamar'=>$id));
					$this->session->set_flashdata('notification', 'Data Sukses di Edit');
					redirect(site_url('admin/detailLowongan/'.$link1.'/'.$link2));
				}
			public function editLowongan($link, $id)
			{
				$this->statusLowongan();
				$tampil['title']="Edit Lowongan";
				$tampil['formAction']=base_url("admin/prosesEditLowongan/".$link."/".$id);
				$tampil['button']="EDIT DATA";
				$cek = $this->my_model->detailLowonganById($id);
				$tampil['row']['pelamar']=$this->my_model->showNumRowsById('job_lamar', array('id_lowongan'=>$id));
				$tampil['row']['id']=$cek->id_lowongan;
				$tampil['row']['lowongan']=$cek->nm_lowongan;
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
				$tampil['row']['gaji']=$cek->gaji;
				$tampil['row']['rating']=$cek->rating;
				$tampil['row']['type']=$cek->id_type;
				$tampil['row']['ket']=$cek->ket;
				$tampil['row']['bukti']=$cek->upload_bukti;
				$tampil['loadData']=$this->my_model->showPelamar($id);
				$tampil['kat']=$this->my_model->show('job_type', 'id_type', 'ASC');
				$tampil['gol']=$this->my_model->show('job_golongan', 'id_golongan', 'ASC');
				$data['content']=$this->load->view('back/lowongan/editLowongan', $tampil, true);
				$this->load->view('back/object/template', $data);	
			}
				public function prosesEditLowongan($link, $id)
				{
					$this->statusLowongan();
					$data = array(
							'nm_lowongan'=>$this->input->post('lowongan'),
							'kualifikasi'=>$this->input->post('kualifikasi'),
							'benefit'=>$this->input->post('benefit'),
							'kota'=>$this->input->post('kota'),
							'provinsi'=>$this->input->post('provinsi'),
							'id_type'=>$this->input->post('type'),
							'date_post'=>$this->input->post('date_post'),
							'date_close'=>$this->input->post('date_close'),
						);
					$this->my_model->update('job_lowongan', $data, array('id_lowongan'=>$id));
					$this->session->set_flashdata('notification', 'Data '.$this->input->post('lowongan').' Sukses di Edit');
					redirect(site_url('admin/lowonganById/'.$link));
				}
		public function hapusLowongan($link, $id){
			$this->statusLowongan();
			$data = array('id_lowongan'=>$id);

			$cek = $this->my_model->showById('job_aktivasi', $data);
			if($cek->upload_bukti!='' || $cek->upload_bukti!=null){
				$source = './assets/upload/img/'.$cek->upload_bukti;
				unlink($source);
			}

			if($this->my_model->cekId($data, 'job_lamar')==TRUE){
				$detail = $this->my_model->showById('job_lamar', $data);
				if($detail->cv!='' || $detail->cv!=null){
					$source = './assets/upload/pelamar/'.$detail->cv;
					unlink($source);
				}
				$this->my_model->delete('job_lamar', $data);
			}

			$this->my_model->delete('job_lowongan', $data);
			$this->my_model->delete('job_aktivasi', $data);

			$this->session->set_flashdata('notification', 'Data Sukses di Hapus');
			redirect(site_url('admin/lowonganById/'.$link));

		}
	public function excelPelamar($per, $low){
		$this->statusLowongan();
		$data['loadData']=$this->my_model->showPelamar($low);
		$cek = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$per));
		$data['perusahaan']=$cek->nm_perusahaan;
		$this->load->view('back/pelamar/excel', $data);
	}

	public function detailPelamar($id)
	{
		$this->statusLowongan();
		$cek = $this->my_model->showPelamarById($id);
		//echo var_dump($cek);
		$tampil['row']['id_perusahaan']=$cek->id_perusahaan;
		$tampil['row']['id_lowongan']=$cek->id_lowongan;
		$tampil['row']['id']=$cek->id_pelamar;
		$tampil['row']['nama']=$cek->nama;
		$tampil['row']['foto']=$cek->foto;
		$tampil['row']['ktp']=$cek->no_ktp;
		$tampil['row']['nama']=$cek->nama;
		if($cek->tgl_lhr!=null || $cek->tgl_lhr!=''){
			$tglLhr = tgl_indo($cek->tgl_lhr);
		}else{
			$tglLhr = "";
		}
		$tampil['row']['tmp_lhr']=$cek->tmp_lhr.", ".$tglLhr;
		$tampil['row']['jk']=$cek->jk;
		$tampil['row']['agama']=$cek->agama;
		$tampil['row']['alamat']=$cek->alamat;
		$tampil['row']['kota']=$cek->kota." ".$cek->kodepos;
		$tampil['row']['email']=$cek->email;
		$tampil['row']['no_telp']=$cek->no_telp;
		$tampil['row']['sts_kawin']=$cek->sts_kawin;
		$tampil['row']['pendidikan']=$cek->pendidikan;
		$tampil['row']['cv']=$cek->cv;
		$tampil['row']['tgl_lamar']=tgl_indo_time1($cek->tgl_create);
		$tampil['row']['ket']=$cek->ket;
		$data['content']=$this->load->view('back/pelamar/detail', $tampil, true);
		$this->load->view('back/object/template', $data);	
	}


	public function loker()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->showLowongan();
		//echo var_dump($tampil['loadData']);
		$data['content']=$this->load->view('back/lowongan/lowongan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}

	public function golongan()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_golongan', 'id_golongan', 'ASC');
		$data['content']=$this->load->view('back/golongan/golongan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function lihatGolongan($id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('job_golongan', array('id_golongan'=>$id));
			$tampil['row']['nm_golongan']=$cek->nm_golongan;
			$tampil['row']['id_golongan']=$cek->id_golongan;
			$tampil['loadData']=$this->my_model->show('job_k_golongan WHERE id_golongan="'.$id.'"', 'id_k_golongan', 'ASC');
			$data['content']=$this->load->view('back/golongan/detail', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function tambahGolongan($id)
			{
				$this->statusLowongan();
				$cek = $this->my_model->showById('job_golongan', array('id_golongan'=>$id));
				$tampil['row']['nm_golongan']=$cek->nm_golongan;
				$tampil['row']['id_golongan']=$cek->id_golongan;
				$tampil['row']['kode']=$cek->kode;
				$tampil['title']='Tambah Golongan '.$cek->nm_golongan;
				$tampil['formAction']=base_url('admin/prosesTambahGolongan/'.$id);
				$data['content']=$this->load->view('back/golongan/tambah', $tampil, true);
				$this->load->view('back/object/template', $data);
			}
				public function prosesTambahGolongan($id)
				{
					$this->statusLowongan();
					$data = array(
						'id_k_golongan'	=> '',
						'id_golongan'	=> $id,
						'limit_waktu'	=> $this->input->post('waktu'),
						'harga'	=> $this->input->post('harga'),
						'deskripsi'	=> $this->input->post('deskripsi'),
					);
					$this->my_model->insert('job_k_golongan', $data);
					$this->session->set_flashdata('notification', 'Data Sukses di Simpan');
					redirect(site_url('admin/lihatGolongan/'.$id));
				}
			public function editGolongan($gol, $id)
			{
				$this->statusLowongan();
				$cek = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$id));
				$cek1 = $this->my_model->showById('job_golongan', array('id_golongan'=>$gol));
				$tampil['row']['nm_golongan']=$cek1->nm_golongan;
				$tampil['row']['id_golongan']=$cek1->id_golongan;
				$tampil['row']['kode']=$cek1->kode;
				$tampil['row']['waktu']=$cek->limit_waktu;
				$tampil['row']['harga']=$cek->harga;
				$tampil['row']['deskripsi']=$cek->deskripsi;
				$tampil['title']='Edit Golongan '.$cek1->nm_golongan;
				$tampil['formAction']=base_url('admin/prosesEditGolongan/'.$gol.'/'.$id);
				$data['content']=$this->load->view('back/golongan/tambah', $tampil, true);
				$this->load->view('back/object/template', $data);
			}
				public function prosesEditGolongan($gol, $id)
				{
					$this->statusLowongan();
					$data = array(
						'limit_waktu'	=> $this->input->post('waktu'),
						'harga'	=> $this->input->post('harga'),
						'deskripsi'	=> $this->input->post('deskripsi'),
					);
					$this->my_model->update('job_k_golongan', $data, array('id_k_golongan'=>$id));
					$this->session->set_flashdata('notification', 'Data Sukses di Edit');
					redirect(site_url('admin/lihatGolongan/'.$gol));
				}
			public function hapusGolongan($gol, $id)
			{
				$this->statusLowongan();
				$this->my_model->delete('job_k_golongan', array('id_k_golongan'=>$id));
				$this->session->set_flashdata('notification', 'Data Sukses di Hapus');
				redirect(site_url('admin/lihatGolongan/'.$gol));
			}
	public function kLoker()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_k_lowongan', 'nm_k_lowongan', 'ASC');
		$data['content']=$this->load->view('back/k_lowongan/k_lowongan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function TambahKLoker()
			{
				$this->statusLowongan();
				$tampil['title']='Tambah Kategori Lowongan';
				$tampil['formAction']=base_url('admin/prosesTambahKLoker');
				$data['content']=$this->load->view('back/k_lowongan/tambah', $tampil, true);
				$this->load->view('back/object/template', $data);
			}
			public function prosesTambahKLoker()
				{
					$this->statusLowongan();
					$data = array(
						'id_k_low'	=> '',
						'nm_k_lowongan'	=> strtoupper($this->input->post('kategori')),
					);
					$this->my_model->insert('job_k_lowongan', $data);
					$this->session->set_flashdata('notification', 'Data Sukses di Simpan');
					redirect(site_url('admin/kLoker'));
				}
		public function editKLoker($id)
			{
				$this->statusLowongan();
				$cek = $this->my_model->showById('job_k_lowongan', array('id_k_low'=>$id));
				$tampil['row']['kategori']=$cek->nm_k_lowongan;
				$tampil['title']='Edit Lowongan';
				$tampil['formAction']=base_url('admin/prosesEditKLoker/'.$id);
				$data['content']=$this->load->view('back/k_lowongan/tambah', $tampil, true);
				$this->load->view('back/object/template', $data);
			}
				public function prosesEditKLoker($id)
				{
					$this->statusLowongan();
					$data = array(
						'nm_k_lowongan'	=> strtoupper($this->input->post('kategori')),
					);
					$this->my_model->update('job_k_lowongan', $data, array('id_k_low'=>$id));
					$this->session->set_flashdata('notification', 'Data Sukses di Edit');
					redirect(site_url('admin/kLoker'));
				}
			public function hapusKLoker($id)
				{
					$this->statusLowongan();
					$this->my_model->delete('job_k_lowongan', array('id_k_low'=>$id));
					$this->session->set_flashdata('notification', 'Data Sukses di Hapus');
					redirect(site_url('admin/kLoker'));
				}
	public function order()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->showLowongan();
		$data['content']=$this->load->view('back/order/order', $tampil, true);
		$this->load->view('back/object/template', $data);
	}

	public function detailOrder($id){
		$this->statusLowongan();
		$cek = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$id));
		$cek1 = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$cek->id_perusahaan));
		$cek2 = $this->my_model->showById('job_lowongan', array('id_lowongan'=>$cek->id_lowongan));
		$cek3 = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
		$cek4 = $this->my_model->showById('job_golongan', array('id_golongan'=>$cek3->id_golongan));

		$tampil['row']['id_perusahaan']=$cek1->id_perusahaan;
		$tampil['row']['perusahaan']=$cek1->nm_perusahaan;
		$tampil['row']['alamat']=$cek1->alamat;
		$tampil['row']['web']=$cek1->almt_web;

		$tampil['row']['aktif']=$cek2->aktif;
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
		$tampil['row']['status']=$cek->status;
		$tampil['row']['harga']= "Rp. ".number_format($cek->harga, 0, ',', '.').",-";
		$tampil['row']['limit']=tgl_indo($cek->date_bill)." s/d <b>".tgl_indo($cek->date_limit)."</b>";
		$tampil['title']="STRUK BUKTI PEMBAYARAN";
		//$tampil['']
		$data['content']=$this->load->view('back/aktivasi/invoice', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function prosesKonfirmasiAktivasi($link, $id){

			$cek = $this->my_model->showById('job_aktivasi', array('id_aktivasi'=>$link));
			$setHarga = $this->my_model->showById('job_k_golongan', array('id_k_golongan'=>$cek->id_k_golongan));
			$tambah = $setHarga->limit_waktu." day";
			$date_limit = addDate(date('Y-m-d'), $tambah);

			$data = array(
					'aktif'=>'1',
				);
			$data1 = array(
					'date_limit'=>$date_limit,
					'id_user'=>$this->session->userdata('id_user'),
				);

			$this->my_model->update('job_lowongan', $data, array('id_lowongan'=>$id));
			$this->my_model->update('job_aktivasi', $data1, array('id_aktivasi'=>$link));
			redirect(site_url('admin/cetakStrukLowongan/'.$link));
		}

	public function pendaftar(){
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_pelamar', 'tgl_create', 'DESC');
		$data['content']=$this->load->view('back/pelamar/pelamar', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function detailPendaftar($id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('job_pelamar', array('id_pelamar'=>$id));
			//echo var_dump($cek);
			$tampil['row']['id']=$cek->id_pelamar;
			$tampil['row']['nama']=$cek->nama;
			$tampil['row']['ktp']=$cek->no_ktp;
			$tampil['row']['nama']=$cek->nama;
			$tampil['row']['foto']=$cek->foto;
			if($cek->tgl_lhr!=null || $cek->tgl_lhr!=''){
				$tglLhr=tgl_indo($cek->tgl_lhr);
			}else{
				$tglLhr='';
			}
			$tampil['row']['tmp_lhr']=$cek->tmp_lhr.", ".$tglLhr;
			$tampil['row']['jk']=$cek->jk;
			$tampil['row']['agama']=$cek->agama;
			$tampil['row']['alamat']=$cek->alamat;
			$tampil['row']['kota']=$cek->kota." ".$cek->kodepos;
			$tampil['row']['email']=$cek->email;
			$tampil['row']['no_telp']=$cek->no_telp;
			$tampil['row']['sts_kawin']=$cek->sts_kawin;
			$tampil['row']['password']=$cek->pass_view;
			$tampil['row']['pendidikan']=$cek->pendidikan;
			$tampil['row']['jml_lamar']=$this->my_model->showNumRowsById('job_lamar', array('id_pelamar'=>$id));;
			$tampil['row']['tgl_create']=tgl_indo_time1($cek->tgl_create);
			$data['content']=$this->load->view('back/pelamar/detail_pelamar', $tampil, true);
			$this->load->view('back/object/template', $data);	
		}

	public function bank()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_rekening', 'id_rekening', 'ASC');
		$data['content']=$this->load->view('back/bank/bank', $tampil, true);
		$this->load->view('back/object/template', $data);
	}

		public function editBank($id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('job_rekening', array('id_rekening'=>$id));
			$tampil['row']['no_rek']=$cek->kode_rek;
			$tampil['row']['nm_bank']=$cek->nm_bank;
			$tampil['row']['nm_rek']=$cek->nm_rek;
			$tampil['title']='Edit Rekening Bank';
			$tampil['formAction']=base_url('admin/prosesEditBank/'.$id);
			$data['content']=$this->load->view('back/bank/edit', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesEditBank($id)
			{
				$config['upload_path'] = "./assets/upload/img/";
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';
				$config['file_name']=$id;
				$this->load->library('upload', $config);

				if($this->upload->do_upload("file")){
					$unlink = $this->my_model->showById('job_rekening', array('id_rekening'=>$id));
					if($unlink->logo=='' || $unlink->logo==null){
						echo "";
					}else{
						$source = './assets/upload/img/'.$unlink->logo;
						unlink($source);
					}

					$data = $this->upload->data();
					/* PATH */
					$source = "./assets/upload/img/".$data['file_name'] ;
					$logo=$data['file_name'] ;
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


					$data5 = array(
						'nm_rek'=>strtoupper($this->input->post('nm_rek')),
						'kode_rek'=>$this->input->post('no_rek'),
						'nm_bank'=>strtoupper($this->input->post('nm_bank')),
						'logo'=>$logo,
					);
			
					$this->my_model->update('job_rekening', $data5, array('id_rekening'=>$id));
					$this->session->set_flashdata('notification', 'Data Sukses di Edit');
					redirect(site_url('admin/bank'));
				}else{
					$data = $this->upload->data();
					if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
						$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
						redirect('admin/editBank/'.$id, 'refresh');
					}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
						if($data['file_ext']==null || $data['file_ext']==''){
							$data5 = array(
								'nm_rek'=>strtoupper($this->input->post('nm_rek')),
								'kode_rek'=>$this->input->post('no_rek'),
								'nm_bank'=>strtoupper($this->input->post('nm_bank')),
							);
					
							$this->my_model->update('job_rekening', $data5, array('id_rekening'=>$id));
							$this->session->set_flashdata('notification', 'Data Sukses di Edit');
							redirect(site_url('admin/bank'));
						}else{
							$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.jpg / .png / .jpeg / .gif</b>, bukan extension <b>'.$data['file_ext'].'</b>');
							redirect('admin/editBank/'.$id, 'refresh');
						}
					}
					
				}
				// $data = array(
				// 	'nm_rek'=>$this->input->post('nm_rek'),
				// 	'kode_rek'=>$this->input->post('no_rek'),
				// 	'nm_bank'=>$this->input->post('nm_bank'),
				// 	);
				// $this->my_model->update('job_rekening', $data, array('id_rekening'=>$id));
				// $this->session->set_flashdata('notification', 'Data Sukses di Edit');
				// redirect(site_url('admin/bank'));
			}
	public function berita()
	{
		$this->statusLowongan();
		$tampil['loadData']=$this->my_model->show('job_berita', 'tgl', 'DESC');
		$data['content']=$this->load->view('back/berita/berita', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function tambahBerita()
		{
			$this->statusLowongan();
			$tampil['title']='Tambah Berita';
			$tampil['button']='SIMPAN DATA';
			$tampil['formAction']=base_url('admin/prosesTambahBerita');
			$data['content']=$this->load->view('back/berita/tambah', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesTambahBerita()
			{
				$autoNumber=$this->my_model->setAutoNumber('job_berita', date('s'));
				$this->statusLowongan();
				$config['upload_path'] = "./assets/upload/img/";
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';
				$config['file_name']=$autoNumber;
				$this->load->library('upload', $config);

				if($this->upload->do_upload("file")){
					
					$data = $this->upload->data();
					/* PATH */
					$source = "./assets/upload/img/".$data['file_name'] ;
					$nama=$data['file_name'] ;
					$destination_medium = "./assets/upload/img/" ;

					// Configuration Of Image Manisulation :: Static
					$this->load->library('image_lib') ;
					$img['image_library'] = 'GD2';
					$img['create_thumb'] = TRUE;
					$img['maintain_ratio']= TRUE;
					/// Limit Width Resize
					$limit_medium = 900 ;
					// Size Image Limit was using (LIMIT TOP)
					$limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

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


					$data5 = array(
						'id_berita'		=> $autoNumber,
						'judul'			=> $this->input->post('judul'),
						'slug'			=> generateUrl($this->input->post('judul')),
						'deskripsi'		=> $this->input->post('deskripsi'),
						'tgl'		=> date('Y-m-d h:i:s'),
						'foto'			=>$nama,
						'aktif'			=>'1',
					);
			
					$this->my_model->insert('job_berita', $data5);
					$this->session->set_flashdata('notification', 'Data Sukses di Simpan');
					redirect(site_url('admin/berita'));
				}else{
					$data = $this->upload->data();
					if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
						$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
						redirect('admin/tambahBerita', 'refresh');
					}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
						if($data['file_ext']==null || $data['file_ext']==''){
							$data5 = array(
								'id_berita'		=> $autoNumber,
								'judul'			=> $this->input->post('judul'),
								'deskripsi'		=> $this->input->post('deskripsi'),
								'tgl'		=> date('Y-m-d h:i:s'),
								'foto'			=>null,
								'aktif'			=>'1',
							);
							$this->my_model->insert('job_berita', $data5);
							$this->session->set_flashdata('notification', 'Data Sukses di Simpan');
							redirect(site_url('admin/berita'));
						}else{
							$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.jpg / .png / .jpeg / .gif</b>, bukan extension <b>'.$data['file_ext'].'</b>');
							redirect('admin/tambahBerita', 'refresh');
						}
					}
					
				}
			}
		public function editBerita($id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('job_berita', array('id_berita'=>$id));
			$tampil['row']['judul']=$cek->judul;
			$tampil['row']['deskripsi']=$cek->deskripsi;
			$tampil['row']['foto']=$cek->foto;
			$tampil['title']='Edit Berita';
			$tampil['button']='EDIT DATA';
			$tampil['formAction']=base_url('admin/prosesEditBerita/'.$id);
			$data['content']=$this->load->view('back/berita/tambah', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesEditBerita($id)
			{
				$this->statusLowongan();
				$config['upload_path'] = "./assets/upload/img/";
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';
				$config['file_name']=$id;
				$this->load->library('upload', $config);

				if($this->upload->do_upload("file")){

					$unlink = $this->my_model->showById('job_berita', array('id_berita'=>$id));
					if($unlink->foto=='' || $unlink->foto==null){
						echo "";
					}else{
						$source = './assets/upload/img/'.$unlink->foto;
						unlink($source);
					}
					
					$data = $this->upload->data();
					/* PATH */
					$source = "./assets/upload/img/".$data['file_name'] ;
					$nama=$data['file_name'] ;
					$destination_medium = "./assets/upload/img/" ;

					// Configuration Of Image Manisulation :: Static
					$this->load->library('image_lib') ;
					$img['image_library'] = 'GD2';
					$img['create_thumb'] = TRUE;
					$img['maintain_ratio']= TRUE;
					/// Limit Width Resize
					$limit_medium = 900 ;
					// Size Image Limit was using (LIMIT TOP)
					$limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

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


					$data5 = array(
						'judul'			=> $this->input->post('judul'),
						'slug'			=> generateUrl($this->input->post('judul')),
						'deskripsi'		=> $this->input->post('deskripsi'),
						'tgl'		=> date('Y-m-d h:i:s'),
						'foto'			=>$nama,
						'aktif'			=>'1',
					);
			
					$this->my_model->update('job_berita', $data5, array('id_berita'=>$id));
					$this->session->set_flashdata('notification', 'Data Sukses di Edit');
					redirect(site_url('admin/berita'));
				}else{
					$data = $this->upload->data();
					if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
						$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
						redirect('admin/editBerita/'.$id, 'refresh');
					}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
						if($data['file_ext']==null || $data['file_ext']==''){
							$data5 = array(
								'judul'			=> $this->input->post('judul'),
								'slug'			=> generateUrl($this->input->post('judul')),
								'deskripsi'		=> $this->input->post('deskripsi'),
								'tgl'		=> date('Y-m-d h:i:s'),
								'aktif'			=>'1',
							);
							$this->my_model->update('job_berita', $data5, array('id_berita'=>$id));
							$this->session->set_flashdata('notification', 'Data Sukses di Edit');
							redirect(site_url('admin/berita'));
						}else{
							$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.jpg / .png / .jpeg / .gif</b>, bukan extension <b>'.$data['file_ext'].'</b>');
							redirect('admin/editBerita/'.$id, 'refresh');
						}
					}
					
				}
			}
		public function hapusBerita($id)
		{
			$this->statusLowongan();
			$unlink = $this->my_model->showById('job_berita', array('id_berita'=>$id));
			if($unlink->foto=='' || $unlink->foto==null){
				echo "";
			}else{
				$source = './assets/upload/img/'.$unlink->foto;
				unlink($source);
			}
			
			$this->my_model->delete('job_berita', array('id_berita'=> $id));
			$this->session->set_flashdata('notification', 'Data dengan ID <b>'.$id.'</b> berhasil di Hapus');
			redirect('admin/berita', 'refresh');
		}
			public function setAktifBerita($id, $ids)
			{
				$this->statusLowongan();
				$aktif=$this->my_model->setAktifBerita($id, $ids);
				if($aktif){
					$this->session->set_flashdata('notification', 'Data Sukses di Ubah');
					redirect(site_url('admin/berita'));
				}else{
					$this->session->set_flashdata('notification', 'Data Gagal di Ubah');
					redirect(site_url('admin/berita'));
				}
			}
	public function tentang()
	{
		$tampil['loadData']=$this->my_model->show('job_tentang, job_k_tentang WHERE job_tentang.id_k_tentang=job_k_tentang.id_k_tentang', 'job_tentang.id_k_tentang, job_tentang.judul', 'ASC');
		$data['content']=$this->load->view('back/tentang/tentang', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function editTentang($id)
		{
			$this->statusLowongan();
			$cek = $this->my_model->showById('job_tentang', array('id_tentang'=>$id));
			$cek1 = $this->my_model->showById('job_k_tentang', array('id_k_tentang'=>$cek->id_k_tentang));
			$tampil['row']['judul']=$cek->judul;
			$tampil['row']['deskripsi']=$cek->deskripsi;
			$tampil['row']['kategori']=$cek->kategori;
			$tampil['row']['untuk']=$cek1->nm_k_tentang;
			$tampil['title']='Edit Deskripsi Tentang';
			$tampil['button']='EDIT DATA';
			$tampil['formAction']=base_url('admin/prosesEditTentang/'.$id);
			$data['content']=$this->load->view('back/tentang/edit', $tampil, true);
			$this->load->view('back/object/template', $data);
		}
			public function prosesEditTentang($id)
			{
				$data = array(
						'judul'=>$this->input->post('judul'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'tgl_update'=>date('Y-m-d h:i:s'),
					);
				$this->my_model->update('job_tentang', $data, array('id_tentang'=>$id));
				$this->session->set_flashdata('notification', 'Data <b>'.$this->input->post('judul').'</b> Sukses di Edit');
				redirect(site_url('admin/tentang'));
			}
	public function bantuan()
	{
		$tampil['loadData']=$this->my_model->show('job_bantuan', 'tgl', 'DESC');
		$data['content']=$this->load->view('back/bantuan/bantuan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}

	public function hapusBantuan($id)
	{
		$this->my_model->delete('job_bantuan', array('id_bantuan'=>$id));
		$this->session->set_flashdata('notification', 'Data Sukses di Hapus');
		redirect(site_url('admin/bantuan'));
	}
	public function kirimBantuan($id)
	{
		$cek = $this->my_model->showById('job_bantuan', array('id_bantuan'=>$id));
		$tampil['row']['nama']=$cek->nama;
		$tampil['row']['subjek']=$cek->subjek;
		$tampil['row']['email']=$cek->email;
		$tampil['row']['pesan']=$cek->pesan;
		$tampil['title']="Bales Pesan Bantuan";
		$tampil['button']="KIRIM EMAIL";
		$tampil['formAction']=base_url('admin/prosesKirimBantuan/'.$id);
		$data['content']=$this->load->view('back/bantuan/kirim', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		
	public function prosesKirimBantuan($id) {
		$data = array(
			'subjek' => $this->input->post('subjek'),
			'email' => $this->input->post('email'),
			'pesan' => $this->input->post('pesan'),
			'tgl' => date('Y-m-d h:i:s'),
			'sts' => 1,
		);
		$this->my_model->update('job_bantuan', $data, array('id_bantuan' => $id));
		$params = array(
			'to' => $this->input->post('email'),
			'subject' => $this->input->post('subjek'),
			'body' => $this->input->post('pesan'),
		);
		$this->send_email($params);
		
		$this->session->set_flashdata('notification', 'Kirim Email Sukses');
		redirect(site_url('admin/bantuan'));
	}
	
	public function profilPerusahaan()
	{
		$cek = $this->my_model->showById('job_kontak', array('id_kontak'=>'1'));
		$tampil['row']['alamat']=$cek->alamat;
		$tampil['row']['latitude']=$cek->latitude;
		$tampil['row']['longitude']=$cek->longitude;
		$tampil['row']['no_telp']=$cek->no_telp;
		$tampil['row']['email']=$cek->email;
		$tampil['row']['web_url']=$cek->web_url;
		$tampil['row']['facebook']=$cek->facebook;
		$tampil['row']['twitter']=$cek->twitter;
		$tampil['row']['google']=$cek->google;
		$tampil['row']['dribble']=$cek->dribble;
		$tampil['row']['linkedin']=$cek->linkedin;
		$tampil['row']['skype']=$cek->skype;
		$tampil['title']="Data Perusahaan";
		$tampil['button']="SIMPAN DATA PERUSAHAAN";
		$tampil['formAction']=base_url('admin/prosesProfilPerusahaan');
		$data['content']=$this->load->view('back/tentang/profil', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
		public function prosesProfilPerusahaan()
		{
			$data = array(
					'alamat'=>$this->input->post('alamat'),
					'latitude'=>$this->input->post('latitude'),
					'longitude'=>$this->input->post('longitude'),
					'no_telp'=>$this->input->post('no_telp'),
					'email'=>$this->input->post('email'),
					'web_url'=>$this->input->post('web_url'),
					'facebook'=>$this->input->post('facebook'),
					'twitter'=>$this->input->post('twitter'),
					'google'=>$this->input->post('google'),
					'dribble'=>$this->input->post('dribble'),
					'linkedin'=>$this->input->post('linkedin'),
					'skype'=>$this->input->post('skype'),
				);
			$this->my_model->update('job_kontak', $data, array('id_kontak'=>'1'));
			$this->session->set_flashdata('notification', 'Data Sukses di Edit');
			redirect(site_url('admin/profilPerusahaan'));
		}
	
	public function tambahLimitLow($id)
	{
		$check = $this->my_model->showById('job_perusahaan', array('id_perusahaan'=>$id));
		if ($check->category == 1) {
			show_404();
		}
		
		$tampil['id'] = $id;
		$tampil['title']="Tambah Limit Lowongan (Partner FindKarir)";
		$tampil['button']="SIMPAN DATA";
		$tampil['formAction']=base_url('admin/tambahLimitLow/'.$id);
		
		if (isset($_POST['submit'])) {
			if ($this->input->post('date') < date('Y-m-d')) {
				$this->session->set_flashdata('notification', 'Tanggal Limit tidak boleh kurang dari hari ini');
				redirect(site_url('admin/tambahLimitLow/'.$id));
			}
			$data = array(
				'job_perusahaan_id' => $id,
				'limit' => $this->input->post('limit'),
				'date_start' => $this->input->post('date'),
				'date_end' => $this->input->post('date_end'),
				'status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
			);
			$check = $this->my_model->showById('job_limit', array('job_perusahaan_id'=>$id));
			if ($check) {
				$this->my_model->update('job_limit', array('status' => 0), array('job_perusahaan_id' => $id));
			}
			$insertId = $this->my_model->insert('job_limit', $data);
			$this->session->set_flashdata('notification', 'Data Limit sukses di tambah');
			redirect(site_url('admin/detailPerusahaan/'.$id));
		}
		
		$data['content']=$this->load->view('back/perusahaan/tambah-limit-lowongan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
	
	public function updateLimitLow($id)
	{
		$tampil['title']="Update Limit Lowongan (Partner FindKarir)";
		$tampil['button']="SIMPAN DATA";
		$tampil['formAction']=base_url('admin/updateLimitLow/'.$id);
		$tampil['row'] = $this->my_model->showById('job_limit', array('id'=>$id));
		
		if (isset($_POST['submit'])) {
			$this->my_model->update('job_limit', array('limit' => $this->input->post('limit'), 'date_end'=>$this->input->post('date_end')), array('id' => $id));
			$this->session->set_flashdata('notification', 'Data Limit sukses di edit');
			redirect(site_url('admin/detailPerusahaan/'.$tampil['row']->job_perusahaan_id));
		}
		
		$data['content']=$this->load->view('back/perusahaan/update-limit-lowongan', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
	
	public function masalah()
	{
		$tampil['loadData']=$this->my_model->show('lowongan_masalah', 'created_at', 'DESC');
		$data['content']=$this->load->view('back/masalah/index', $tampil, true);
		$this->load->view('back/object/template', $data);
	}
}