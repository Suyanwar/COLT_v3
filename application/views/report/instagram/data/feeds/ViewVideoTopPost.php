<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!$data) die('<p align="center" style="padding-top:25px">No data.</p>');

$i = 1;
echo '<table class="feed_list"><tr>';
foreach($data as $list){
	if($i == 6) echo '</tr><tr>';
	echo '<td>';
	echo '<table>';
		echo '<tr><td colspan="2" style="display:none"></td></tr>';
		echo '<tr>';
			echo $list->image_url ? '<td><a href="'.$list->permalink.'" target="_blank"><img src="'.base_url('static/i/spacer.gif').'" style="background-image:url('.$list->image_url.')"></a></td>' : ($list->video_url ? '<td><video src="'.$list->video_url.'"></video></td>' : '<td><img src="'.base_url('static/i/spacer.gif').'" style="background-image:url('.base_url('static/i/no-image-available.jpg').')"></td>');
			echo '<td>Likes: <b>'.number_format($list->likes_count).'</b><br>Comments: <b>'.number_format($list->comment_count).'</b><br>View: <b>'.number_format($list->view_count).'</b><br>Total: <b>'.number_format($list->total).'</b></td>';
		echo '</tr>';
		echo '<tr><td colspan="2"><h2><a href="'.$list->permalink.'" target="_blank">'.date('d M Y - H:i', strtotime($list->post_time)).'</a></h2><div>'.limit_text($list->text, 20).'</div></td></tr>';
	echo '</table>';
	echo '</td>';
	$i++;
}
if($i < 6){
	for($ii=$i; $ii < 6; $ii++){
		echo '<td></td>';
	}
}
echo '</tr></table>';
echo '<br>';