<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Model {
	
	public function __construct()
	{
        parent::__construct();
    }
	
	function headers($file_name)
	{
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=".$file_name.".xls");
		header("Content-Transfer-Encoding: binary");
	}
	
	function xlsBOF()
	{
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
		return;
	}
	
	function xlsEOF()
	{
		echo pack("ss", 0x0A, 0x00);
		return;
	}
	
	function xlsWriteNumber($rows, $cols, $values)
	{
		echo pack("sssss", 0x203, 14, $rows, $cols, 0x0);
		echo pack("d", $values);
		return;
	}
	
	function xlsWriteLabel($rows, $cols, $values )
	{
		$L = strlen($values);
		echo pack("ssssss", 0x204, 8 + $L, $rows, $cols, 0x0, $L);
		echo $values;
		return;
	}
	
	function competitor($account_id)
	{
		if(ctype_digit($account_id)){
			$ids = $account_id;
			$Qcheck = $this->db->from('account_competitor')->where(array('main_account' => $account_id))->get();
			if($Qcheck->num_rows()){
				foreach($Qcheck->result() as $list){
					$ids .= ','.$list->account_id;
				}
			}
			
		}else{
			
			$ids = 0;
			$Qcheck = $this->db->from('account')->where(array('fl_active' => 1, 'category IS NOT NULL' => NULL, 'socmed' => $account_id))->order_by('is_priority', 'DESC')->get();
			if($Qcheck->num_rows()){
				foreach($Qcheck->result() as $list){
					$ids .= ','.$list->account_id;
				}
			}
		}
		
		return $ids;
	}
	
	function facebook_feed($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_feed_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Permalink');
		$this->xlsWriteLabel(0, 1, 'Month');
		$this->xlsWriteLabel(0, 2, 'Year');
		$this->xlsWriteLabel(0, 3, 'Date');
		$this->xlsWriteLabel(0, 4, 'Hour');
		$this->xlsWriteLabel(0, 5, 'Type');
		$this->xlsWriteLabel(0, 6, 'Text');
		$this->xlsWriteLabel(0, 7, 'Likes');
		$this->xlsWriteLabel(0, 8, 'Comment');
		$this->xlsWriteLabel(0, 9, 'Share');
		$this->xlsWriteLabel(0, 10, 'Total Feedback');
		$this->xlsWriteLabel(0, 11, 'Est.Impression');
		$this->xlsWriteLabel(0, 12, 'Name');
		$this->xlsWriteLabel(0, 13, 'ID / Username');
		$this->xlsWriteLabel(0, 14, 'Fans');
		
		$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 13){
			$this->db->where(array("text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, 'https://www.facebook.com/'.$list->post_id); //$list->permalink
				$this->xlsWriteLabel($i, 1, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 2, date('Y', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, date('Y-m-d', strtotime($list->post_time))); //d/m/Y
				$this->xlsWriteLabel($i, 4, date('H', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 5, $list->type);
				$this->xlsWriteLabel($i, 6, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				$this->xlsWriteNumber($i, 7, $list->likes_count);
				$this->xlsWriteNumber($i, 8, $list->comment_count);
				$this->xlsWriteNumber($i, 9, $list->share_count);
				$this->xlsWriteNumber($i, 10, ($list->likes_count + $list->comment_count + $list->share_count));
				$this->xlsWriteNumber($i, 11, $list->est_impression);
				$this->xlsWriteLabel($i, 12, $user->name);
				$this->xlsWriteLabel($i, 13, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 14, $user->follower);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_feed_resume($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_feed_resume_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Month');
		$this->xlsWriteLabel(0, 1, 'Year');
		$this->xlsWriteLabel(0, 2, 'Date');
		$this->xlsWriteLabel(0, 3, 'Post');
		$this->xlsWriteLabel(0, 4, 'Likes');
		$this->xlsWriteLabel(0, 5, 'Comment');
		$this->xlsWriteLabel(0, 6, 'Share');
		$this->xlsWriteLabel(0, 7, 'Total Feedback');
		$this->xlsWriteLabel(0, 8, 'Est.Impression');
		/*$this->xlsWriteLabel(0, 9, 'Name');
		$this->xlsWriteLabel(0, 10, 'ID / Username');
		$this->xlsWriteLabel(0, 11, 'Fans');*/
		
		//$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 13){
			$this->db->where(array("text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select("DATE_FORMAT(post_time, '%Y-%m-%d') AS date, COUNT(1) AS post, SUM(likes_count) AS likes, SUM(comment_count) AS comment, SUM(share_count) AS share, SUM(est_impression) AS impression")->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->group_by("DATE_FORMAT(post_time, '%Y-%m-%d')")->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, date('F', strtotime($list->date)));
				$this->xlsWriteLabel($i, 1, date('Y', strtotime($list->date)));
				$this->xlsWriteLabel($i, 2, date('Y-m-d', strtotime($list->date)));
				$this->xlsWriteNumber($i, 3, $list->post);
				$this->xlsWriteNumber($i, 4, $list->likes);
				$this->xlsWriteNumber($i, 5, $list->comment);
				$this->xlsWriteNumber($i, 6, $list->share);
				$this->xlsWriteNumber($i, 7, ($list->likes + $list->comment + $list->share));
				$this->xlsWriteNumber($i, 8, $list->impression);
				/*$this->xlsWriteLabel($i, 9, $user->name);
				$this->xlsWriteLabel($i, 10, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 11, $user->follower);*/
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_visitor($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_visitor_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Permalink');
		$this->xlsWriteLabel(0, 1, 'Month');
		$this->xlsWriteLabel(0, 2, 'Year');
		$this->xlsWriteLabel(0, 3, 'Date');
		$this->xlsWriteLabel(0, 4, 'Hour');
		$this->xlsWriteLabel(0, 5, 'Type');
		$this->xlsWriteLabel(0, 6, 'Text');
		$this->xlsWriteLabel(0, 7, 'Likes');
		$this->xlsWriteLabel(0, 8, 'Comment');
		$this->xlsWriteLabel(0, 9, 'Share');
		$this->xlsWriteLabel(0, 10, 'Total Feedback');
		$this->xlsWriteLabel(0, 11, 'Est.Impression');
		$this->xlsWriteLabel(0, 12, 'User Name');
		$this->xlsWriteLabel(0, 13, 'User Profile');
		//$this->xlsWriteLabel(0, 14, 'Friend');
		
		/*if($account_id == 13){
			$this->db->where(array("a.text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select('a.*, b.socmed_id, b.name, b.username, b.follower')->from('feed_visitor a')->join('user b', 'a.user_id=b.user_id')->where(array('a.account_id' => $account_id, "DATE_FORMAT(a.post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('a.post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->permalink);
				$this->xlsWriteLabel($i, 1, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 2, date('Y', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, date('Y-m-d', strtotime($list->post_time))); //d/m/Y
				$this->xlsWriteLabel($i, 4, date('H', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 5, $list->type);
				$this->xlsWriteLabel($i, 6, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				$this->xlsWriteNumber($i, 7, $list->likes_count);
				$this->xlsWriteNumber($i, 8, $list->comment_count);
				$this->xlsWriteNumber($i, 9, $list->share_count);
				$this->xlsWriteNumber($i, 10, ($list->likes_count + $list->comment_count + $list->share_count));
				$this->xlsWriteNumber($i, 11, $list->est_impression);
				$this->xlsWriteLabel($i, 12, $list->name);
				$this->xlsWriteLabel($i, 13, 'https://facebook.com/'.($list->username ? $list->username : $list->socmed_id));
				//$this->xlsWriteNumber($i, 14, $list->follower);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_comment($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_comment_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Post ID');
		$this->xlsWriteLabel(0, 1, 'Post Date');
		$this->xlsWriteLabel(0, 2, 'Post Month');
		$this->xlsWriteLabel(0, 3, 'Post Link');
		$this->xlsWriteLabel(0, 4, 'Post Text');
		$this->xlsWriteLabel(0, 5, 'Comment ID');
		$this->xlsWriteLabel(0, 6, 'Comment Date');
		$this->xlsWriteLabel(0, 7, 'Comment Month');
		$this->xlsWriteLabel(0, 8, 'User Profile');
		$this->xlsWriteLabel(0, 9, 'Name');
		$this->xlsWriteLabel(0, 10, 'Comment');
		//$this->xlsWriteLabel(0, 11, 'ID New');
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("b.text LIKE '%#PesonaIndonesia%' AND b.text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 13){
			$this->db->where(array("b.text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select('a.comment_id, a.created_time, a.text, b.post_id, b.post_time, b.text AS post, c.socmed_id, c.name, c.username')->from('comment a')->join('feed b', 'a.feed_id=b.feed_id')->join('user c', 'a.user_id=c.user_id')->where(array('b.account_id' => $account_id, "DATE_FORMAT(b.post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('b.post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->post_id);
				$this->xlsWriteLabel($i, 1, $list->post_time);
				$this->xlsWriteLabel($i, 2, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, 'http://facebook.com/'.$list->post_id);
				$this->xlsWriteLabel($i, 4, ((strlen($list->post) > 255) ? substr($list->post, 0, 252).'...' : $list->post));
				$this->xlsWriteLabel($i, 5, $list->comment_id);
				$this->xlsWriteLabel($i, 6, $list->created_time);
				$this->xlsWriteLabel($i, 7, date('F', strtotime($list->created_time)));
				$this->xlsWriteLabel($i, 8, 'https://facebook.com/'.($list->username ? $list->username : $list->socmed_id));
				$this->xlsWriteLabel($i, 9, $list->name);
				$this->xlsWriteLabel($i, 10, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				
				//$xx = explode('_', $list->comment_id);
				//$this->xlsWriteLabel($i, 11, $list->post_id.'_'.$xx[1]);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_users($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_users_'.$account_id.'_('.date('M-Y', strtotime($period[0])).')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'UserID');
		$this->xlsWriteLabel(0, 1, 'Full Name');
		$this->xlsWriteLabel(0, 2, 'Username');
		$this->xlsWriteLabel(0, 3, 'Friends');
		$this->xlsWriteLabel(0, 4, 'Activity');
		
		$session = date('Y-m', strtotime($period[0]));
		$rawdata = 'rawdata/'.$session.'/'.$account_id.'/most_active-raw.json';
		if(file_exists($rawdata)){
			$data = file_get_contents($rawdata);
			if($json = json_decode($data)){
				$i = 1;
				foreach($json as $list){
					$this->xlsWriteLabel($i, 0, $list->s);
					$this->xlsWriteLabel($i, 1, $list->n);
					$this->xlsWriteLabel($i, 2, $list->u);
					$this->xlsWriteNumber($i, 3, $list->f);
					$this->xlsWriteNumber($i, 4, $list->t);
					$i++;
				}
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_primetime($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_primetime_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Hours');
		$this->xlsWriteLabel(0, 1, 'Total Post');
		
		$this->load->model('report_facebook');
		if($Qlist = $this->report_facebook->primetime($account_id, 'HourComment', $date)){
			$i = 1;
			foreach($Qlist as $list){
				$this->xlsWriteLabel($i, 0, $list->hour);
				$this->xlsWriteNumber($i, 1, $list->total);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_growth($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_growth_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Date');
		$this->xlsWriteLabel(0, 1, 'Fans');
		$this->xlsWriteLabel(0, 2, 'Growth');
		
		$Qlist = $this->db->from('follower')->where(array('account_id' => $account_id, "DATE_FORMAT(created_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('created_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			
			$Qprev = $this->db->from('follower')->where(array('account_id' => $account_id, "DATE_FORMAT(created_time, '%Y-%m-%d')=" => date('Y-m-d', strtotime("-1 days", strtotime($period[0])))))->get();
			if($Qprev->num_rows()){
				$prev = $Qprev->row()->count;
			}
			else $prev = 0;
			
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->created_time);
				$this->xlsWriteNumber($i, 1, $list->count);
				$this->xlsWriteNumber($i, 2, $list->count - $prev);
				$prev = $list->count;
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_master($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('facebook_master_'.$account_id.'_('.date('M-Y', strtotime($period[0])).')');
		
		$session = date('Y-m', strtotime($period[0]));
		$competitor = $this->competitor($account_id);
		$this->load->model('report_facebook');
		
		$this->xlsBOF();
		$title = array('ID', 'Fans', 'Growth (#)', 'Growth (%)', 'Fans Active', 'Friends from Active Fans', 'Photo (Post)', 'Link (Post)', 'Video (Post)', 'Text (Post)', 'Others (Post)', 'Wallpost', 'Photo (Like)', 'Link (Like)', 'Video (Like)', 'Text (Like)', 'Others (Like)', 'Like Status', 'Photo (Comment)', 'Link (Comment)', 'Video (Comment)', 'Text (Comment)', 'Others (Comment)', 'Comment', 'Photo (Share)', 'Link (Share)', 'Video (Share)', 'Text (Share)', 'Others (Share)', 'Share', 'Feedback', 'Impression');
		
		for($i=0; $i < count($title); $i++){
			$this->xlsWriteLabel(0, $i, $title[$i]);
		}
		
		$Qlist = $this->db->query("
			SELECT a.`account_id`, a.`name`, a.`username`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '$session' ORDER BY `created_time` DESC LIMIT 1) AS `followers`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '".date('Y-m', strtotime("-1 month", strtotime($session.'-01')))."' ORDER BY `created_time` DESC LIMIT 1) AS `followers_last`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session') AS `posts`
			FROM `account` a
			WHERE a.`account_id` IN($competitor)
		");
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$growth = ($list->followers - $list->followers_last);
				
				$photo_post = 0;
				$link_post = 0;
				$video_post = 0;
				$text_post = 0;
				$others_post = 0;
				
				$photo_like = 0;
				$link_like = 0;
				$video_like = 0;
				$text_like = 0;
				$others_like = 0;
				
				$photo_comment = 0;
				$link_comment = 0;
				$video_comment = 0;
				$text_comment = 0;
				$others_comment = 0;
				
				$photo_share = 0;
				$link_share = 0;
				$video_share = 0;
				$text_share = 0;
				$others_share = 0;
				
				$feeds = "'0'";
				$Qfeed = $this->db->from('feed')->where(array('account_id' => $list->account_id, "DATE_FORMAT(post_time, '%Y-%m') =" => $session))->get();
				if($Qfeed->num_rows()){
					foreach($Qfeed->result() as $feed){
						$feeds .= ",'$feed->feed_id'";
						
						switch($feed->type){
							case 'photo':
								$photo_like = $photo_like + $feed->likes_count;
								$photo_comment = $photo_comment + $feed->comment_count;
								$photo_share = $photo_share + $feed->share_count;
								$photo_post++;
								continue;
								
							case 'link':
								$link_like = $link_like + $feed->likes_count;
								$link_comment = $link_comment + $feed->comment_count;
								$link_share = $link_share + $feed->share_count;
								$link_post++;
								continue;
								
							case 'video':
								$video_like = $video_like + $feed->likes_count;
								$video_comment = $video_comment + $feed->comment_count;
								$video_share = $video_share + $feed->share_count;
								$video_post++;
								continue;
								
							case 'status':
								$text_like = $text_like + $feed->likes_count;
								$text_comment = $text_comment + $feed->comment_count;
								$text_share = $text_share + $feed->share_count;
								$text_post++;
								continue;
								
							default:
								$others_like = $others_like + $feed->likes_count;
								$others_comment = $others_comment + $feed->comment_count;
								$others_share = $others_share + $feed->share_count;
								$others_post++;
								continue;
						}
					}
				}
				
				$impression = $this->report_facebook->highlight($list->account_id, 'impression', $date);
				$user_active = $this->report_facebook->users($list->account_id, 'MostActiveCount', $date);
				
				$this->xlsWriteLabel($i, 0, $list->name.' (/'.$list->username.')'); //ID
				$this->xlsWriteNumber($i, 1, $list->followers); //Fans
				$this->xlsWriteNumber($i, 2, $growth); //Growth (#)
				$this->xlsWriteLabel($i, 3, number_format(($growth / ($list->followers_last ? $list->followers_last : 1)) * 100, 3).'%'); //Growth (%)
				$this->xlsWriteNumber($i, 4, $user_active); //Fans Active
				$this->xlsWriteNumber($i, 5, $impression); //Fans from Active Fans
				$this->xlsWriteNumber($i, 6, $photo_post); //Photo (Post)
				$this->xlsWriteNumber($i, 7, $link_post); //Link (Post)
				$this->xlsWriteNumber($i, 8, $video_post); //Video (Post)
				$this->xlsWriteNumber($i, 9, $text_post); //Text (Post)
				$this->xlsWriteNumber($i, 10, $others_post); //Others (Post)
				$this->xlsWriteNumber($i, 11, ($photo_post + $link_post + $video_post + $text_post + $others_post)); //Wallpost
				$this->xlsWriteNumber($i, 12, $photo_like); //Photo (Like)
				$this->xlsWriteNumber($i, 13, $link_like); //Link (Like)
				$this->xlsWriteNumber($i, 14, $video_like); //Video (Like)
				$this->xlsWriteNumber($i, 15, $text_like); //Text (Like)
				$this->xlsWriteNumber($i, 16, $others_like); //Others (Like)
				$this->xlsWriteNumber($i, 17, ($photo_like + $link_like + $video_like + $text_like + $others_like)); //Like Status
				$this->xlsWriteNumber($i, 18, $photo_comment); //Photo (Comment)
				$this->xlsWriteNumber($i, 19, $link_comment); //Link (Comment)
				$this->xlsWriteNumber($i, 20, $video_comment); //Video (Comment)
				$this->xlsWriteNumber($i, 21, $text_comment); //Text (Comment)
				$this->xlsWriteNumber($i, 22, $others_comment); //Others (Comment)
				$this->xlsWriteNumber($i, 23, ($photo_comment + $link_comment + $video_comment + $text_comment + $others_comment)); //Comment
				$this->xlsWriteNumber($i, 24, $photo_share); //Photo (Comment)
				$this->xlsWriteNumber($i, 25, $link_share); //Link (Comment)
				$this->xlsWriteNumber($i, 26, $video_share); //Video (Comment)
				$this->xlsWriteNumber($i, 27, $text_share); //Text (Comment)
				$this->xlsWriteNumber($i, 28, $others_share); //Others (Comment)
				$this->xlsWriteNumber($i, 29, ($photo_share + $link_share + $video_share + $text_share + $others_share)); //Share
				$this->xlsWriteNumber($i, 30, (($photo_like + $link_like + $video_like + $text_like + $others_like) + ($photo_comment + $link_comment + $video_comment + $text_comment + $others_comment) + ($photo_share + $link_share + $video_share + $text_share + $others_share))); //Feedback
				$this->xlsWriteNumber($i, 31, $impression + $user_active); //Impression + user active
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function facebook_benchmark($ts)
	{
		$this->headers('facebook_benchmark_('.date('M-Y', $ts).')');
		
		$session = date('Y-m', $ts);
		$date = formatmonth($ts, strtotime($session.'-'.date('t', $ts)));
		
		$competitor = $this->competitor('facebook');
		$this->load->model('report_facebook');
		
		$this->xlsBOF();
		$title = array('Category', 'ID', 'Fans', 'Growth (#)', 'Growth (%)', 'Fans Active', 'Friends from Active Fans', 'Photo (Post)', 'Link (Post)', 'Video (Post)', 'Text (Post)', 'Wallpost', 'Photo (Like)', 'Link (Like)', 'Video (Like)', 'Text (Like)', 'Like Status', 'Photo (Comment)', 'Link (Comment)', 'Video (Comment)', 'Text (Comment)', 'Comment', 'Photo (Share)', 'Link (Share)', 'Video (Share)', 'Text (Share)', 'Share', 'Feedback', 'Impression', 'account_id');
		
		for($i=0; $i < count($title); $i++){
			$this->xlsWriteLabel(0, $i, $title[$i]);
		}
		
		$Qlist = $this->db->query("
			SELECT a.`account_id`, a.`category`, a.`name`, a.`username`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '$session' ORDER BY `created_time` DESC LIMIT 1) AS `followers`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '".date('Y-m', strtotime("-1 month", strtotime($session.'-01')))."' ORDER BY `created_time` DESC LIMIT 1) AS `followers_last`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session') AS `posts`
			FROM `account` a
			WHERE a.`account_id` IN($competitor)
		");
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$growth = ($list->followers - $list->followers_last);
				
				$photo_post = 0;
				$link_post = 0;
				$video_post = 0;
				$text_post = 0;
				
				$photo_like = 0;
				$link_like = 0;
				$video_like = 0;
				$text_like = 0;
				
				$photo_comment = 0;
				$link_comment = 0;
				$video_comment = 0;
				$text_comment = 0;
				
				$photo_share = 0;
				$link_share = 0;
				$video_share = 0;
				$text_share = 0;
				
				$feeds = "'0'";
				$Qfeed = $this->db->from('feed')->where(array('account_id' => $list->account_id, "DATE_FORMAT(post_time, '%Y-%m') =" => $session))->get();
				if($Qfeed->num_rows()){
					foreach($Qfeed->result() as $feed){
						$feeds .= ",'$feed->feed_id'";
						
						switch($feed->type){
							case 'photo':
								$photo_like = $photo_like + $feed->likes_count;
								$photo_comment = $photo_comment + $feed->comment_count;
								$photo_share = $photo_share + $feed->share_count;
								$photo_post++;
								continue;
								
							case 'link':
								$link_like = $link_like + $feed->likes_count;
								$link_comment = $link_comment + $feed->comment_count;
								$link_share = $link_share + $feed->share_count;
								$link_post++;
								continue;
								
							case 'video':
								$video_like = $video_like + $feed->likes_count;
								$video_comment = $video_comment + $feed->comment_count;
								$video_share = $video_share + $feed->share_count;
								$video_post++;
								continue;
								
							case 'status':
								$text_like = $text_like + $feed->likes_count;
								$text_comment = $text_comment + $feed->comment_count;
								$text_share = $text_share + $feed->share_count;
								$text_post++;
								continue;
						}
					}
				}
				
				$impression = $this->report_facebook->highlight($list->account_id, 'impression', $date);
				$user_active = $this->report_facebook->users($list->account_id, 'MostActiveCount', $date);
				
				$this->xlsWriteLabel($i, 0, strtoupper($list->category)); //Category
				$this->xlsWriteLabel($i, 1, $list->name.' (/'.$list->username.')'); //ID
				$this->xlsWriteNumber($i, 2, $list->followers); //Fans
				$this->xlsWriteNumber($i, 3, $growth); //Growth (#)
				$this->xlsWriteLabel($i, 4, number_format(($growth / ($list->followers_last ? $list->followers_last : 1)) * 100, 3).'%'); //Growth (%)
				$this->xlsWriteNumber($i, 5, $user_active); //Fans Active
				$this->xlsWriteNumber($i, 6, $impression); //Fans from Active Fans
				$this->xlsWriteNumber($i, 7, $photo_post); //Photo (Post)
				$this->xlsWriteNumber($i, 8, $link_post); //Link (Post)
				$this->xlsWriteNumber($i, 9, $video_post); //Video (Post)
				$this->xlsWriteNumber($i, 10, $text_post); //Text (Post)
				$this->xlsWriteNumber($i, 11, ($photo_post + $link_post + $video_post + $text_post)); //Wallpost
				$this->xlsWriteNumber($i, 12, $photo_like); //Photo (Like)
				$this->xlsWriteNumber($i, 13, $link_like); //Link (Like)
				$this->xlsWriteNumber($i, 14, $video_like); //Video (Like)
				$this->xlsWriteNumber($i, 15, $text_like); //Text (Like)
				$this->xlsWriteNumber($i, 16, ($photo_like + $link_like + $video_like + $text_like)); //Like Status
				$this->xlsWriteNumber($i, 17, $photo_comment); //Photo (Comment)
				$this->xlsWriteNumber($i, 18, $link_comment); //Link (Comment)
				$this->xlsWriteNumber($i, 19, $video_comment); //Video (Comment)
				$this->xlsWriteNumber($i, 20, $text_comment); //Text (Comment)
				$this->xlsWriteNumber($i, 21, ($photo_comment + $link_comment + $video_comment + $text_comment)); //Comment
				$this->xlsWriteNumber($i, 22, $photo_share); //Photo (Comment)
				$this->xlsWriteNumber($i, 23, $link_share); //Link (Comment)
				$this->xlsWriteNumber($i, 24, $video_share); //Video (Comment)
				$this->xlsWriteNumber($i, 25, $text_share); //Text (Comment)
				$this->xlsWriteNumber($i, 26, ($photo_share + $link_share + $video_share + $text_share)); //Share
				$this->xlsWriteNumber($i, 27, (($photo_like + $link_like + $video_like + $text_like) + ($photo_comment + $link_comment + $video_comment + $text_comment) + ($photo_share + $link_share + $video_share + $text_share))); //Feedback
				$this->xlsWriteNumber($i, 28, $impression + $user_active); //Impression + user active
				$this->xlsWriteNumber($i, 29, $list->account_id);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_feed($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_feed_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Permalink');
		$this->xlsWriteLabel(0, 1, 'Month');
		$this->xlsWriteLabel(0, 2, 'Year');
		$this->xlsWriteLabel(0, 3, 'Date');
		$this->xlsWriteLabel(0, 4, 'Hour');
		$this->xlsWriteLabel(0, 5, 'Type');
		$this->xlsWriteLabel(0, 6, 'Text');
		$this->xlsWriteLabel(0, 7, 'Favourites');
		$this->xlsWriteLabel(0, 8, 'Replies');
		$this->xlsWriteLabel(0, 9, 'Retweets');
		$this->xlsWriteLabel(0, 10, 'Total Feedback');
		$this->xlsWriteLabel(0, 11, 'Est.Impression');
		$this->xlsWriteLabel(0, 12, 'Name');
		$this->xlsWriteLabel(0, 13, 'ID / Username');
		$this->xlsWriteLabel(0, 14, 'Followers');
		
		$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 97){
			$this->db->where(array("text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL, "share_from IS NULL" => NULL))->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->permalink);
				$this->xlsWriteLabel($i, 1, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 2, date('Y', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, date('Y-m-d', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 4, date('H', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 5, $list->type);
				$this->xlsWriteLabel($i, 6, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				$this->xlsWriteNumber($i, 7, $list->likes_count);
				$this->xlsWriteNumber($i, 8, $this->db->from('mention')->where(array('feed_id' => $list->feed_id))->get()->num_rows());
				$this->xlsWriteNumber($i, 9, $list->share_count);
				$this->xlsWriteNumber($i, 10, ($list->likes_count + $list->comment_count + $list->share_count));
				$this->xlsWriteNumber($i, 11, $list->est_impression);
				$this->xlsWriteLabel($i, 12, $user->name);
				$this->xlsWriteLabel($i, 13, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 14, $user->follower);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_feed_resume($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_feed_resume_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Month');
		$this->xlsWriteLabel(0, 1, 'Year');
		$this->xlsWriteLabel(0, 2, 'Date');
		$this->xlsWriteLabel(0, 3, 'Post');
		$this->xlsWriteLabel(0, 4, 'Favourites');
		$this->xlsWriteLabel(0, 5, 'Replies');
		$this->xlsWriteLabel(0, 6, 'Retweets');
		$this->xlsWriteLabel(0, 7, 'Total Feedback');
		$this->xlsWriteLabel(0, 8, 'Est.Impression');
		/*$this->xlsWriteLabel(0, 9, 'Name');
		$this->xlsWriteLabel(0, 10, 'ID / Username');
		$this->xlsWriteLabel(0, 11, 'Followers');*/
		
		//$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 97){
			$this->db->where(array("text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select("DATE_FORMAT(post_time, '%Y-%m-%d') AS date, COUNT(1) AS post, SUM(likes_count) AS likes, SUM(share_count) AS share, SUM(est_impression) AS impression")->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL, "share_from IS NULL" => NULL))->group_by("DATE_FORMAT(post_time, '%Y-%m-%d')")->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$comment_count = $this->db->query("SELECT 1 FROM mention WHERE feed_id IN(SELECT feed_id FROM feed WHERE account_id=$account_id AND DATE_FORMAT(post_time, '%Y-%m-%d')='$list->date')")->num_rows();
				$this->xlsWriteLabel($i, 0, date('F', strtotime($list->date)));
				$this->xlsWriteLabel($i, 1, date('Y', strtotime($list->date)));
				$this->xlsWriteLabel($i, 2, date('Y-m-d', strtotime($list->date)));
				$this->xlsWriteNumber($i, 3, $list->post);
				$this->xlsWriteNumber($i, 4, $list->likes);
				$this->xlsWriteNumber($i, 5, $comment_count);
				$this->xlsWriteNumber($i, 6, $list->share);
				$this->xlsWriteNumber($i, 7, ($list->likes + $comment_count + $list->share));
				$this->xlsWriteNumber($i, 8, $list->impression);
				/*$this->xlsWriteLabel($i, 9, $user->name);
				$this->xlsWriteLabel($i, 10, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 11, $user->follower);*/
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_comment($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_comment_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Post ID');
		$this->xlsWriteLabel(0, 1, 'Post Date');
		$this->xlsWriteLabel(0, 2, 'Post Month');
		$this->xlsWriteLabel(0, 3, 'Post Link');
		$this->xlsWriteLabel(0, 4, 'Post Text');
		$this->xlsWriteLabel(0, 5, 'Comment ID');
		$this->xlsWriteLabel(0, 6, 'Comment Date');
		$this->xlsWriteLabel(0, 7, 'Comment Month');
		$this->xlsWriteLabel(0, 8, 'User Profile');
		$this->xlsWriteLabel(0, 9, 'Name');
		$this->xlsWriteLabel(0, 10, 'Comment');
		//$this->xlsWriteLabel(0, 11, 'ID New');
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("b.text LIKE '%#PesonaIndonesia%' AND b.text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 13){
			$this->db->where(array("b.text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select('a.mention_id, a.post_time AS created_time, a.text, b.post_id, b.post_time, b.permalink, b.text AS post, c.socmed_id, c.name, c.username')->from('mention a')->join('feed b', 'a.feed_id=b.feed_id')->join('user c', 'a.user_id=c.user_id')->where(array('b.account_id' => $account_id, "DATE_FORMAT(b.post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('b.post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->post_id);
				$this->xlsWriteLabel($i, 1, $list->post_time);
				$this->xlsWriteLabel($i, 2, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, $list->permalink);
				$this->xlsWriteLabel($i, 4, ((strlen($list->post) > 255) ? substr($list->post, 0, 252).'...' : $list->post));
				$this->xlsWriteLabel($i, 5, $list->mention_id);
				$this->xlsWriteLabel($i, 6, $list->created_time);
				$this->xlsWriteLabel($i, 7, date('F', strtotime($list->created_time)));
				$this->xlsWriteLabel($i, 8, ($list->username ? 'https://twitter.com/'.$list->username : 'https://twitter.com/intent/user?user_id='.$list->socmed_id));
				$this->xlsWriteLabel($i, 9, $list->name);
				$this->xlsWriteLabel($i, 10, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				
				//$xx = explode('_', $list->comment_id);
				//$this->xlsWriteLabel($i, 11, $list->post_id.'_'.$xx[1]);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_users($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_users_'.$account_id.'_('.date('M-Y', strtotime($period[0])).')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'UserID');
		$this->xlsWriteLabel(0, 1, 'Full Name');
		$this->xlsWriteLabel(0, 2, 'Username');
		$this->xlsWriteLabel(0, 3, 'Followers');
		$this->xlsWriteLabel(0, 4, 'Activity');
		
		$session = date('Y-m', strtotime($period[0]));
		$rawdata = 'rawdata/'.$session.'/'.$account_id.'/most_active-raw.json';
		if(file_exists($rawdata)){
			$data = file_get_contents($rawdata);
			if($json = json_decode($data)){
				$i = 1;
				foreach($json as $list){
					$this->xlsWriteLabel($i, 0, $list->s);
					$this->xlsWriteLabel($i, 1, $list->n);
					$this->xlsWriteLabel($i, 2, '@'.$list->u);
					$this->xlsWriteNumber($i, 3, $list->f);
					$this->xlsWriteNumber($i, 4, $list->t);
					$i++;
				}
			}
			
		}else{
			
			if(in_array($account_id, exc_account('n3o'), true)){
				$this->load->model('report_twitter');
				$feeds = $this->report_twitter->primetime($account_id, 'FeedIds', $date);
				$Qlist = $this->db->query("
					SELECT SUM(x.`activity`) AS `t`, x.`user_id`, b.`socmed_id` AS `s`, b.`username` AS `u`, b.`name` AS `n`, b.`follower` AS `f` FROM (
						SELECT COUNT(1) AS `activity`, `user_id` FROM `comment` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
						UNION ALL
						SELECT COUNT(1) AS `activity`, `user_id` FROM `likes` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
						UNION ALL
						SELECT COUNT(1) AS `activity`, `user_id` FROM `share` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
					) AS x
					JOIN `user` b ON x.`user_id`=b.`user_id`
					GROUP BY b.`socmed_id`
					ORDER BY `t` DESC
				");
				if($Qlist->num_rows()){
					$i = 1;
					foreach($Qlist->result() as $list){
						$this->xlsWriteLabel($i, 0, $list->s);
						$this->xlsWriteLabel($i, 1, $list->n);
						$this->xlsWriteLabel($i, 2, '@'.$list->u);
						$this->xlsWriteNumber($i, 3, $list->f);
						$this->xlsWriteNumber($i, 4, $list->t);
						$i++;
					}
				}
				else return NULL;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_primetime($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_primetime_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Hours');
		$this->xlsWriteLabel(0, 1, 'Total Post');
		
		$this->load->model('report_twitter');
		if($Qlist = $this->report_twitter->primetime($account_id, 'HourComment', $date)){
			$i = 1;
			foreach($Qlist as $list){
				$this->xlsWriteLabel($i, 0, $list->hour);
				$this->xlsWriteNumber($i, 1, $list->total);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_growth($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_growth_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Date');
		$this->xlsWriteLabel(0, 1, 'Followers');
		$this->xlsWriteLabel(0, 2, 'Growth');
		
		$Qlist = $this->db->from('follower')->where(array('account_id' => $account_id, "DATE_FORMAT(created_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('created_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			
			$Qprev = $this->db->from('follower')->where(array('account_id' => $account_id, "DATE_FORMAT(created_time, '%Y-%m-%d')=" => date('Y-m-d', strtotime("-1 days", strtotime($period[0])))))->get();
			if($Qprev->num_rows()){
				$prev = $Qprev->row()->count;
			}
			else $prev = 0;
			
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->created_time);
				$this->xlsWriteNumber($i, 1, $list->count);
				$this->xlsWriteNumber($i, 2, $list->count - $prev);
				$prev = $list->count;
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_master($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('twitter_master_'.$account_id.'_('.date('M-Y', strtotime($period[0])).')');
		
		$session = date('Y-m', strtotime($period[0]));
		$competitor = $this->competitor($account_id);
		$this->load->model('report_twitter');
		
		$this->xlsBOF();
		$title = array('ID', 'Followers', 'Growth (#)', 'Growth (%)', 'Follower Active', 'Followers from Active Followers', 'Status (From Admin)', 'Reply & Mention (From Admin)', 'RT (From Admin)', 'Total (From Admin)', 'Reply & Mention (To Admin)', 'RT (To Admin)', 'Favourite (To Admin)', 'Feedback (To Admin)', 'Impression', 'Feedback Rate', 'Feedback Ratio', 'Engagement Ratio', 'Avg. Stories/ Post', 'Market Penetration');
		
		for($i=0; $i < count($title); $i++){
			$this->xlsWriteLabel(0, $i, $title[$i]);
		}
		
		$Qlist = $this->db->query("
			SELECT a.`account_id`, a.`name`, a.`username`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '$session' ORDER BY `created_time` DESC LIMIT 1) AS `followers`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '".date('Y-m', strtotime("-1 month", strtotime($session.'-01')))."' ORDER BY `created_time` DESC LIMIT 1) AS `followers_last`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NULL) AS `posts`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from`='1') AS `posts_mention`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NOT NULL AND `share_from` <> '1') AS `posts_rt`,
				(SELECT SUM(`share_count`) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NULL) AS `followers_rt`,
				(SELECT SUM(`likes_count`) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NULL) AS `followers_likes`
			FROM `account` a
			WHERE a.`account_id` IN($competitor)
		");
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$growth = ($list->followers - $list->followers_last);
				$reply_mention = $this->db->from('mention')->where(array('account_id' => $list->account_id, "DATE_FORMAT(post_time, '%Y-%m') =" => $session))->get()->num_rows();
				$user_active = $this->report_twitter->users($list->account_id, 'MostActiveCount', $date);
				
				$feedback = ($list->followers_rt + $list->followers_likes + $reply_mention);
				$impression = $this->report_twitter->highlight($list->account_id, 'impression', $date);
				$impressions = $impression + $list->followers;
				
				$this->xlsWriteLabel($i, 0, $list->name.' (@'.$list->username.')'); //ID
				$this->xlsWriteNumber($i, 1, $list->followers); //Followers
				$this->xlsWriteNumber($i, 2, $growth); //Growth (#)
				$this->xlsWriteLabel($i, 3, number_format(($growth / ($list->followers_last ? $list->followers_last : 1)) * 100, 3).'%'); //Growth (%)
				$this->xlsWriteNumber($i, 4, $user_active); //Follower Active
				$this->xlsWriteNumber($i, 5, $impression); //Followers from active followers
				$this->xlsWriteNumber($i, 6, $list->posts); //Status (From Admin)
				$this->xlsWriteNumber($i, 7, $list->posts_mention); //Reply & Mention (From Admin)
				$this->xlsWriteNumber($i, 8, $list->posts_rt); //RT (From Admin)
				$this->xlsWriteNumber($i, 9, ($list->posts + $list->posts_mention + $list->posts_rt)); //Total (From Admin)
				$this->xlsWriteNumber($i, 10, $reply_mention); //Reply & Mention (To Admin)
				$this->xlsWriteNumber($i, 11, $list->followers_rt); //RT (To Admin)
				$this->xlsWriteNumber($i, 12, $list->followers_likes); //Likes (To Admin)
				$this->xlsWriteNumber($i, 13, $feedback); //Feedback (To Admin)
				$this->xlsWriteNumber($i, 14, $impressions); //Impression + followers
				$this->xlsWriteLabel($i, 15, number_format($feedback / ($list->posts ? $list->posts : 1), 2)); //Feedback Rate
				$this->xlsWriteLabel($i, 16, number_format(($feedback / ($impressions ? $impressions : 1)) * 100, 3).'%'); //Feedback Ratio
				$this->xlsWriteLabel($i, 17, number_format(($user_active / $list->followers) * 100, 3).'%'); //Engagement Ratio
				$this->xlsWriteLabel($i, 18, number_format($feedback / ($list->posts ? $list->posts : 1), 2)); //Avg. Stories/ Post
				$this->xlsWriteLabel($i, 19, number_format(($growth / ($impressions ? $impressions : 1)) * 100, 3).'%'); //Market Penetration
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function twitter_benchmark($ts)
	{
		$this->headers('twitter_benchmark_('.date('M-Y', $ts).')');
		
		$session = date('Y-m', $ts);
		$date = formatmonth($ts, strtotime($session.'-'.date('t', $ts)));
		
		$competitor = $this->competitor('twitter');
		$this->load->model('report_twitter');
		
		$this->xlsBOF();
		$title = array('Category', 'ID', 'Followers', 'Growth (#)', 'Growth (%)', 'Follower Active', 'Followers from Active Followers', 'Status (From Admin)', 'Reply & Mention (From Admin)', 'RT (From Admin)', 'Total (From Admin)', 'Reply & Mention (To Admin)', 'RT (To Admin)', 'Favourite (To Admin)', 'Feedback (To Admin)', 'Impression', 'Feedback Rate', 'Feedback Ratio', 'Engagement Ratio', 'Avg. Stories/ Post', 'Market Penetration', 'account_id');
		
		for($i=0; $i < count($title); $i++){
			$this->xlsWriteLabel(0, $i, $title[$i]);
		}
		
		$Qlist = $this->db->query("
			SELECT a.`account_id`, a.`category`, a.`name`, a.`username`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '$session' ORDER BY `created_time` DESC LIMIT 1) AS `followers`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '".date('Y-m', strtotime("-1 month", strtotime($session.'-01')))."' ORDER BY `created_time` DESC LIMIT 1) AS `followers_last`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NULL) AS `posts`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from`='1') AS `posts_mention`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NOT NULL AND `share_from` <> '1') AS `posts_rt`,
				(SELECT SUM(`share_count`) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NULL) AS `followers_rt`,
				(SELECT SUM(`likes_count`) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session' AND `share_from` IS NULL) AS `followers_likes`
			FROM `account` a
			WHERE a.`account_id` IN($competitor)
		");
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$growth = ($list->followers - $list->followers_last);
				$reply_mention = $this->db->from('mention')->where(array('account_id' => $list->account_id, "DATE_FORMAT(post_time, '%Y-%m') =" => $session))->get()->num_rows();
				$user_active = $this->report_twitter->users($list->account_id, 'MostActiveCount', $date);
				
				$feedback = ($list->followers_rt + $list->followers_likes + $reply_mention);
				$impression = $this->report_twitter->highlight($list->account_id, 'impression', $date);
				$impressions = $impression + $list->followers;
				
				$this->xlsWriteLabel($i, 0, strtoupper($list->category)); //Category
				$this->xlsWriteLabel($i, 1, $list->name.' (@'.$list->username.')'); //ID
				$this->xlsWriteNumber($i, 2, $list->followers); //Followers
				$this->xlsWriteNumber($i, 3, $growth); //Growth (#)
				$this->xlsWriteLabel($i, 4, number_format(($growth / ($list->followers_last ? $list->followers_last : 1)) * 100, 3).'%'); //Growth (%)
				$this->xlsWriteNumber($i, 5, $user_active); //Follower Active
				$this->xlsWriteNumber($i, 6, $impression); //Followers from active followers
				$this->xlsWriteNumber($i, 7, $list->posts); //Status (From Admin)
				$this->xlsWriteNumber($i, 8, $list->posts_mention); //Reply & Mention (From Admin)
				$this->xlsWriteNumber($i, 9, $list->posts_rt); //RT (From Admin)
				$this->xlsWriteNumber($i, 10, ($list->posts + $list->posts_mention + $list->posts_rt)); //Total (From Admin)
				$this->xlsWriteNumber($i, 11, $reply_mention); //Reply & Mention (To Admin)
				$this->xlsWriteNumber($i, 12, $list->followers_rt); //RT (To Admin)
				$this->xlsWriteNumber($i, 13, $list->followers_likes); //Likes (To Admin)
				$this->xlsWriteNumber($i, 14, $feedback); //Feedback (To Admin)
				$this->xlsWriteNumber($i, 15, $impressions); //Impression + followers
				$this->xlsWriteLabel($i, 16, number_format($feedback / ($list->posts ? $list->posts : 1), 2)); //Feedback Rate
				$this->xlsWriteLabel($i, 17, number_format(($feedback / ($impressions ? $impressions : 1)) * 100, 3).'%'); //Feedback Ratio
				$this->xlsWriteLabel($i, 18, number_format(($user_active / $list->followers) * 100, 3).'%'); //Engagement Ratio
				$this->xlsWriteLabel($i, 19, number_format($feedback / ($list->posts ? $list->posts : 1), 2)); //Avg. Stories/ Post
				$this->xlsWriteLabel($i, 20, number_format(($growth / ($impressions ? $impressions : 1)) * 100, 3).'%'); //Market Penetration
				$this->xlsWriteNumber($i, 21, $list->account_id);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function instagram_feed($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_feed_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Permalink');
		$this->xlsWriteLabel(0, 1, 'Month');
		$this->xlsWriteLabel(0, 2, 'Year');
		$this->xlsWriteLabel(0, 3, 'Date');
		$this->xlsWriteLabel(0, 4, 'Hour');
		$this->xlsWriteLabel(0, 5, 'Type');
		$this->xlsWriteLabel(0, 6, 'Text');
		$this->xlsWriteLabel(0, 7, 'Likes');
		$this->xlsWriteLabel(0, 8, 'Comment');
		$this->xlsWriteLabel(0, 9, 'Total Feedback');
		$this->xlsWriteLabel(0, 10, 'Video View');
		$this->xlsWriteLabel(0, 11, 'Name');
		$this->xlsWriteLabel(0, 12, 'ID / Username');
		$this->xlsWriteLabel(0, 13, 'Followers');
		
		$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 1){
			$this->db->where(array("text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->permalink);
				$this->xlsWriteLabel($i, 1, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 2, date('Y', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, date('Y-m-d', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 4, date('H', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 5, $list->type);
				$this->xlsWriteLabel($i, 6, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				$this->xlsWriteNumber($i, 7, $list->likes_count);
				$this->xlsWriteNumber($i, 8, $list->comment_count);
				$this->xlsWriteNumber($i, 9, ($list->likes_count + $list->comment_count));
				$this->xlsWriteNumber($i, 10, $list->view_count);
				$this->xlsWriteLabel($i, 11, $user->name);
				$this->xlsWriteLabel($i, 12, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 13, $user->follower);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function instagram_feed_resume($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_feed_resume_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Month');
		$this->xlsWriteLabel(0, 1, 'Year');
		$this->xlsWriteLabel(0, 2, 'Date');
		$this->xlsWriteLabel(0, 3, 'Post');
		$this->xlsWriteLabel(0, 4, 'Likes');
		$this->xlsWriteLabel(0, 5, 'Comment');
		$this->xlsWriteLabel(0, 6, 'Total Feedback');
		/*$this->xlsWriteLabel(0, 7, 'Name');
		$this->xlsWriteLabel(0, 8, 'ID / Username');
		$this->xlsWriteLabel(0, 9, 'Followers');*/
		
		//$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 1){
			$this->db->where(array("text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select("DATE_FORMAT(post_time, '%Y-%m-%d') AS date, COUNT(1) AS post, SUM(likes_count) AS likes, SUM(comment_count) AS comment, SUM(share_count) AS share")->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->group_by("DATE_FORMAT(post_time, '%Y-%m-%d')")->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, date('F', strtotime($list->date)));
				$this->xlsWriteLabel($i, 1, date('Y', strtotime($list->date)));
				$this->xlsWriteLabel($i, 2, date('Y-m-d', strtotime($list->date)));
				$this->xlsWriteNumber($i, 3, $list->post);
				$this->xlsWriteNumber($i, 4, $list->likes);
				$this->xlsWriteNumber($i, 5, $list->comment);
				$this->xlsWriteNumber($i, 6, ($list->likes + $list->comment + $list->share));
				/*$this->xlsWriteLabel($i, 7, $user->name);
				$this->xlsWriteLabel($i, 8, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 9, $user->follower);*/
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function instagram_comment($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_comment_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Post ID');
		$this->xlsWriteLabel(0, 1, 'Post Date');
		$this->xlsWriteLabel(0, 2, 'Post Month');
		$this->xlsWriteLabel(0, 3, 'Post Link');
		$this->xlsWriteLabel(0, 4, 'Post Text');
		$this->xlsWriteLabel(0, 5, 'Comment ID');
		$this->xlsWriteLabel(0, 6, 'Comment Date');
		$this->xlsWriteLabel(0, 7, 'Comment Month');
		$this->xlsWriteLabel(0, 8, 'User Profile');
		$this->xlsWriteLabel(0, 9, 'Name');
		$this->xlsWriteLabel(0, 10, 'Comment');
		//$this->xlsWriteLabel(0, 11, 'ID New');
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("b.text LIKE '%#PesonaIndonesia%' AND b.text LIKE '%#ExploreNusantara%'" => NULL));
		}
		/*if($account_id == 13){
			$this->db->where(array("b.text LIKE '%#itusuksesku%'" => NULL));
		}*/
		$Qlist = $this->db->select('a.comment_id, a.created_time, a.text, b.post_id, b.post_time, b.text AS post, b.permalink, c.socmed_id, c.name, c.username')->from('comment a')->join('feed b', 'a.feed_id=b.feed_id')->join('user c', 'a.user_id=c.user_id')->where(array('b.account_id' => $account_id, "DATE_FORMAT(b.post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('b.post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->post_id);
				$this->xlsWriteLabel($i, 1, $list->post_time);
				$this->xlsWriteLabel($i, 2, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, $list->permalink);
				$this->xlsWriteLabel($i, 4, ((strlen($list->post) > 255) ? substr($list->post, 0, 252).'...' : $list->post));
				$this->xlsWriteLabel($i, 5, $list->comment_id);
				$this->xlsWriteLabel($i, 6, $list->created_time);
				$this->xlsWriteLabel($i, 7, date('F', strtotime($list->created_time)));
				$this->xlsWriteLabel($i, 8, 'https://www.instagram.com/'.($list->username ? $list->username : $list->socmed_id));
				$this->xlsWriteLabel($i, 9, $list->name);
				$this->xlsWriteLabel($i, 10, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				
				//$xx = explode('_', $list->comment_id);
				//$this->xlsWriteLabel($i, 11, $list->post_id.'_'.$xx[1]);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function instagram_users($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_users_'.$account_id.'_('.date('M-Y', strtotime($period[0])).')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'UserID');
		$this->xlsWriteLabel(0, 1, 'Full Name');
		$this->xlsWriteLabel(0, 2, 'Username');
		$this->xlsWriteLabel(0, 3, 'Followers');
		$this->xlsWriteLabel(0, 4, 'Activity');
		
		$session = date('Y-m', strtotime($period[0]));
		if(in_array($account_id, exc_account('n3o'), true)){
			$this->load->model('report_instagram');
			$feeds = $this->report_instagram->primetime($account_id, 'FeedIds', $date);
			$Qlist = $this->db->query("
				SELECT SUM(x.`activity`) AS `t`, x.`user_id`, b.`socmed_id` AS `s`, b.`username` AS `u`, b.`name` AS `n`, b.`follower` AS `f` FROM (
					SELECT COUNT(1) AS `activity`, `user_id` FROM `comment` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
					UNION ALL
					SELECT COUNT(1) AS `activity`, `user_id` FROM `likes` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
					UNION ALL
					SELECT COUNT(1) AS `activity`, `user_id` FROM `share` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
				) AS x
				JOIN `user` b ON x.`user_id`=b.`user_id`
				GROUP BY b.`socmed_id`
				ORDER BY `t` DESC
			");
			if($Qlist->num_rows()){
				$i = 1;
				foreach($Qlist->result() as $list){
					$this->xlsWriteLabel($i, 0, $list->s);
					$this->xlsWriteLabel($i, 1, $list->n);
					$this->xlsWriteLabel($i, 2, $list->u);
					$this->xlsWriteNumber($i, 3, $list->f);
					$this->xlsWriteNumber($i, 4, $list->t);
					$i++;
				}
			}
			else return NULL;
			
		}else{
			
			$Qlist = $this->db->select("a.activity_count AS t, b.socmed_id AS s, b.username AS u, b.name AS n, b.photo_profile AS p, IFNULL(b.city, b.location) AS l, IFNULL(a.follower, b.follower) AS f")->from('user_active a')->join('user b', 'a.user_id=b.user_id')->where(array('a.account_id'=> $account_id, "a.created_time" => "{$session}-01"))->order_by('a.activity_count', 'DESC')->get();
			if($Qlist->num_rows()){
				$i = 1;
				foreach($Qlist->result() as $list){
					$this->xlsWriteLabel($i, 0, $list->s);
					$this->xlsWriteLabel($i, 1, $list->n);
					$this->xlsWriteLabel($i, 2, $list->u);
					$this->xlsWriteNumber($i, 3, $list->f);
					$this->xlsWriteNumber($i, 4, $list->t);
					$i++;
				}
			}
			else return NULL;
		}
		/*$rawdata = 'rawdata/'.$session.'/'.$account_id.'/most_active-raw.json';
		if(file_exists($rawdata)){
			$data = file_get_contents($rawdata);
			if($json = json_decode($data)){
				$i = 1;
				foreach($json as $list){
					$this->xlsWriteLabel($i, 0, $list->s);
					$this->xlsWriteLabel($i, 1, $list->n);
					$this->xlsWriteLabel($i, 2, $list->u);
					$this->xlsWriteNumber($i, 3, $list->f);
					$this->xlsWriteNumber($i, 4, $list->t);
					$i++;
				}
			}
			
		}else{
			
			if(in_array($account_id, exc_account('n3o'), true)){
				$this->load->model('report_instagram');
				$feeds = $this->report_instagram->primetime($account_id, 'FeedIds', $date);
				$Qlist = $this->db->query("
					SELECT SUM(x.`activity`) AS `t`, x.`user_id`, b.`socmed_id` AS `s`, b.`username` AS `u`, b.`name` AS `n`, b.`follower` AS `f` FROM (
						SELECT COUNT(1) AS `activity`, `user_id` FROM `comment` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
						UNION ALL
						SELECT COUNT(1) AS `activity`, `user_id` FROM `likes` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
						UNION ALL
						SELECT COUNT(1) AS `activity`, `user_id` FROM `share` WHERE `feed_id` IN($feeds) GROUP BY `user_id`
					) AS x
					JOIN `user` b ON x.`user_id`=b.`user_id`
					GROUP BY b.`socmed_id`
					ORDER BY `t` DESC
				");
				if($Qlist->num_rows()){
					$i = 1;
					foreach($Qlist->result() as $list){
						$this->xlsWriteLabel($i, 0, $list->s);
						$this->xlsWriteLabel($i, 1, $list->n);
						$this->xlsWriteLabel($i, 2, $list->u);
						$this->xlsWriteNumber($i, 3, $list->f);
						$this->xlsWriteNumber($i, 4, $list->t);
						$i++;
					}
				}
				else return NULL;
			}
		}*/
		$this->xlsEOF();
	}
	
	function instagram_primetime($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_primetime_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Hours');
		$this->xlsWriteLabel(0, 1, 'Total Post');
		
		$this->load->model('report_instagram');
		if($Qlist = $this->report_instagram->primetime($account_id, 'HourComment', $date)){
			$i = 1;
			foreach($Qlist as $list){
				$this->xlsWriteLabel($i, 0, $list->hour);
				$this->xlsWriteNumber($i, 1, $list->total);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function instagram_growth($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_growth_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Date');
		$this->xlsWriteLabel(0, 1, 'Followers');
		$this->xlsWriteLabel(0, 2, 'Growth');
		
		$Qlist = $this->db->from('follower')->where(array('account_id' => $account_id, "DATE_FORMAT(created_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('created_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			
			$Qprev = $this->db->from('follower')->where(array('account_id' => $account_id, "DATE_FORMAT(created_time, '%Y-%m-%d')=" => date('Y-m-d', strtotime("-1 days", strtotime($period[0])))))->get();
			if($Qprev->num_rows()){
				$prev = $Qprev->row()->count;
			}
			else $prev = 0;
			
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->created_time);
				$this->xlsWriteNumber($i, 1, $list->count);
				$this->xlsWriteNumber($i, 2, $list->count - $prev);
				$prev = $list->count;
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function instagram_master($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('instagram_master_'.$account_id.'_('.date('M-Y', strtotime($period[0])).')');
		
		$session = date('Y-m', strtotime($period[0]));
		$this->load->model('report_instagram');
		
		$this->xlsBOF();
		$title = array('ID', 'Followers', 'Growth (#)', 'Growth (%)', 'Followers Active', 'Photo (Post)', 'Video (Post)', 'Total Post', 'Photo (Like)', 'Video (Like)', 'Like Status', 'Photo (Comment)', 'Video (Comment)', 'Comment', 'Feedback');
		
		for($i=0; $i < count($title); $i++){
			$this->xlsWriteLabel(0, $i, $title[$i]);
		}
		
		$Qlist = $this->db->query("
			SELECT a.`account_id`, a.`name`, a.`username`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '$session' ORDER BY `created_time` DESC LIMIT 1) AS `followers`,
				(SELECT `count` FROM `follower` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`created_time`, '%Y-%m') = '".date('Y-m', strtotime("-1 month", strtotime($session.'-01')))."' ORDER BY `created_time` DESC LIMIT 1) AS `followers_last`,
				(SELECT COUNT(1) FROM `feed` WHERE `account_id`=a.`account_id` AND DATE_FORMAT(`post_time`, '%Y-%m') = '$session') AS `posts`
			FROM `account` a
			WHERE a.`account_id`=$account_id
		");
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$growth = ($list->followers - $list->followers_last);
				
				$photo_post = 0;
				$video_post = 0;
				
				$photo_like = 0;
				$video_like = 0;
				
				$photo_comment = 0;
				$video_comment = 0;
				
				$feeds = "'0'";
				$Qfeed = $this->db->from('feed')->where(array('account_id' => $list->account_id, "DATE_FORMAT(post_time, '%Y-%m') =" => $session))->get();
				if($Qfeed->num_rows()){
					foreach($Qfeed->result() as $feed){
						$feeds .= ",'$feed->feed_id'";
						
						switch($feed->type){
							case 'image':
								$photo_like = $photo_like + $feed->likes_count;
								$photo_comment = $photo_comment + $feed->comment_count;
								$photo_post++;
								continue;
								
							case 'video':
								$video_like = $video_like + $feed->likes_count;
								$video_comment = $video_comment + $feed->comment_count;
								$video_post++;
								continue;
						}
					}
				}
				
				$this->xlsWriteLabel($i, 0, $list->name.' (/'.$list->username.')'); //ID
				$this->xlsWriteNumber($i, 1, $list->followers); //Fans
				$this->xlsWriteNumber($i, 2, $growth); //Growth (#)
				$this->xlsWriteLabel($i, 3, number_format(($growth / ($list->followers_last ? $list->followers_last : 1)) * 100, 3).'%'); //Growth (%)
				$this->xlsWriteNumber($i, 4, $this->report_instagram->users($list->account_id, 'MostActiveCount', $date)); //Followers Active
				$this->xlsWriteNumber($i, 5, $photo_post); //Photo (Post)
				$this->xlsWriteNumber($i, 6, $video_post); //Video (Post)
				$this->xlsWriteNumber($i, 7, ($photo_post + $video_post)); //Total Post
				$this->xlsWriteNumber($i, 8, $photo_like); //Photo (Like)
				$this->xlsWriteNumber($i, 9, $video_like); //Video (Like)
				$this->xlsWriteNumber($i, 10, ($photo_like + $video_like)); //Like Status
				$this->xlsWriteNumber($i, 11, $photo_comment); //Photo (Comment)
				$this->xlsWriteNumber($i, 12, $video_comment); //Video (Comment)
				$this->xlsWriteNumber($i, 13, ($photo_comment + $video_comment)); //Comment
				$this->xlsWriteNumber($i, 14, (($photo_like + $video_like) + ($photo_comment + $video_comment))); //Feedback
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function gplus_feed($account_id, $date)
	{
		$period = getmonth('date', $date);
		$this->headers('gplus_feed_'.$account_id.'_('.$period[0].'_'.$period[1].')');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Permalink');
		$this->xlsWriteLabel(0, 1, 'Month');
		$this->xlsWriteLabel(0, 2, 'Year');
		$this->xlsWriteLabel(0, 3, 'Date');
		$this->xlsWriteLabel(0, 4, 'Hour');
		$this->xlsWriteLabel(0, 5, 'Type');
		$this->xlsWriteLabel(0, 6, 'Text');
		$this->xlsWriteLabel(0, 7, 'Likes');
		$this->xlsWriteLabel(0, 8, 'Comment');
		$this->xlsWriteLabel(0, 9, 'Share');
		$this->xlsWriteLabel(0, 10, 'Total Feedback');
		$this->xlsWriteLabel(0, 11, 'Name');
		$this->xlsWriteLabel(0, 12, 'ID / Username');
		$this->xlsWriteLabel(0, 13, 'Followers');
		
		$user = $this->db->from('account')->where('account_id', $account_id)->get()->row();
		
		if(in_array($account_id, exc_account('mra'), true)){
			$this->db->where(array("text LIKE '%#PesonaIndonesia%' AND text LIKE '%#ExploreNusantara%'" => NULL));
		}
		$Qlist = $this->db->from('feed')->where(array('account_id' => $account_id, "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '$period[0]' AND '$period[1]'" => NULL))->order_by('post_time', 'ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->permalink);
				$this->xlsWriteLabel($i, 1, date('F', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 2, date('Y', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 3, date('Y-m-d', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 4, date('H', strtotime($list->post_time)));
				$this->xlsWriteLabel($i, 5, $list->type);
				$this->xlsWriteLabel($i, 6, ((strlen($list->text) > 255) ? substr($list->text, 0, 252).'...' : $list->text));
				$this->xlsWriteNumber($i, 7, $list->likes_count);
				$this->xlsWriteNumber($i, 8, $list->comment_count);
				$this->xlsWriteNumber($i, 9, $list->share_count);
				$this->xlsWriteNumber($i, 10, ($list->likes_count + $list->comment_count + $list->share_count));
				$this->xlsWriteLabel($i, 11, $user->name);
				$this->xlsWriteLabel($i, 12, ($user->username ? $user->username : $user->socmed_id));
				$this->xlsWriteNumber($i, 13, $user->follower);
				$i++;
			}
		}
		$this->xlsEOF();
	}
	
	function utest()
	{
		$this->headers('utest');
		
		$this->xlsBOF();
		$this->xlsWriteLabel(0, 0, 'Socmed');
		$this->xlsWriteLabel(0, 1, 'Keyword');
		$this->xlsWriteLabel(0, 2, 'Permalink');
		$this->xlsWriteLabel(0, 3, 'ID');
		$this->xlsWriteLabel(0, 4, 'Name');
		$this->xlsWriteLabel(0, 5, 'Username');
		$this->xlsWriteLabel(0, 6, 'Fans / Followers');
		
		$Qlist = $this->db->from('test-account')->order_by('socmed ASC', 'keyword ASC')->get();
		if($Qlist->num_rows()){
			$i = 1;
			foreach($Qlist->result() as $list){
				$this->xlsWriteLabel($i, 0, $list->socmed);
				$this->xlsWriteLabel($i, 1, $list->keyword);
				$this->xlsWriteLabel($i, 2, ($list->socmed == 'twitter') ? 'https://twitter.com/'.$list->username : 'https://facebook.com/'.$list->socmed_id);
				$this->xlsWriteLabel($i, 3, $list->socmed_id);
				$this->xlsWriteLabel($i, 4, $list->name);
				$this->xlsWriteLabel($i, 5, $list->username);
				$this->xlsWriteNumber($i, 6, $list->follower);
				$i++;
			}
		}
		$this->xlsEOF();
	}
}