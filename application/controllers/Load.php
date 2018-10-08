<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Load extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function tab_home($id)
	{
		if($this->auth->session('id')){
			
			$this->load->model('account');
			$this->load->view('load', array(
				'content' => 'home',
				'list_data' => $this->account->role_source(array(
					'socmed' => $id,
					'is_priority' => 1
				))
			));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
}