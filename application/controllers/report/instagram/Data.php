<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('report_instagram');
	}
	
	public function summary_Summary($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/summary/Summary', array(
					'account' => $id,
					'data' => $this->report_instagram->summary($id, 'Summary', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities_ActivitiesChart($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/activities/ActivitiesChart', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_instagram->activities($id, 'ActivitiesChart', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities_ActivitiesDetail($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/activities/ActivitiesDetail', array(
					'account' => $id,
					'data' => $this->report_instagram->activities($id, 'ActivitiesDetail', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_AllTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/AllTopPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'AllTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_AllLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/AllLeastPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'AllLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_LikeTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/LikeTopPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'LikeTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_LikeLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/LikeLeastPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'LikeLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_CommentTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/CommentTopPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'CommentTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_CommentLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/CommentLeastPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'CommentLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_VideoTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/VideoTopPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'VideoTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_VideoLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/VideoLeastPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'VideoLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_ViewVideoTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/ViewVideoTopPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'ViewVideoTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_ViewVideoLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/feeds/ViewVideoLeastPost', array(
					'account' => $id,
					'data' => $this->report_instagram->feeds($id, 'ViewVideoLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users_MostCommenters($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/users/MostCommenters', array(
					'account' => $id,
					'data' => $this->report_instagram->users($id, 'MostCommenters', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users_MostLikers($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/users/MostLikers', array(
					'account' => $id,
					'data' => $this->report_instagram->users($id, 'MostLikers', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users_MostActive($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/users/MostActive', array(
					'account' => $id,
					'data' => $this->report_instagram->users($id, 'MostActive', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function hashtag_MostEngage($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/hashtag/MostEngage', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_instagram->hashtag($id, 'MostEngage', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function primetime_DailyPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/primetime/DailyPost', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'date' => $date
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function primetime_DailyComment($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/primetime/DailyComment', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'date' => $date
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_DailyFans($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/growth/DailyFans', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_instagram->growth($id, 'DailyFans', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_DailyGrowth($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/growth/DailyGrowth', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_instagram->growth($id, 'DailyFans', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_MonthlyFans($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/growth/MonthlyFans', array(
					'account' => $id,
					'unix' => getmonth('unix', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_MonthlyGrowth($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/growth/MonthlyGrowth', array(
					'account' => $id,
					'unix' => getmonth('unix', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function conversation_All($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/conversation/All', array(
					'account' => $id,
					'data' => $this->report_instagram->conversation($id, 'All', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function comparison_Category($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/comparison/Category', array(
					'account' => $id
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function comparison($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			$var = array('category', 'month', 'year');
			for($i = 0; $i < count($var); $i++) $$var[$i] = $this->input->post($var[$i]);
			
			if($category):
			switch($category){
				case 'daily_fans':
				case 'daily_growth':
				case 'daily_post':
					if($month){
						$this->load->view('report/instagram/data/comparison/'.$category, array(
							'account' => $id,
							'period' => $month
						));
					}
					else echo '<p align="center">Please select a period of months!</p>';
					break;
					
				case 'monthly_fans':
				case 'monthly_growth':
				case 'monthly_post':
					if($year){
						$this->load->view('report/instagram/data/comparison/'.$category, array(
							'account' => $id,
							'period' => $year
						));
					}
					else echo '<p align="center">Please select the period of the year!</p>';
					break;
			}
			endif;
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function download_Summary($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/instagram/data/download/Summary', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'menus' => array(
						array('rss', 'feeds', 'Feeds'),
						array('comments-o', 'comments', 'Comments'),
						array('user', 'users', 'Users'),
						array('clock-o', 'primetime', 'Prime Time'),
						array('line-chart', 'growth', 'Growth'),
						array('cloud-download', 'master', 'Master Data')
					)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
}