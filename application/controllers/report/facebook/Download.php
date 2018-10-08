<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('excel');
	}
	
	public function feeds($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_feed($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feed_resume($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_feed_resume($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function visitors($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_visitor($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function comments($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_comment($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_users($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function primetime($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_primetime($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_growth($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function master($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->excel->facebook_master($id, formatmonth($this->input->get('from'), $this->input->get('to')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function benchmark($m)
	{
		if($this->auth->session('id')){
			$month = arr_month(1);
			$this->excel->facebook_benchmark(strtotime('01 '.$month[$m].' '.date('Y')));
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
}