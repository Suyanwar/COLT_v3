<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!$data) die('<p align="center" style="padding-top:25px">No data.</p>');

echo '<ul class="user_list">';
foreach($data as $list){
	echo '<li><table><tr><td><a href="'.($list->u ? 'https://twitter.com/'.$list->u : 'https://twitter.com/intent/user?user_id='.$list->s).'" target="_blank"><img src="'.base_url('static/i/spacer.gif').'" style="background-image:url('.$list->p.')"></a></td><td>Activity: <b>'.number_format($list->t).'</b><br>Followers: <b>'.(($list->f > 1) ? number_format($list->f) : '').'</b><br>Loc: <b>'.$list->l.'</b></td></tr><tr><td colspan="2"><div><a href="'.($list->u ? 'https://twitter.com/'.$list->u : 'https://twitter.com/intent/user?user_id='.$list->s).'" target="_blank">'.($list->u ? '@'.$list->u : $list->n).'</a></div></td></tr></table></li>';
}
echo '</ul>';
echo '<div class="clear"></div>';
echo '<br>';