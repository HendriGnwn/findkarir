<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('my_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		if($this->session->userdata('id_user')==null || $this->session->userdata('hak_akses')=='1'){
			redirect('login');
		}else
		if($this->session->userdata('id_user')==null && $this->session->userdata('hak_akses')=='1'){
			redirect('login');
		}
	}
	public function index()
	{
		$tampil['jmlKontrak']=$this->my_model->showNumRows('kontrak');
		$tampil['jmlTenaga']=$this->my_model->showNumRows('tenaga');
		$tampil['jmlKonfirmTenaga']=$this->my_model->showNumRowsById('akses_tenaga', array('aktif'=>0, 'id_user'=>$this->session->userdata('id_user')));
		$tampil['jmlKonfirmKontrak']=$this->my_model->showNumRowsById('akses_kontrak', array('aktif'=>0, 'id_user'=>$this->session->userdata('id_user')));
		$data['content']=$this->load->view('h_user/dashboard/dashboard', $tampil, true);
		$this->load->view('h_user/object/template', $data);
	}
	public function logout()
	{
		$data=array('login' => '0');
		$where=array('id_user'=> $this->session->userdata('id_user'));
		$update=$this->my_model->update('user', $data, $where);
		if($update){
			$this->my_model->logout();
			redirect('login');
		}else{
			echo "error";
		}
	}
	public function editProfil()
	{
		$tampil['title']="Edit Profil";
		$tampil['formAction']="user/prosesEditProfil";
		$tampil['button']="SIMPAN DATA";
		$cek=$this->my_model->showById('user', array('id_user'=>$this->session->userdata('id_user')));
		$tampil['row']['username']=$cek->username;
		$tampil['row']['nama']=$cek->nama;
		$tampil['row']['deskripsi']=$cek->deskripsi;
		$tampil['row']['foto']=$cek->foto;
		$data['content']=$this->load->view('user/edit_profil',$tampil,true);
		$this->load->view('h_user/object/template', $data);
	}
		public function prosesEditProfil()
		{
			$config['upload_path'] = "./assets/upload/img/";
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$config['max_size'] = '1000';
			$config['file_name']=$this->input->post('username');
			$this->load->library('upload', $config);

			if($this->upload->do_upload("foto")){
				$unlink = $this->my_model->showById('user', array('id_user'=>$this->session->userdata('id_user')));
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
					'deskripsi'			=> $this->input->post('deskripsi'),
				);
				$this->session->set_userdata(array('foto'=>$nama, 'nama'=>strtoupper($this->input->post('namaLengkap'))));
		
				$this->my_model->update('user', $data5, array('id_user'=>$this->session->userdata('id_user')));
				$this->session->set_flashdata('notification', 'Data Sukses di Simpan');
				redirect(site_url('user/editProfil'));
			}else{
				$data = $this->upload->data();
				if($data['file_size']>1000 && ($data['file_ext']=='.jpg' || $data['file_ext']=='.JPG' || $data['file_ext']=='.png' || $data['file_ext']=='.PNG' || $data['file_ext']=='.jpeg' || $data['file_ext']=='.JPEG' || $data['file_ext']=='.gif' || $data['file_ext']=='.GIF')){
					$this->session->set_flashdata('notification', 'Size Foto melebihi 1MB');
					redirect('user/editProfil', 'refresh');
				}elseif($data['file_ext']!='.jpg' || $data['file_ext']!='.JPG' || $data['file_ext']!='.png' || $data['file_ext']!='.PNG' || $data['file_ext']!='.jpeg' || $data['file_ext']!='.JPEG' || $data['file_ext']!='.gif' || $data['file_ext']!='.GIF'){
					if($data['file_ext']==null || $data['file_ext']==''){
						$data5 = array(
							'username'			=> $this->input->post('username'),
							'nama'				=> strtoupper($this->input->post('namaLengkap')),
							'deskripsi'			=> $this->input->post('deskripsi'),
						);
						$this->session->set_userdata(array('nama'=>strtoupper($this->input->post('namaLengkap'))));
				
						$this->my_model->update('user', $data5, array('id_user'=>$this->session->userdata('id_user')));
						$this->session->set_flashdata('notification', 'Data tanpa upload Foto Sukses di Simpan');
						redirect(site_url('user/editProfil'));
					}else{
						$this->session->set_flashdata('notification', 'File Extension yang diperbolehkan adalah <b>.jpg / .png / .jpeg / .gif</b>, bukan extension <b>'.$data['file_ext'].'</b>');
						redirect('user/editProfil', 'refresh');
					}
				}
				
			}
		}

		public function password()
		{
			$tampil['title']="Ubah Password";
			$tampil['formAction']="user/prosesPassword";
			$tampil['button']="SIMPAN DATA";
			$data['content']=$this->load->view('user/password', $tampil, true);
			$this->load->view('h_user/object/template', $data);
		}
			public function prosesPassword()
			{
				$passlama = $this->input->post('passlama');
				$password = $this->input->post('password');
				$konfpassword = $this->input->post('konfpassword');
				if($this->my_model->cekPassword($passlama)==TRUE){
					if(md5($password)==md5($konfpassword)){
						$data = array(
								'password' => md5($password),
								'pass_view'=> $password,
							);
						$this->my_model->update('user', $data, array('id_user'=>$this->session->userdata('id_user')));
						$this->session->set_flashdata('notification', 'Password berhasil di Ubah');
						redirect('user/password', 'refresh');
					}else{
						$this->session->set_flashdata('notification', 'Password & Konfirmasi Password beda, Silahkan Input Kembali');
						redirect('user/password', 'refresh');
					}
				}else{
					$this->session->set_flashdata('notification', 'Password Lama tidak cocok, Silahkan Input Kembali');
					redirect('user/password', 'refresh');
				}
			}

	public function tenagaAhli()
	{
		$tampil['loadData']=$this->my_model->getTenagaAhli();
		//$tampil['cekMohon']=
		$data['content']=$this->load->view('h_user/tenaga/tenaga', $tampil, true);
		$this->load->view('h_user/object/template', $data);
	}
		public function mohonPDFTenaga($id)
		{
			$cek = $this->my_model->showById('tenaga', array('id_tenaga'=>$id));
			$data = array(
					'id_user' 	=> $this->session->userdata('id_user'),
					'id_tenaga'	=>$id,
					'aktif'		=>'0',
					'tgl_kirim'	=> date('Y-m-d h:i:s'),
					'tgl_konfirm'=>null,
				);
			$this->my_model->insert('akses_tenaga', $data);
			$this->session->set_flashdata('notification', 'Permohonan untuk di beri File PDF atas nama <b>'.$cek->nama_lengkap.'</b> sudah terkirim, lihat Halaman <a href="'.base_url('user/konfirmTenaga').'">Permohonan Tenaga Ahli</a>');
			redirect('user/tenagaAhli', 'refresh');
		}

	public function konfirmTenaga()
	{
		$tampil['loadData']=$this->my_model->getKonfirmTenaga();
		$data['content']=$this->load->view('h_user/tenaga/mohon', $tampil, true);
		$this->load->view('h_user/object/template', $data);
	}
		public function prosesKonfirmTenaga($id)
		{
			$cek = $this->my_model->showById('tenaga', array('id_tenaga'=>$id));
			$this->load->helper('download');
			$data = file_get_contents(base_url('/assets/upload/pdf/'.$cek->file_pdf));
			$name = $cek->nama_lengkap.".pdf";
			$this->my_model->delete('akses_tenaga', array('id_tenaga'=>$id, 'id_user'=>$this->session->userdata('id_user')));
			$this->session->set_flashdata('notification', 'Data atas nama <b>'.$cek->nama_lengkap.'</b> sudah Anda Download');
			force_download($name, $data);
		}

	public function kontrak()
	{
		$tampil['loadData']=$this->my_model->show('k_kontrak', 'nm_k_kontrak', 'asc');;
		$data['content']=$this->load->view('h_user/kontrak/kontrak', $tampil, true);
		$this->load->view('h_user/object/template', $data);
	}
		public function detailKontrak($id)
		{
			$cek = $this->my_model->showById('k_kontrak', array('id_k_kontrak'=>$id));
			$tampil['row']['title']="<b>".$cek->nm_k_kontrak."</b>";
			$tampil['loadData']=$this->my_model->getKontrak($id);
			$data['content']=$this->load->view('h_user/kontrak/detail', $tampil, true);
			$this->load->view('h_user/object/template', $data);
		}
			public function mohonPDFKontrak($id, $url)
			{
				$cek = $this->my_model->showById('kontrak', array('id_kontrak'=>$id));
				$data = array(
						'id_user' 	=> $this->session->userdata('id_user'),
						'id_kontrak'=>$id,
						'aktif'		=>'0',
						'tgl_kirim'	=> date('Y-m-d h:i:s'),
						'tgl_konfirm'=>null,
					);
				$this->my_model->insert('akses_kontrak', $data);
				$this->session->set_flashdata('notification', 'Permohonan untuk di beri File PDF atas Nama Kontrak <b>'.$cek->nm_kontrak.'</b> sudah terkirim, lihat Halaman <a href="'.base_url('user/konfirmKontrak').'">Permohonan Kontrak Perusahaan</a>');
				redirect('user/detailKontrak/'.$url, 'refresh');
			}

	public function konfirmKontrak()
	{
		$tampil['loadData']=$this->my_model->getKonfirmKontrak();
		$data['content']=$this->load->view('h_user/kontrak/mohon', $tampil, true);
		$this->load->view('h_user/object/template', $data);
	}
		public function prosesKonfirmKontrak($id)
		{
			$cek = $this->my_model->showById('kontrak', array('id_kontrak'=>$id));
			$this->load->helper('download');
			$data = file_get_contents(base_url('/assets/upload/pdf/'.$cek->file_pdf));
			$name = $cek->nm_kontrak.".pdf";
			$this->my_model->delete('akses_kontrak', array('id_kontrak'=>$id, 'id_user'=>$this->session->userdata('id_user')));
			$this->session->set_flashdata('notification', 'Data atas Nama Kontrak <b>'.$cek->nm_kontrak.'</b> sudah Anda Download');
			force_download($name, $data);
		}
}