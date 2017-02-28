<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class my_model extends CI_Model {
	function __construct()
	{
		date_default_timezone_set("Asia/Jakarta");
	}

	public function cekLogin($username, $password)
	{
		$data = $this->db->where(array('username'=>$username, 'password'=>md5($password), 'hak_akses'=>'1'))->get('job_user');
		if($data->num_rows()>0)
		{
			$user=$data->row();
			if($user->aktif==1){
				$date=date('y-m-d h:i:s');
				$this->db->where('id_user', $user->id_user);
				$this->db->update('job_user', array('last_login'=> $date, 'sts_login'=> 1));
				$session=array('id_user'=>$user->id_user,'nama'=>$user->nama, 'hak_akses'=>$user->hak_akses, 'foto'=>$user->foto);
				$this->session->set_userdata($session);
				return true;
			}else{
				$this->session->set_flashdata('notification', 'Akun Anda saat ini di Blok');
				return false;
			}
		}
		else
		{
			$this->session->set_flashdata('notification', 'Username dan Password tidak cocok');
			return false;
		}
	}
	public function cekLoginAdmin($username, $password)
	{
		$data = $this->db->where(array('username'=>$username, 'password'=>md5($password), 'hak_akses'=>'1'))->get('user');
		if($data->num_rows()>0)
		{
			$user=$data->row();
			if($user->aktif==1){
				$date=date('y-m-d h:i:s');
				$this->db->where('id_user', $user->id_user);
				$this->db->update('user', array('last_login'=> $date, 'login'=> 1));
				$session=array('id_user'=>$user->id_user,'nama'=>$user->nama, 'hak_akses'=>$user->hak_akses, 'foto'=>$user->foto);
				$this->session->set_userdata($session);
				return true;
			}else{
				$this->session->set_flashdata('notification', 'Akun Anda saat ini di Blok oleh ADMIN');
				return false;
			}
		}
		else
		{
			$this->session->set_flashdata('notification', 'Username dan Password tidak cocok');
			return false;
		}
	}
		public function logout()
		{
			$this->session->sess_destroy();
		}

	public function cekPassword($password)
	{
		$query = $this->db->where(array('password'=>md5($password)))->get('job_user');
		if($query->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}

	public function show($table, $where, $asc)
	{
		//$this->db->select('*');
		$query=$this->db->query("SELECT * FROM ".$table." ORDER BY ".$where." ".$asc);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function showO($table)
	{
		$query=$this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function showNumRows($table)
	{
		$query=$this->db->get($table);
		return $query->num_rows();
	}
	public function showNumRowsById($table, $where)
	{
		$query=$this->db->where($where)->get($table);
		return $query->num_rows();
	}
	
	public function showById($table, $id)
	{
		$query=$this->db->where($id)->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	public function cekId($id, $table)
	{
		$query=$this->db->where($id)->get($table);
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function update($table, $data, $where)
	{
		$this->db->where($where);
		$update=$this->db->update($table, $data);
		if($update){
			return true;
		}else{
			return false;
		}
	}
	public function insert($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	public function delete($table, $where)
	{	
		$delete=$this->db->delete($table, $where);
		if($delete){
			return true;
		}else{
			return false;
		}
	}
	public function setAutoNumber($table, $inisial){
    	$query = $this->db->query('SELECT * FROM '.$table.'');
    	$qn=$query->num_rows();
    	if($qn <= 9){
    		$tmp="00";
    	}else
    	if($qn <= 99){
    		$tmp="0";
    	}else
    	if($qn <= 999){
			$tmp="";
    	}else{
    		$tmp="";
    	}
    	return $inisial."".$tmp."".$qn+1;
    }
	
	public function generate_kode_perusahaan($prefix, $padLength = 5)
	{
		$left = $prefix . date('ymd');
        $leftLen = strlen($left);
        $increment = 1;

        $query = $this->db->query("SELECT * FROM job_perusahaan WHERE kode like '%$left%' ORDER BY id_perusahaan DESC LIMIT 1");
		$last = $query->row();

        if ($last) {
            $increment = (int) substr($last, $leftLen, $padLength);
            $increment++;
        }

        $number = str_pad($increment, $padLength, '0', STR_PAD_LEFT);

        return $left . $number;
	}

    public function setSelisihTgl($tglAwal, $tglAkhir)
    {
    	$query = $this->db->query("SELECT datediff('$tglAkhir', '$tglAwal') as selisih");
		$data = $query->row();

    	return $data->selisih;
    }
	/*
		-- Manajemen User
	*/
	public function setAktifUser($id, $ids)
	{
		$data=array('aktif'=>$ids);
		$this->db->where(array('id_user'=> $id));
		$aktif=$this->db->update('job_user', $data);
		if($aktif){
			return true;
		}else{
			return false;
		}
	}
	public function setAktifLow($id, $ids)
	{
		$data=array('aktif'=>$ids);
		$this->db->where(array('id_lowongan'=> $id));
		$aktif=$this->db->update('job_lowongan', $data);
		if($aktif){
			return true;
		}else{
			return false;
		}
	}
	public function setAktifPer($id, $ids)
	{
		$data=array('aktif'=>$ids);
		$this->db->where(array('id_perusahaan'=> $id));
		$aktif=$this->db->update('job_perusahaan', $data);
		if($aktif){
			$this->db->query('Update job_lowongan SET aktif="'.$ids.'" WHERE id_perusahaan="'.$id.'" AND NOT aktif="3" AND NOT aktif="2"');
			return true;
		}else{
			return false;
		}
	}
	public function setAktifBerita($id, $ids)
	{
		$data=array('aktif'=>$ids);
		$this->db->where(array('id_berita'=> $id));
		$aktif=$this->db->update('job_berita', $data);
		if($aktif){
			return true;
		}else{
			return false;
		}
	}

	public function cekEditUser($username, $id, $field, $table)
	{
		$query = $this->db->query('SELECT * FROM '.$table.' WHERE username="'.$username.'" AND NOT '.$field.'="'.$id.'"');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	// public function showPerusahaan()
	// {
	// 	$query = $this->db->query("SELECT * FROM job_perusahaan WHERE job_perusahaan.id_perusahaan=job_login.id_perusahaan ORDER BY tgl_create DESC");
	// 	if($query->num_rows()>0){
	// 		return $query->result();
	// 	}else{
	// 		return null;
	// 	}
	// }

	public function showLowongan()
	{
		$query = $this->db->query("SELECT *, job_lowongan.aktif as aktif FROM job_lowongan, job_k_lowongan, job_golongan, job_perusahaan, job_aktivasi WHERE job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_perusahaan.id_perusahaan=job_aktivasi.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_golongan=job_golongan.id_golongan ORDER BY date_limit ASC");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return null;
		}
	}

	public function lowonganById($id)
	{
		$query = $this->db->query("SELECT *, job_lowongan.aktif as aktif FROM job_lowongan, job_k_lowongan, job_golongan, job_perusahaan, job_aktivasi WHERE job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_perusahaan.id_perusahaan=job_aktivasi.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_golongan=job_golongan.id_golongan AND job_lowongan.id_perusahaan='".$id."' ORDER BY date_limit ASC");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function detailLowonganById($id)
	{
		$query = $this->db->query("SELECT * FROM job_perusahaan, job_lowongan, job_aktivasi, job_k_lowongan, job_golongan, job_type WHERE job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_lowongan.id_type=job_type.id_type AND job_lowongan.id_golongan=job_golongan.id_golongan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_lowongan='".$id."'");
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return null;
		}
	}

	public function showPelamar($id)
	{
		$query= $this->db->query("SELECT *, job_pelamar.id_pelamar as id_pelamar FROM job_pelamar, job_lamar WHERE job_pelamar.id_pelamar=job_lamar.id_pelamar AND job_lamar.id_lowongan='".$id."' ORDER BY job_lamar.tgl_create ASC");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function showPelamarById($id)
	{
		$query= $this->db->query("SELECT *, job_pelamar.id_pelamar as id_pelamar, job_lamar.tgl_create as tgl_create FROM job_lowongan, job_pelamar, job_lamar WHERE job_pelamar.id_pelamar=job_lamar.id_pelamar AND job_lamar.id_lowongan=job_lowongan.id_lowongan AND job_lamar.id_pelamar='".$id."'");
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return null;
		}
	}

	public function getKatGolongan($id)
         {
         	$query = $this->db->where(array('id_golongan'=>$id))->get('job_k_golongan');
            return $query->result();
          }
    public function getLimit()
    {
    	$query = $this->db->query("SELECT *, job_lowongan.aktif as aktif FROM job_perusahaan, job_lowongan, job_aktivasi, job_golongan WHERE job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND job_aktivasi.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_golongan=job_golongan.id_golongan AND job_aktivasi.status=1 ORDER BY date_limit ASC limit 0, 20");
    	return $query->result();
    }

    public function showBantuan($between1, $between2)
	{
		$query=$this->db->query("SELECT * FROM job_bantuan WHERE sts=0 AND (tgl BETWEEN '$between1' AND '$between2')");
		if($query){
			return $query->result();
		}else{
			return null;
		}
	}

	public function showBantuanNumRows($between1, $between2)
	{
		$query=$this->db->query("SELECT * FROM job_bantuan WHERE sts=0 AND (tgl BETWEEN '$between1' AND '$between2')");
		if($query){
			return $query->num_rows();
		}else{
			return null;
		}
	}
	
	public function get_jobs_expire_activation()
	{
		$query = $this->db->query('SELECT * FROM job_aktivasi WHERE date_limit <= "'.date('Y-m-d').'"');
		if($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}
}