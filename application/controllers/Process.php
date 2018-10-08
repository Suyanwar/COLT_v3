<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function my_profile()
	{
		if($idx = $this->auth->session('id')){
			$this->load->model('users');
			
			$var = array('name', 'uname', 'new_pswd', 'current_pswd');
			for($i = 0; $i < count($var); $i++) $$var[$i] = $this->input->post($var[$i]);
			if($name && $uname){
				
				$restrict = array(
					'username' => $uname
				);
				if($this->users->restrict_item($restrict, $idx)) die(slidedown_response('iform_f1', 'error-box', '<u>'.$uname.'</u> is already exist.'));
				
				$data = array(
					'username' => $uname,
					'full_name' => $name
				);
				
				if($new_pswd){
					if($current_pswd){
						if($this->users->restrict_item(array('password' => passwd($current_pswd)))){
							$data = array_merge($data, array(
								'password' => passwd($new_pswd)
							));
						}
						else die(slidedown_response('iform_f1', 'error-box', 'Your current password is incorrect.'));
					}
					else die(slidedown_response('iform_f1', 'error-box', 'Please insert your current password.'));
				}
				
				$this->users->update_source($data, $idx);
				set_userdata('name', $name);
				
				echo action_response(1, 'iform_f1', 'success-box', 'Changes saved..', '$("#user_name").html("'.$name.'")');
			}
			else echo slidedown_response('iform_f1', 'error-box', 'Please complete the form below.');
		}
		else echo slidedown_response('iform_f1', 'error-box', 'Session expired! <a href="'.site_url('authentication/logout').'" style="color:#FFF">[Re-login]</a>.');
	}
	
	public function set_period()
	{
		if($id = $this->input->post('id')){
			set_userdata('report', $id);
		}
	}
	
	public function delete($tp)
	{
		if(($idx = $this->auth->session('id')) && $this->input->post('idx')){
			switch($tp){
				case 'feed':
					$this->db->delete('feed', array('post_id' => $this->input->post('idx')));
					break;
			}
		}
	}
	
	public function search_account($id)
	{
		$keyword = $this->input->post('keyword');
		switch($id){
			case 'facebook':
				$this->load->model('report_facebook');
				$token = $this->report_facebook->token();
				if($json = curl_file_get_contents(url('facebook', 'search?type=page&q='.urlencode($keyword).'&access_token='.$token))){
					$i = 0;
					$ls = '';
					$data = json_decode($json, true);
					foreach($data['data'] as $list){
						if($i < 3){
							$detail = json_decode(curl_file_get_contents(url('facebook', $list['id'].'?access_token='.$token)));
							$fans = isset($detail->likes) ? number_format($detail->likes) : '-';
							$ls .= '<li><a href="https://facebook.com/'.$list['id'].'" target="_blank"><img style="background-image:url('.url('facebook', $list['id'].'/picture?type=square').')" src="'.base_url('static/i/frame-facebook.png').'"></a><div>'.$list['name'].'<!--font class="fa fa-check-circle"></font--><br><span>'.$fans.' Fans</span></div><a class="add" onclick="add_account(\'facebook\', \''.$list['id'].'\')">Add</a><div class="clear"></div></li>';
						}
						$i++;
					}
					echo $ls ? '<ul>'.$ls.'</ul>' : '<h2>No data!</h2>';
				}
				else echo '<h2>No data!</h2>';
				break;
				
			case 'twitter':
				if($json = curl_file_get_contents('http://188.166.246.225/colt/graph/twitter/search.php?screen_name='.urlencode($keyword))){
					if(!isset($json->errors)){
						$ls = '';
						$data = json_decode($json);
						if(isset($data->id_str)){
							$ls .= '<li><a href="'.($data->screen_name ? 'https://twitter.com/'.$data->screen_name : 'https://twitter.com/intent/user?user_id='.$data->id_str).'" target="_blank"><img style="background-image:url('.$data->profile_image_url.')" src="'.base_url('static/i/frame-twitter.png').'"></a><div>'.$data->name.' (@'.$data->screen_name.')'.($data->verified ? '<font class="fa fa-check-circle"></font>' : '').'<br><span>'.number_format($data->followers_count).' Followers</span></div><a class="add" onclick="add_account(\'twitter\', \''.$data->id_str.'\')">Add</a><div class="clear"></div></li>';
						}
						echo $ls ? '<ul>'.$ls.'</ul>' : '<h2>No data!</h2>';
					}
					else echo '<h2>Error!</h2>';
				}
				else echo '<h2>No data!</h2>';
				break;
				
			case 'twitterXX':
				$this->load->library('twitteroauth');
				$this->load->model('report_twitter');
				$app = $this->report_twitter->token();
				
				$connection = $this->twitteroauth->create($app->app_id, $app->app_secret, $app->oauth_token, $app->oauth_secret);
				$access_token = $connection->get('account/verify_credentials');
				
				if($data = $connection->get('users/show', array('screen_name' => $keyword))){
					if(!isset($data->errors)){
						$i = 0;
						$ls = '';
						foreach($data as $list){
							if($i < 3){
								$ls .= '<li><a href="'.($list->screen_name ? 'https://twitter.com/'.$list->screen_name : 'https://twitter.com/intent/user?user_id='.$list->id_str).'" target="_blank"><img style="background-image:url('.$list->profile_image_url.')" src="'.base_url('static/i/frame-twitter.png').'"></a><div>'.$list->name.' (@'.$list->screen_name.')<!--font class="fa fa-check-circle"></font--><br><span>'.number_format($detail->followers_count).' Followers</span></div><a class="add" onclick="add_account(\'twitter\', \''.$list->id_str.'\')">Add</a><div class="clear"></div></li>';
							}
							$i++;
						}
						echo $ls ? '<ul>'.$ls.'</ul>' : '<h2>No data!</h2>';
					}
					else echo '<h2>'.$app->oauth_token.'Error! '.print_r($data).'</h2>';
				}
				else echo '<h2>No data!</h2>';
				break;
				
			case 'twitterX':
				$this->load->model('report_twitter');
				$app = $this->report_twitter->token();
				
				//$this->load->helper(array('path'));
				//$this->load->file('application/libraries/TwitterOAuth.php');
				require('TwitterOAuth.php');
				$twitteroauth = new TwitterOAuth($app->app_id, $app->app_secret, $app->oauth_token, $app->oauth_secret);
				$access_token = $twitteroauth->getAccessToken($app->oauth_verifier);
				
				if($data = $twitteroauth->get('users/show', array('screen_name' => $keyword))){
					if(!isset($data->errors)){
						$i = 0;
						$ls = '';
						foreach($data as $list){
							if($i < 3){
								$ls .= '<li><a href="'.($list->screen_name ? 'https://twitter.com/'.$list->screen_name : 'https://twitter.com/intent/user?user_id='.$list->id_str).'" target="_blank"><img style="background-image:url('.$list->profile_image_url.')" src="'.base_url('static/i/frame-twitter.png').'"></a><div>'.$list->name.' (@'.$list->screen_name.')<!--font class="fa fa-check-circle"></font--><br><span>'.number_format($detail->followers_count).' Followers</span></div><a class="add" onclick="add_account(\'twitter\', \''.$list->id_str.'\')">Add</a><div class="clear"></div></li>';
							}
							$i++;
						}
						echo $ls ? '<ul>'.$ls.'</ul>' : '<h2>No data!</h2>';
					}
					else echo '<h2>Error! '.print_r($data).'</h2>';
				}
				else echo '<h2>No data!</h2>';
				break;
				
			case 'instagram':
				$this->load->model('report_instagram');
				$token = $this->report_instagram->token();
				if($json = curl_file_get_contents(url('instagram', 'users/search?q='.urlencode($keyword).'&access_token='.$token))){
					$i = 0;
					$ls = '';
					$data = json_decode($json, true);
					foreach($data['data'] as $list){
						if($i < 3){
							//$detail = json_decode(curl_file_get_contents(url('instagram', 'users/'.$list['id'].'?access_token='.$token)));
							//$fans = isset($detail->data->id) ? number_format($detail->data->counts->followed_by) : '-';
							
							$detail = json_decode(curl_file_get_contents('https://www.instagram.com/'.$list['username'].'/?__a=1'));
							$ls .= '<li><a href="https://www.instagram.com/'.$list['username'].'" target="_blank"><img style="background-image:url('.$list['profile_picture'].')" src="'.base_url('static/i/frame-instagram.png').'"></a><div>'.$list['full_name'].' (@'.$list['username'].')'.((isset($detail->user->is_verified) && $detail->user->is_verified) ? '<font class="fa fa-check-circle"></font>' : '').'<br><span>'.(isset($detail->user->followed_by->count) ? number_format($detail->user->followed_by->count) : '-').' Followers</span></div><a class="add" onclick="add_account(\'instagram\', \''.$list['id'].'\')">Add</a><div class="clear"></div></li>';
						}
						$i++;
					}
					echo $ls ? '<ul>'.$ls.'</ul>' : '<h2>No data!</h2>';
				}
				else echo '<h2>No data!</h2>';
				break;
		}
	}
	
	public function autocomplete()
	{
		if($idx = $this->auth->session('id')){
			$var = array('source', 'value', 'selected', 'disabled');
			for($i = 0; $i < count($var); $i++) $$var[$i] = $this->input->get($var[$i]);
			
			if($disabled == 1) $disabled = ' disabled="disabled"'; elseif($disabled == 2) $disabled = ' readonly="readonly"'; else $disabled = '';
			
			switch($source){
				case 'comparison_option':
					if(!$value) die();
					
					switch($value){
						case 'daily_fans':
						case 'daily_growth':
						case 'daily_post':
							$months = arr_month(1);
							for($y=date('Y'); $y >= date('Y') -1; $y--){
								$td = 1;
								echo '<table class="block"><tr>';
								for($i=1; $i <= count($months); $i++){
									if($td == 1) echo '<td>';
									
									echo '<label><input type="checkbox" name="month[]" value="'.$y.'-'.(($i > 9) ? $i : '0'.$i).'"> '.$months[$i].' '.$y.'</label><br>';
									
									if($td == 3){
										$td = 1;
										echo '</td>';
									}
									else $td++;
								}
								echo '</tr></table>';
							}
							break;
							
						case 'monthly_fans':
						case 'monthly_growth':
						case 'monthly_post':
							echo '<table class="block"><tr>';
							for($y=date('Y'); $y >= date('Y') -1; $y--){
								echo '<td style="text-align:center"><label><input type="checkbox" name="year[]" value="'.$y.'"> '.$y.'</label></td>';
							}
							echo '</tr></table>';
							break;
					}
					
					echo '<div style="text-align:center"><input type="submit" value="GENERATE"></div>';
					break;
			}
		}
	}
}