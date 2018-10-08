<?php defined('BASEPATH') OR exit('No direct script access allowed');

switch($content){
	case 'home':
		if($list_data){
			echo '<ul>';
			foreach($list_data as $list){
				echo '<li style="background-image:url('.$list->photo_cover.')"><a href="'.site_url('report/'.$list->socmed.'/'.$list->account_id).'"><img src="'.base_url('static/i/spacer.gif').'" style="background-image:url('.$list->photo_profile.')" /><h1><sup><img src="'.base_url('static/i/flag-'.$list->fl_active.'.png').'" title="'.($list->fl_active ? 'Active' : 'Idle').'"></sup>'.$list->name.'</h1><span>'.number_format($list->follower).' '.(($list->socmed == 'facebook') ? 'Fans' : 'Followers').'</span></a></li>';
			}
			echo '</ul>';
		}
		else echo '<p align="center">No data!</p>';
		break;
}