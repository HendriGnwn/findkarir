<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fronModel extends CI_Model {
	function __construct()
	{
		date_default_timezone_set("Asia/Jakarta");
	}

	public function logout()
		{
			$this->session->sess_destroy();
		}

	public function cekLoginPerusahaan($id, $password)
	{
		$data = $this->db->query("SELECT * FROM job_perusahaan WHERE (id_perusahaan='".$id."' OR email='".$id."') AND password='".md5($password)."'");
		if($data->num_rows()>0)
		{
			$perusahaan=$data->row();
			if($perusahaan->aktif==1){
				$date=date('y-m-d h:i:s');
				$this->db->where('id_perusahaan', $perusahaan->id_perusahaan);
				$this->db->update('job_perusahaan', array('last_login'=> $date, 'sts_login'=> 1));
				$session=array('id_login'=>$perusahaan->id_perusahaan,'nama'=>$perusahaan->nm_perusahaan, 'hak_akses'=>'perusahaan');
				$this->session->set_userdata($session);
				return true;
			}else{
				$this->session->set_flashdata('gagal', 'Akun Anda saat ini di Blok');
				return false;
			}
		}
		else
		{
			$this->session->set_flashdata('gagal', 'Email atau ID dan Password tidak cocok, Silahkan Login Kembali.');
			return false;
		}
	}

	public function cekLoginPelamar($id, $password)
	{	$data = $this->db->query("SELECT * FROM job_pelamar WHERE (id_pelamar='".$id."' OR email='".$id."') AND password='".md5($password)."'");
		//$data = $this->db->where(array('id_perusahaan'=>$id, 'password'=>md5($password), 'aktif'=>'1'))->get('job_perusahaan');
		if($data->num_rows()>0)
		{
			$pelamar=$data->row();
			$date=date('y-m-d h:i:s');
			$this->db->where('id_pelamar', $pelamar->id_pelamar);
			$this->db->update('job_pelamar', array('last_login'=> $date, 'sts_login'=> 1));
			$session=array('id_login'=>$pelamar->id_pelamar,'nama'=>$pelamar->nama, 'hak_akses'=>'pelamar');
			$this->session->set_userdata($session);
			return true;
		}
		else
		{
			$this->session->set_flashdata('gagal', 'Email atau ID dan Password tidak cocok, Silahkan Login Kembali.');
			return false;
		}
	}

	public function cekPassword($password, $table)
	{
		$query = $this->db->where(array('password'=>md5($password)))->get($table);
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

    public function setSelisihTgl($tglAwal, $tglAkhir)
    {
    	$query = $this->db->query("SELECT datediff('$tglAkhir', '$tglAwal') as selisih");
		$data = $query->row();

    	return $data->selisih;
    }

    public function setCaptcha(){
		$query=$this->db->where(array('id_captcha'=>((time()%10)+1)))->get('job_captcha');
		return $query->result();
	}

	public function getPlatinumLowonganLim($limit)
	{
		$query = $this->db->query("SELECT * FROM job_lowongan, job_perusahaan, job_k_lowongan, job_aktivasi WHERE job_lowongan.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_lowongan.aktif=1 AND job_lowongan.id_golongan=1 ORDER BY job_aktivasi.date_limit DESC LIMIT 0,".$limit);
		if($query){
			return $query->result();
		}else{
			return null;
		}
	}

	public function getLowongan($perpage, $uri)
	{
		if($uri==''){
				$uri=0;
			}
		$query = $this->db->query("SELECT * FROM job_lowongan, job_perusahaan, job_k_lowongan, job_aktivasi WHERE job_lowongan.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_lowongan.aktif=1 ORDER BY job_lowongan.id_golongan ASC,job_aktivasi.date_limit DESC LIMIT ".$uri.",".$perpage);
		if($query){
			return $query->result();
		}else{
			return null;
		}
	}

	public function totalLowongan()
	{
		$query = $this->db->query("SELECT * FROM job_lowongan, job_perusahaan, job_k_lowongan, job_aktivasi WHERE job_lowongan.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_lowongan.aktif=1 ORDER BY job_lowongan.id_golongan ASC,job_aktivasi.date_limit DESC");
		if($query){
			return $query->num_rows();
		}else{
			return null;
		}
	}

	public function cariLowongan($search, $perpage, $uri)
	{
		if($uri==''){
				$uri=0;
		}
		$query = $this->db->query("SELECT * FROM job_perusahaan, job_lowongan, job_type, job_k_lowongan, job_aktivasi WHERE job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_type.id_type=job_lowongan.id_type AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.aktif='1' AND (job_perusahaan.nm_perusahaan LIKE '%".$search."%' OR job_lowongan.nm_lowongan LIKE '%".$search."%' OR job_k_lowongan.nm_k_lowongan LIKE '%".$search."%') ORDER BY job_lowongan.id_golongan ASC, job_aktivasi.date_limit DESC LIMIT ".$uri.",".$perpage);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	}
	public function totalCariLowongan($search)
	{
		$query = $this->db->query("SELECT * FROM job_perusahaan, job_lowongan, job_type, job_k_lowongan, job_aktivasi WHERE job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_type.id_type=job_lowongan.id_type AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.aktif='1' AND (job_perusahaan.nm_perusahaan LIKE '%".$search."%' OR job_lowongan.nm_lowongan LIKE '%".$search."%' OR job_k_lowongan.nm_k_lowongan LIKE '%".$search."%') ORDER BY job_lowongan.id_golongan ASC, job_aktivasi.date_limit DESC");
		if($query){
			return $query->num_rows();
		}else{
			return null;
		}
	}

	public function cariLowonganBerdasarkan($search, $perpage, $uri)
	{
		if($uri==''){
			$uri=0;
		}
		$query = $this->db->query("SELECT * FROM job_lowongan, job_aktivasi, job_perusahaan, job_k_lowongan, job_type WHERE job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_k_lowongan.id_k_low=job_lowongan.id_k_low AND job_type.id_type=job_lowongan.id_type AND job_lowongan.aktif='1' AND (job_lowongan.gaji LIKE '%".$this->input->post('gaji')."%' AND job_lowongan.provinsi LIKE '%".$this->input->post('provinsi')."%' AND (job_lowongan.nm_lowongan LIKE '%".$search."%' OR job_k_lowongan.nm_k_lowongan LIKE '%".$search."%')) ORDER BY job_lowongan.id_golongan ASC, job_aktivasi.date_limit DESC LIMIT ".$uri.",".$perpage);
		if($query->num_rows()){
			return $query->result();
		}else{
			return null;
		}	
	}

	public function totalCariLowonganBerdasarkan($search)
	{
		$query = $this->db->query("SELECT * FROM job_lowongan, job_aktivasi, job_perusahaan, job_k_lowongan, job_type WHERE job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_k_lowongan.id_k_low=job_lowongan.id_k_low AND job_type.id_type=job_lowongan.id_type AND job_lowongan.aktif='1' AND (job_lowongan.gaji LIKE '%".$this->input->post('gaji')."%' AND job_lowongan.provinsi LIKE '%".$this->input->post('provinsi')."%' AND (job_lowongan.nm_lowongan LIKE '%".$search."%' OR job_k_lowongan.nm_k_lowongan LIKE '%".$search."%')) ORDER BY job_lowongan.id_golongan ASC, job_aktivasi.date_limit DESC");
		if($query){
			return $query->num_rows();
		}else{
			return null;
		}	
	}

	public function getLowonganById($id)
	{
		$query = $this->db->query("SELECT * FROM job_lowongan, job_perusahaan, job_k_lowongan, job_aktivasi, job_type WHERE job_lowongan.id_type=job_type.id_type AND job_lowongan.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_lowongan.aktif=1 AND job_lowongan.id_lowongan='".$id."'");
		if($query){
			return $query->result();
		}else{
			return null;
		}
	}

	public function getLowonganPerusahaan()
	{
		$query = $this->db->query("SELECT * FROM job_perusahaan, job_lowongan, job_aktivasi, job_type, job_golongan, job_k_lowongan WHERE job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_type=job_type.id_type AND job_lowongan.id_golongan=job_golongan.id_golongan AND job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND job_perusahaan.id_perusahaan='".$this->session->userdata('id_login')."' ORDER BY job_aktivasi.date_limit ASC");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}

	public function getLowonganPerusahaanNumRows()
	{
		$query = $this->db->query("SELECT * FROM job_perusahaan, job_lowongan, job_aktivasi, job_type, job_golongan, job_k_lowongan WHERE job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_type=job_type.id_type AND job_lowongan.id_golongan=job_golongan.id_golongan AND job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND job_perusahaan.id_perusahaan='".$this->session->userdata('id_login')."' ORDER BY job_aktivasi.date_limit DESC");
		return $query->num_rows();
	}

	public function detailLowonganById($id)
	{
		$query = $this->db->query("SELECT *, job_lowongan.aktif as aktif FROM job_perusahaan, job_lowongan, job_aktivasi, job_k_lowongan, job_golongan, job_type WHERE job_perusahaan.id_perusahaan=job_lowongan.id_perusahaan AND job_lowongan.id_lowongan=job_aktivasi.id_lowongan AND job_lowongan.id_type=job_type.id_type AND job_lowongan.id_golongan=job_golongan.id_golongan AND job_lowongan.id_k_low=job_k_lowongan.id_k_low AND job_lowongan.id_lowongan='".$id."' AND job_lowongan.id_perusahaan='".$this->session->userdata('id_login')."'");
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

	public function showLamaran()
	{
		$query = $this->db->query("SELECT *, job_lowongan.aktif as aktif FROM job_lamar, job_lowongan, job_perusahaan, job_aktivasi, job_type, job_k_lowongan WHERE job_lamar.id_lowongan=job_lowongan.id_lowongan AND job_lamar.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_type=job_type.id_type AND job_k_lowongan.id_k_low=job_lowongan.id_k_low AND job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND job_lowongan.aktif=1 AND job_lamar.id_pelamar='".$this->session->userdata('id_login')."' ORDER BY job_lamar.tgl_create DESC");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}

	public function showLamaranById()
	{
		$query = $this->db->query("SELECT *, job_lowongan.aktif as aktif FROM job_lamar, job_lowongan, job_perusahaan, job_aktivasi, job_type, job_k_lowongan WHERE job_lamar.id_lowongan=job_lowongan.id_lowongan AND job_lamar.id_perusahaan=job_perusahaan.id_perusahaan AND job_lowongan.id_type=job_type.id_type AND job_k_lowongan.id_k_low=job_lowongan.id_k_low AND job_aktivasi.id_lowongan=job_lowongan.id_lowongan AND job_lowongan.aktif=1 AND job_lamar.id_pelamar='".$this->session->userdata('id_login')."' AND job_lamar.sts_lamar='1' ORDER BY job_lamar.tgl_create DESC");
		if($query->num_rows()>0){
			return $query->result();
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

    public function getBerita($perpage, $uri)
	{
		if($uri==''){
			$uri=0;
		}
		$query = $this->db->query("SELECT * FROM job_berita ORDER BY tgl DESC LIMIT ".$uri.",".$perpage);
		if($query->num_rows()){
			return $query->result();
		}else{
			return null;
		}	
	}

	public function pembayaranNumRows()
	{
		$query = $this->db->query('SELECT * FROM job_lowongan WHERE id_perusahaan="'.$this->session->userdata('id_login').'" AND NOT aktif="1"');
		return $query->num_rows();
	}

	public function aktivasiLim($id)
	{
		$query = $this->db->query('SELECT * FROM job_aktivasi WHERE id_perusahaan="'.$this->session->userdata('id_login').'" AND status="0" ORDER BY date_bill DESC LIMIT 0, '.$id);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	
}
