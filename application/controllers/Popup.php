<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function my_profile()
	{
		if($this->auth->session('id')){
			
			$this->load->model('users');
			$data = array(
				'tp' => 'my_profile',
				'list_data' => $this->users->source($this->auth->session('id'))
			);
			$this->load->view('popup', $data);
		}
		else echo 'Forbidden!';
	}
	
	public function new_dashboard()
	{
		if($this->auth->session('id')){
			
			$data = array(
				'tp' => 'new_dashboard'
			);
			$this->load->view('popup', $data);
		}
		else echo 'Forbidden!';
	}
}