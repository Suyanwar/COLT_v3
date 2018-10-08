<?php

class Auth {
	
	protected $ci;
	private $cookie_name = "colt_keep";
	
	private $table_name = "admin";
	private $field_id = "admin_id";
	private $field_username = "username";
	private $field_password = "password";
	
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	
	public function session($key)
	{
		return userdata($key);
	}
	
	public function logout()
	{
		delete_cookie($this->cookie_name);
		sess_destroy();
		redirect(base_url());
	}
	
	public function login($username, $password, $keep)
	{
		$check = $this->ci->db->get_where($this->table_name, array(
			$this->field_username => $username,
			$this->field_password => passwd($password)
		));
		
		if($check->num_rows()){
			$this->set_login($check->row(), $keep);
			return true;
		}
		else return false;
	}
	
	public function set_login($user, $keep=false)
	{
		set_userdata(array(
			'id' => $user->admin_id,
			'role' => $user->role_id,
			'name' => $user->full_name,
			'report' => date('Y-m', strtotime("-1 month"))
		));
		
		if($keep){
			setcookie($this->cookie_name, $user->password.$user->admin_id, strtotime("+30 days"), '/', '', false, false);
			//set_cookie($this->cookie_name, $user->password.$user->admin_id, strtotime("+30 days"));
		}
	}
	
	public function cookie($redirect=1)
	{
		if($cookie = get_cookie($this->cookie_name, true)){
			
			$check = $this->ci->db->get_where($this->table_name, array(
				$this->field_id => substr($cookie, 32, strlen($cookie)),
				$this->field_password => substr($cookie, 0, 32)
			));
			
			if($check->num_rows()){
				$this->set_login($check->row(), true);
				if($redirect){
					redirect(base_url());
				}
			}
		}
	}
	
	public function restrict($page)
	{
		switch(userdata('role')){
			case 1: //Super Admin
				if(in_array($page, array('account', 'users'), true)) return true; else return false;
				break;
				
			case 2: //Djarum Monitoring
				if(in_array($page, array(), true)) return true; else return false;
				break;
				
			case 3: //Selebriti Monitoring
				if(in_array($page, array(), true)) return true; else return false;
				break;
				
			default:
				return false;
				break;
		}
	}
}