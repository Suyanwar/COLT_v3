<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index($id)
	{
		if($this->auth->session('id')){
			$this->account->restrict_role($this->auth->session('role'), $id) OR die('Forbidden!');
			if($account = $this->account->source($id, array('socmed' => 'facebook'))){
				$arr = array(
					'menu' => 'report',
					'view' => array(
						'main',
						'data' => array(
							'page' => 'report/facebook/main',
							'content' => array(
								'account' => $account,
								'accounts' => $this->account->role_source(array(
									'socmed' => 'facebook',
									'is_priority' => 1
								)),
								'menus' => array(
									array('tv', 'summary', 'Summary'),
									array('star-half-full', 'highlight', 'Highlight'),
									array('bar-chart', 'activities', 'Activities'),
									array('rss', 'feeds', 'Feeds'),
									array('user', 'users', 'Users'),
									array('arrow-circle-up', 'performance', 'Performance'),
									array('clock-o', 'primetime', 'Prime Time'),
									array('line-chart', 'growth', 'Growth'),
									array('comments-o', 'conversation', 'Conversation'),
									array('braille', 'benchmark', 'Benchmark'),
									array('object-ungroup', 'comparison', 'Comparison'),
									array('link', 'linking', 'Fans Connect'),
									array('globe', 'demography', 'Demography'),
									array('download', 'download', 'Download')
								)
							)
						)
					)
				);
				$this->load->view('template/page', $arr);
			}
		}
		else $this->load->view('template/login');
	}
}