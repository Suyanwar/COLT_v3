<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
    <th width="25"></th>
    <th>Fanpage</th>
    <th width="250">Category</th>
    <!--th width="120">Fans Linked</th-->
</tr>
</thead>
<tbody>
<?php
if($data){
	$i = 1;
	foreach($data as $list){
		echo '<tr style="text-align:right">';
		echo '<td>'.$i.'</td>';
		echo '<td style="text-align:left"><a href="https://www.facebook.com/'.$list->socmed_id.'" target="_blank" title="'.$list->total.'">'.$list->name.'</a></td>';
		echo '<td>'.$list->category.'</td>';
		//echo '<td>'.$list->total.'</td>';
		echo '</tr>';
		$i++;
	}
}
else echo '<tr><td class="nodata" colspan="4">No data.</td></tr>';
?>
</tbody>
</table>