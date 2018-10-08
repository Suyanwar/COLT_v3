<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
	<th width="25">No.</th>
	<th>Account</th>
	<th width="60">Tweet</th>
	<th width="80">Followers</th>
	<th width="90">Feedback Rate</th>
	<th width="140">Effective Communication</th>
</tr>
</thead>
<tbody>
<?php
if($data){
	$i = 1;
	$c = count($data);
	foreach($data as $list){
		$rate = ($list->feedback + $list->reply_mention) / ($list->posts ? $list->posts : 1);
		echo (($list->account_id == $account) && ($c > 1)) ? '<tr class="active">' : '<tr>';
		echo '<td>'.$i.'</td>';
		echo '<td><a href="'.($list->username ? 'https://twitter.com/'.$list->username : 'https://twitter.com/intent/user?user_id='.$list->socmed_id).'" target="_blank">'.$list->name.'</a></td>';
		echo '<td align="right">'.$list->posts.'</td>';
		echo '<td align="right">'.number_format($list->fans).'</td>';
		echo '<td align="right" title="'.number_format($rate, 2).'">'.number_format($rate).'</td>';
		echo '<td align="right">'.number_format(($rate / ($list->fans ? $list->fans : 1)) * 100, 2).'%</td>';
		echo '</tr>';
		$i++;
	}
}
else echo '<tr><td class="nodata" colspan="6">No data.</td></tr>';
?>
</tbody>
</table>