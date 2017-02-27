<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Page extends MY_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	public function detail($slug) 
	{
		$loadDataCek = $this->fronModel->showById('page', array('slug' => $slug));
		if (!$loadDataCek) {
			redirect(base_url('error/error404'));
		}
		
		$tampil['kategoriData'] = $this->fronModel->show('page WHERE category=1', 'name', 'ASC');

		$tampil['meta_deskripsi'] = $this->Config_Model->get_app_name_url() . " " . $loadDataCek->name;
		$tampil['page_title'] = $loadDataCek->name;

		$tampil['page'] = $loadDataCek;
		
		$this->final_view('front/page/index', $tampil);
	}
}
