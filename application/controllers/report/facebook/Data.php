<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('report_facebook');
	}
	
	public function summary_TopPosting($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/summary/TopPosting', array(
					'account' => $id,
					'data' => $this->report_facebook->summary($id, 'TopPosting', $date)
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
				$this->load->view('report/facebook/data/summary/TopFollowers', array(
					'account' => $id,
					'data' => $this->report_facebook->summary($id, 'TopFollowers', $date)
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
				$this->load->view('report/facebook/data/summary/TopFeedback', array(
					'account' => $id,
					'data' => $this->report_facebook->summary($id, 'TopFeedback', $date)
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
				$this->load->view('report/facebook/data/summary/EffectiveCommunication', array(
					'account' => $id,
					'data' => $this->report_facebook->summary($id, 'TopPosting', $date)
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
				$this->load->view('report/facebook/data/highlight/Summary', array(
					'account' => $id,
					'data' => $this->report_facebook->highlight($id, 'Summary', $date)
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
				$this->load->view('report/facebook/data/highlight/Growth', array(
					'account' => $id,
					'data' => $this->report_facebook->highlight($id, 'Growth', $date)
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
				$this->load->view('report/facebook/data/activities/AccountPost', array(
					'account' => $id,
					'data' => $this->report_facebook->activities($id, 'AccountPost', $date)
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
				$this->load->view('report/facebook/data/activities/TotalFeedback', array(
					'account' => $id,
					'data' => $this->report_facebook->activities($id, 'TotalFeedback', $date)
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
				$this->load->view('report/facebook/data/activities/TotalAmplification', array(
					'account' => $id,
					'data' => $this->report_facebook->activities($id, 'TotalAmplification', $date)
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
				$this->load->view('report/facebook/data/feeds/AllAccount', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'AllAccount', $date)
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
				$this->load->view('report/facebook/data/feeds/Category', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($this->account->source($id), 'Category', $date)
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
				$this->load->view('report/facebook/data/feeds/AllTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'AllTopPost', $date)
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
				$this->load->view('report/facebook/data/feeds/AllLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'AllLeastPost', $date)
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
				$this->load->view('report/facebook/data/feeds/NotLinkTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'NotLinkTopPost', $date)
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
				$this->load->view('report/facebook/data/feeds/NotLinkLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'NotLinkLeastPost', $date)
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
				$this->load->view('report/facebook/data/feeds/LinkTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'LinkTopPost', $date)
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
				$this->load->view('report/facebook/data/feeds/LinkLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'LinkLeastPost', $date)
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
				$this->load->view('report/facebook/data/feeds/ShareTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'ShareTopPost', $date)
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
				$this->load->view('report/facebook/data/feeds/ShareLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'ShareLeastPost', $date)
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
				$this->load->view('report/facebook/data/feeds/LikeTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'LikeTopPost', $date)
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
				$this->load->view('report/facebook/data/feeds/LikeLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'LikeLeastPost', $date)
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
				$this->load->view('report/facebook/data/feeds/CommentTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'CommentTopPost', $date)
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
				$this->load->view('report/facebook/data/feeds/CommentLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'CommentLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_BoostTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/feeds/BoostTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'BoostTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_BoostLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/feeds/BoostLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'BoostLeastPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_OrganicTopPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/feeds/OrganicTopPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'OrganicTopPost', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function feeds_OrganicLeastPost($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/feeds/OrganicLeastPost', array(
					'account' => $id,
					'data' => $this->report_facebook->feeds($id, 'OrganicLeastPost', $date)
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
				$this->load->view('report/facebook/data/users/MostCommenters', array(
					'account' => $id,
					'data' => $this->report_facebook->users($id, 'MostCommenters', $date)
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
				$this->load->view('report/facebook/data/users/MostLikers', array(
					'account' => $id,
					'data' => $this->report_facebook->users($id, 'MostLikers', $date)
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
				$this->load->view('report/facebook/data/users/MostActive', array(
					'account' => $id,
					'data' => $this->report_facebook->users($id, 'MostActive', $date)
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
				$this->load->view('report/facebook/data/users/TopSpeakers', array(
					'account' => $id,
					'data' => $this->report_facebook->users($id, 'TopSpeakers', $date)
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
				$this->load->view('report/facebook/data/performance/Summary', array(
					'account' => $id,
					'date' => $period[0],
					'data' => $this->report_facebook->performance($id, 'Summary', $period[0])
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
				$this->load->view('report/facebook/data/performance/VsCompetitor', array(
					'account' => $this->account->source($id),
					'date' => $period[0],
					'competitor' => $this->report_facebook->performance($id, 'competitor', NULL)
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
				$this->load->view('report/facebook/data/performance/Interaction', array(
					'account' => $this->account->source($id),
					'date' => $date,
					'competitor' => $this->report_facebook->performance($id, 'competitor', NULL),
					'data' => $this->report_facebook->performance($id, 'Interaction', $date)
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
				$this->load->view('report/facebook/data/primetime/DailyPost', array(
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
				$this->load->view('report/facebook/data/primetime/DailyComment', array(
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
				$this->load->view('report/facebook/data/growth/DailyFans', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_facebook->growth($id, 'DailyFans', $date)
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
				$this->load->view('report/facebook/data/growth/DailyGrowth', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_facebook->growth($id, 'DailyFans', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function growth_DailyGrowthCompetitor($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->load->view('report/facebook/data/growth/DailyGrowthCompetitor', array(
					'account' => $id,
					'unix' => getmonth('unix', $date),
					'data' => $this->report_facebook->growth($id, 'DailyFans', $date)
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
				$this->load->view('report/facebook/data/growth/MonthlyFans', array(
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
				$this->load->view('report/facebook/data/growth/MonthlyGrowth', array(
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
				$this->load->view('report/facebook/data/growth/MonthlyGrowthCompetitor', array(
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
				$this->load->view('report/facebook/data/conversation/All', array(
					'account' => $id,
					'data' => $this->report_facebook->conversation($id, 'All', $date)
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
				$this->load->view('report/facebook/data/benchmark/All', array(
					'account' => $id,
					'data' => $this->report_facebook->benchmark($id, $json->category, $date)
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
				$this->load->view('report/facebook/data/comparison/Category', array(
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
						$this->load->view('report/facebook/data/comparison/'.$category, array(
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
						$this->load->view('report/facebook/data/comparison/'.$category, array(
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
	
	public function linking_TopFanpage($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/linking/TopFanpage', array(
					'account' => $id,
					'data' => $this->report_facebook->linking($id, 'TopFanpage', $date)
				));
			}
		}
		else echo '<p align="center">Session expired!<br><a href="'.site_url('authentication/logout').'">[Re-login]</a></p>';
	}
	
	public function demography_Country($id)
	{
		if($this->auth->session('id')){
			if($date = $this->input->post('date')){
				$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
				$this->load->view('report/facebook/data/demography/Country', array(
					'account' => $id,
					'data' => $this->report_facebook->demography($id, 'Country', $date)
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
				$this->load->view('report/facebook/data/demography/State', array(
					'account' => $id,
					'data' => $this->report_facebook->demography($id, 'State', $date)
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
				$this->load->view('report/facebook/data/demography/City', array(
					'account' => $id,
					'data' => $this->report_facebook->demography($id, 'City', $date)
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
				$this->load->view('report/facebook/data/download/Summary', array(
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