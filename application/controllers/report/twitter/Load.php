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
			$this->load->view('report/twitter/load/summary', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function highlight($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/highlight', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/activities', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$Qlist = $this->db->from('account')->where('account_id', $id)->get();
			if($Qlist->num_rows()){
				$this->load->view('report/twitter/load/feeds', array(
					'account' => $Qlist->row()
				));
			}
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/users', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function performance($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$Qlist = $this->db->from('account')->where('account_id', $id)->get();
			if($Qlist->num_rows()){
				$this->load->view('report/twitter/load/performance', array(
					'account' => $Qlist->row()
				));
			}
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function primetime($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/primetime', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth($id)
	{
		if($this->auth->session('id')){
			$this->load->model('report_twitter');
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/growth', array(
				'account' => $id,
				'data' => $this->report_twitter->summary($id, 'TopFollower', lastmonth())
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function conversation($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/conversation', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function benchmark($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->model('report_twitter');
			$this->load->view('report/twitter/load/benchmark', array(
				'account' => $id,
				'data' => $this->report_twitter->benchmark($id, 'Category', NULL)
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function comparison($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/comparison', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function demography($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/demography', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function download($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$this->load->view('report/twitter/load/download', array(
				'account' => $id
			));
		}
		else echo '<p align="center" style="padding-top:25px">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
}