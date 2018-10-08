<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Load extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function summary($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/summary', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/activities', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/feeds', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/users', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function hashtag($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/hashtag', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function primetime($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/primetime', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/growth', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function conversation($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/conversation', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function comparison($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/comparison', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function download($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/instagram/load/download', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
}