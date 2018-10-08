<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('report_twitter');
	}
	
	public function summary_TopPosting($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/summary/TopPosting', array(
					'account' => $id,
					'data' => $this->report_twitter->summary($id, 'TopPosting', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function summary_TopFollowers($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/summary/TopFollowers', array(
					'account' => $id,
					'data' => $this->report_twitter->summary($id, 'TopFollowers', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function summary_TopFeedback($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/summary/TopFeedback', array(
					'account' => $id,
					'data' => $this->report_twitter->summary($id, 'TopFeedback', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function summary_EffectiveCommunication($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/summary/EffectiveCommunication', array(
					'account' => $id,
					'data' => $this->report_twitter->summary($id, 'TopPosting', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function highlight_Summary($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/highlight/Summary', array(
					'account' => $id,
					'data' => $this->report_twitter->highlight($id, 'Summary', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function highlight_Growth($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/highlight/Growth', array(
					'account' => $id,
					'data' => $this->report_twitter->highlight($id, 'Growth', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities_AccountPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/activities/AccountPost', array(
					'account' => $id,
					'data' => $this->report_twitter->activities($id, 'AccountPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities_TotalFeedback($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/activities/TotalFeedback', array(
					'account' => $id,
					'data' => $this->report_twitter->activities($id, 'TotalFeedback', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function activities_TotalAmplification($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/activities/TotalAmplification', array(
					'account' => $id,
					'data' => $this->report_twitter->activities($id, 'TotalAmplification', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_AllAccount($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/AllAccount', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'AllAccount', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_Category($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/Category', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($this->account->source($id), 'Category', $date)
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
				$this->load->view('report/twitter/data/feeds/AllTopPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'AllTopPost', $date)
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
				$this->load->view('report/twitter/data/feeds/AllLeastPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'AllLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_NotLinkTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/NotLinkTopPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'NotLinkTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_NotLinkLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/NotLinkLeastPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'NotLinkLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_LinkTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/LinkTopPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'LinkTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_LinkLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/LinkLeastPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'LinkLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_ShareTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/ShareTopPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'ShareTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_ShareLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/feeds/ShareLeastPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'ShareLeastPost', $date)
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
				$this->load->view('report/twitter/data/feeds/LikeTopPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'LikeTopPost', $date)
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
				$this->load->view('report/twitter/data/feeds/LikeLeastPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'LikeLeastPost', $date)
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
				$this->load->view('report/twitter/data/feeds/CommentTopPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'CommentTopPost', $date)
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
				$this->load->view('report/twitter/data/feeds/CommentLeastPost', array(
					'account' => $id,
					'data' => $this->report_twitter->feeds($id, 'CommentLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users_MostShare($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/users/MostShare', array(
					'account' => $id,
					'data' => $this->report_twitter->users($id, 'MostShare', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users_MostMention($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/users/MostMention', array(
					'account' => $id,
					'data' => $this->report_twitter->users($id, 'MostMention', $date)
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
				$this->load->view('report/twitter/data/users/MostActive', array(
					'account' => $id,
					'data' => $this->report_twitter->users($id, 'MostActive', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function users_TopSpeakers($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/users/TopSpeakers', array(
					'account' => $id,
					'data' => $this->report_twitter->users($id, 'TopSpeakers', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function performance_Summary($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$period = getmonth('unix', $date);
				$this->load->view('report/twitter/data/performance/Summary', array(
					'account' => $id,
					'date' => $period[0],
					'data' => $this->report_twitter->performance($id, 'Summary', $period[0])
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function performance_VsCompetitor($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$period = getmonth('unix', $date);
				$this->load->view('report/twitter/data/performance/VsCompetitor', array(
					'account' => $this->account->source($id),
					'date' => $period[0],
					'competitor' => $this->report_twitter->performance($id, 'competitor', NULL)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function performance_Interaction($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/performance/Interaction', array(
					'account' => $this->account->source($id),
					'date' => $date,
					'competitor' => $this->report_twitter->performance($id, 'competitor', NULL),
					'data' => $this->report_twitter->performance($id, 'Interaction', $date)
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
				$this->load->view('report/twitter/data/primetime/DailyPost', array(
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
				$this->load->view('report/twitter/data/primetime/DailyComment', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'date' => $date
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function primetime_DailyShare($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/primetime/DailyShare', array(
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
				$this->load->view('report/twitter/data/growth/DailyFans', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_twitter->growth($id, 'DailyFans', $date)
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
				$this->load->view('report/twitter/data/growth/DailyGrowth', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_twitter->growth($id, 'DailyFans', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_DailyGrowthCompetitor($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->load->view('report/twitter/data/growth/DailyGrowthCompetitor', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_twitter->growth($id, 'DailyFans', $date)
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
				$this->load->view('report/twitter/data/growth/MonthlyFans', array(
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
				$this->load->view('report/twitter/data/growth/MonthlyGrowth', array(
					'account' => $id,
					'unix' => getmonth('unix', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_MonthlyGrowthCompetitor($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->load->view('report/twitter/data/growth/MonthlyGrowthCompetitor', array(
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
				$this->load->view('report/twitter/data/conversation/All', array(
					'account' => $id,
					'data' => $this->report_twitter->conversation($id, 'All', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function benchmark($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$json = json_decode($this->input->post('data'));
				$this->load->view('report/twitter/data/benchmark/All', array(
					'account' => $id,
					'data' => $this->report_twitter->benchmark($id, $json->category, $date)
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
				$this->load->view('report/twitter/data/comparison/Category', array(
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
						$this->load->view('report/twitter/data/comparison/'.$category, array(
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
						$this->load->view('report/twitter/data/comparison/'.$category, array(
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
	
	public function demography_Country($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/demography/Country', array(
					'account' => $id,
					'data' => $this->report_twitter->demography($id, 'Country', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function demography_State($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/demography/State', array(
					'account' => $id,
					'data' => $this->report_twitter->demography($id, 'State', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function demography_City($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/demography/City', array(
					'account' => $id,
					'data' => $this->report_twitter->demography($id, 'City', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function download_Summary($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/twitter/data/download/Summary', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'menus' => array(
						array('rss', 'feeds', 'Feeds'),
						array('comments-o', 'comments', 'Replies'),
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