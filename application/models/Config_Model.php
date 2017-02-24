<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_Model extends CI_Model 
{
	/**
	 * returns object config by name
	 * 
	 * @param type $name
	 * @return type
	 */
	public function get_by_name($name)
	{
		$query = $this->db->query('select * from config where name = "'.$name.'"');
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		
		return null;
	}
	
	/**
	 * returns value
	 * 
	 * @param type $name
	 * @return type
	 */
	public function get_value_by_name($name)
	{
		$query = $this->get_by_name($name);
		if (!$query) {
			return null;
		}
		
		return $query->value;
	}
	
	public function get_app_name()
	{
		return $this->get_value_by_name('app_name');
	}
	
	public function get_app_contact_address()
	{
		return $this->get_value_by_name('app_contact_address');
	}
	
	public function get_app_contact_address2()
	{
		return $this->get_value_by_name('app_contact_address_2');
	}
	
	public function get_app_contact_phone()
	{
		return $this->get_value_by_name('app_contact_phone');
	}
	
	public function get_app_contact_phone2()
	{
		return $this->get_value_by_name('app_contact_phone_2');
	}
	
	public function get_app_contact_email()
	{
		return $this->get_value_by_name('app_contact_email');
	}
	
	public function get_app_contact_latitude()
	{
		return $this->get_value_by_name('app_contact_latitude');
	}
	
	public function get_app_contact_longitude()
	{
		return $this->get_value_by_name('app_contact_longitude');
	}
	
	public function get_app_facebook()
	{
		return $this->get_value_by_name('app_facebook_url');
	}
	
	public function get_app_twitter()
	{
		return $this->get_value_by_name('app_twitter_url');
	}
	
	public function get_app_google()
	{
		return $this->get_value_by_name('app_google_url');
	}
	
	public function get_app_main_url()
	{
		return $this->get_value_by_name('app_main_url');
	}
	
	public function get_main_metadesc()
	{
		return $this->get_value_by_name('main_metadesc');
	}
	
	public function get_main_metakey()
	{
		return $this->get_value_by_name('main_metakey');
	}
	
	public function get_app_pagetitle()
	{
		return $this->get_value_by_name('app_pagetitle');
	}
	
	public function get_admin_email()
	{
		return $this->get_value_by_name('admin_email');
	}
	
	public function get_app_name_url()
	{
		return $this->get_value_by_name('app_name_url');
	}
}
