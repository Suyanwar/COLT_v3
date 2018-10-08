<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
    <th width="25"></th>
    <th>Account</th>
    <th width="100">Followers<br /><?php echo date('F Y', strtotime("-1 month", $date)) ?></th>
    <th width="100">Followers<br /><?php echo date('F Y', $date) ?></th>
    <th width="60">Growth</th>
    <th width="60">% Change</th>
    <th width="100">Feedback Rate<br /><?php echo date('F Y', strtotime("-1 month", $date)) ?></th>
    <th width="100">Feedback Rate<br /><?php echo date('F Y', $date) ?></th>
    <th width="60">% Change</th>
    <th width="70">Tweet</th>
</tr>
</thead>
<tbody>
<?php
if($data){
	$i = 1;
	$c = count($data);
	foreach($data as $list){
		$rate = ($list->feedback + $list->reply_mention) / ($list->post ? $list->post : 1);
		$last_rate = ($list->last_feedback + $list->last_reply_mention) / ($list->last_post ? $list->last_post : 1);
		
		echo (($list->account_id == $account) && ($c > 1)) ? '<tr class="active" style="text-align:right">' : '<tr style="text-align:right">';
		echo '<td>'.$i.'</td>';
		echo '<td style="text-align:left"><a href="'.($list->username ? 'https://twitter.com/'.$list->username : 'https://twitter.com/intent/user?user_id='.$list->socmed_id).'" target="_blank">'.$list->name.'</a></td>';
		echo '<td>'.number_format($list->last_fans).'</td>';
		echo '<td>'.number_format($list->fans).'</td>';
		echo '<td>'.number_format($list->fans - $list->last_fans).'</td>';
		echo '<td>'.number_format((($list->fans - $list->last_fans) / ($list->last_fans ? $list->last_fans : 1)) * 100, 2).'%</td>';
		echo '<td title="'.number_format($last_rate, 2).'">'.number_format($last_rate).'</td>';
		echo '<td title="'.number_format($rate, 2).'">'.number_format($rate).'</td>';
		echo '<td>'.number_format((($rate - $last_rate) / ($last_rate ? $last_rate : 1)) * 100, 2).'%</td>';
		echo '<td>'.number_format($list->post).'</td>';
		echo '</tr>';
		$i++;
	}
}
else echo '<tr><td class="nodata" colspan="10">No data.</td></tr>';
?>
</tbody>
</table>