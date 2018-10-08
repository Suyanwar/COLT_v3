<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if($this->auth->session('id')){
			$arr = array(
				'menu' => 'report',
				'view' => array(
					'home',
					'data' => array()
				)
			);
			$this->load->view('template/page', $arr);
		}
		else $this->load->view('template/login');
	}
	
	public function accounts($id=NULL)
	{
		if($this->auth->session('id') && $id){
			$arr = array(
				'menu' => 'report_'.$id,
				'view' => array(
					'main',
					'data' => array(
						'page' => 'accounts/'.$id,
						'content' => array()
					)
				)
			);
			$this->load->view('template/page', $arr);
		}
		else $this->load->view('template/login');
	}
	
	public function account()
	{
		if($this->auth->session('id')){
			$arr = array(
				'menu' => 'account',
				'view' => array(
					'main',
					'data' => array(
						'page' => 'account/main',
						'content' => array(
							//'test' => 456
						)
					)
				)
			);
			$this->load->view('template/page', $arr);
		}
		else $this->load->view('template/login');
	}
	
	public function users($p=1)
	{
		if($this->auth->session('id')){
			$this->load->model('users');
			$arr = array(
				'menu' => 'users',
				'view' => array(
					'main',
					'data' => array(
						'page' => 'users/main',
						'content' => array(
							'list_data' => $this->users->get_source($p, $this->input->get('q')),
							'pagination' => array(
								'page' => pagination_page($p),
								'limit' => $this->users->get_limit(),
								'num_rows' => $this->users->paging_source($this->input->get('q'))
							)
						)
					)
				)
			);
			$this->load->view('template/page', $arr);
		}
		else $this->load->view('template/login');
	}
	
	public function utest()
	{
		$this->load->model('excel');
		$this->excel->utest();
	}
	
	public function all_resume($socmed=NULL)
	{
		if($socmed){
			
			$this->load->model('excel_yearly');
			$this->excel_yearly->$socmed($this->input->get('fname'), $this->input->get('path'));
			
		}else{
			
			echo '<h3>FACEBOOK</h3>';
			
			$arr_id = array(13, 14, 23, 30, 46);
			$arr_file = array('top_active', 'top_commenters', 'top_likers', 'top_share');
			
			foreach($arr_id as $id){
				echo '<ul>';
				foreach($arr_file as $file){
					echo '<li><a href="'.base_url('main/all_resume/facebook?fname='.$file.'_'.$id.'&path=2016/'.$id.'/'.$file.'.json').'">'.$file.' ('.$id.')</a></li>';
				}
				echo '</ul>';
			}
			
			echo '<hr>';
			
			echo '<h3>TWITTER</h3>';
			
			$arr_id = array(74, 82, 97, 98, 101);
			$arr_file = array('top_active', 'top_mention', 'top_retweet');
			
			foreach($arr_id as $id){
				echo '<ul>';
				foreach($arr_file as $file){
					echo '<li><a href="'.base_url('main/all_resume/twitter?fname='.$file.'_'.$id.'&path=2016/'.$id.'/'.$file.'.json').'">'.$file.' ('.$id.')</a></li>';
				}
				echo '</ul>';
			}
			
			echo '<hr>';
			
			echo '<h3>INSTAGRAM</h3>';
			
			$arr_id = array(1, 2, 3, 4, 7);
			$arr_file = array('top_active', 'top_commenters', 'top_likers');
			
			foreach($arr_id as $id){
				echo '<ul>';
				foreach($arr_file as $file){
					echo '<li><a href="'.base_url('main/all_resume/instagram?fname='.$file.'_'.$id.'&path=2016/'.$id.'/'.$file.'.json').'">'.$file.' ('.$id.')</a></li>';
				}
				echo '</ul>';
			}
			
			echo '<hr>';
		}
	}
}