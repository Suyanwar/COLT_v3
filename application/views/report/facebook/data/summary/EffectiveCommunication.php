<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
	<th width="25">No.</th>
	<th>Account</th>
	<th width="60">Posts</th>
	<th width="80">Fans</th>
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
		$rate = $list->feedback / ($list->posts ? $list->posts : 1);
		$ec = ($rate / ($list->fans ? $list->fans : 1)) * 100;
		
		//$data = ($list->account_id == $account) ? '<tr class="active">' : '<tr>';
		//$data .= '<td>'.$i.'</td>';
		$data = '<td><a href="https://www.facebook.com/'.($list->username ? $list->username : $list->socmed_id).'" target="_blank" title="'.$list->account_id.'">'.$list->name.'</a></td>';
		$data .= '<td align="right">'.$list->posts.'</td>';
		$data .= '<td align="right">'.number_format($list->fans).'</td>';
		$data .= '<td align="right" title="'.number_format($rate, 2).'">'.number_format($rate).'</td>';
		$data .= '<td align="right">'.number_format($ec, 2).'%</td>';
		$data .= '</tr>';
		
		$datas[] = array(
			'id' => $ec,
			'account' => $list->account_id,
			'data' => $data
		);
		//$i++;
	}
	
	$sortArray = sort_array($datas);
	array_multisort($sortArray['id'], SORT_DESC, $datas);
	
	foreach($datas as $list){
		echo (($list['account'] == $account) && ($c > 1)) ? '<tr class="active">' : '<tr>';
		echo '<td>'.$i.'</td>';
		echo $list['data'];
		$i++;
	}
}
else echo '<tr><td align="center" colspan="6">No data.</td></tr>';
?>
</tbody>
</table>