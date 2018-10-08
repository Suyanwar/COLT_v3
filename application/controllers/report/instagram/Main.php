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
			if($account = $this->account->source($id, array('socmed' => 'instagram'))){
				$arr = array(
					'menu' => 'report',
					'view' => array(
						'main',
						'data' => array(
							'page' => 'report/instagram/main',
							'content' => array(
								'account' => $account,
								'accounts' => $this->account->role_source(array(
									'socmed' => 'instagram',
									'is_priority' => 1
								)),
								'menus' => array(
									array('tv', 'summary', 'Summary'),
									array('bar-chart', 'activities', 'Activities'),
									array('rss', 'feeds', 'Feeds'),
									array('user', 'users', 'Users'),
									array('tags', 'hashtag', 'Tags Post'),
									array('clock-o', 'primetime', 'Prime Time'),
									array('line-chart', 'growth', 'Growth'),
									array('comments-o', 'conversation', 'Conversation'),
									array('object-ungroup', 'comparison', 'Comparison'),
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