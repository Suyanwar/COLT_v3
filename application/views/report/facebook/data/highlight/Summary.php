<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
    <th width="130">Month</th>
    <!--th width="115">Feedback Ratio</th-->
    <th width="125">Feedback Rate</th>
    <th width="125">Engagement Ratio</th>
    <th width="125">Market Penetration</th>
    <th width="125">Estimated Impression</th>
    <th width="120">Fans</th>
    <th>Prime Time</th>
</tr>
</thead>
<tbody>
<?php
if($data){
	foreach($data as $list){
		$date = '01-'.date('M Y', strtotime($list->month)).' ~ '.date('t M Y', strtotime($list->month));
		
		$impression = $this->report_facebook->highlight($account, 'impression', $date) + $this->report_facebook->users($account, 'MostActiveCount', $date);
		$growth = $this->report_facebook->highlight($account, 'growth_follower', $date);
		
		$time = '-';
		$primetime = $this->report_facebook->primetime($account, 'PrimeTime', $date);
		if(isset($primetime->created_time)){
			$hh = date('H', strtotime($primetime->created_time));
			$time = "{$hh}:00 - {$hh}:59";
		}
		
		/*$status_fr = '';
		if(isset($fr)){
			$fr_old = $fr;
			$fr = ($list->feedback / ($impression ? $impression : 1)) * 100;
			if($fr > $fr_old){
				$status_fr = '<font class="fa fa-caret-up" style="color:#00F"></font> ';
			}else{
				if($fr < $fr_old){
					$status_fr = '<font class="fa fa-caret-down" style="color:#F00"></font> ';
				}
			}
		}
		else $fr = ($list->feedback / ($impression ? $impression : 1)) * 100;*/
		
		$status_ft = '';
		if(isset($ft)){
			$ft_old = $ft;
			$ft = $list->feedback / ($list->posts ? $list->posts : 1);
			if($ft > $ft_old){
				$status_ft = '<font class="fa fa-caret-up" style="color:#00F"></font> ';
			}else{
				if($ft < $ft_old){
					$status_ft = '<font class="fa fa-caret-down" style="color:#F00"></font> ';
				}
			}
		}
		else $ft = $list->feedback / ($list->posts ? $list->posts : 1);
		
		$status_er = '';
		if(isset($er)){
			$er_old = $er;
			$er = ($this->report_facebook->users($account, 'MostActiveCount', $date) / ($list->fans ? $list->fans : 1)) * 100;
			if($er > $er_old){
				$status_er = '<font class="fa fa-caret-up" style="color:#00F"></font> ';
			}else{
				if($er < $er_old){
					$status_er = '<font class="fa fa-caret-down" style="color:#F00"></font> ';
				}
			}
		}
		else $er = ($this->report_facebook->users($account, 'MostActiveCount', $date) / ($list->fans ? $list->fans : 1)) * 100;
		
		$status_mp = '';
		if(isset($mp)){
			$mp_old = $mp;
			$mp = ($growth / ($impression ? $impression : 1)) * 100;
			if($mp > $mp_old){
				$status_mp = '<font class="fa fa-caret-up" style="color:#00F"></font> ';
			}else{
				if($mp < $mp_old){
					$status_mp = '<font class="fa fa-caret-down" style="color:#F00"></font> ';
				}
			}
		}
		else $mp = ($growth / ($impression ? $impression : 1)) * 100;
		
		$status_im = '';
		if(isset($im)){
			$im_old = $im;
			$im = $impression;
			if($im > $im_old){
				$status_im = '<font class="fa fa-caret-up" style="color:#00F"></font> ';
			}else{
				if($im < $im_old){
					$status_im = '<font class="fa fa-caret-down" style="color:#F00"></font> ';
				}
			}
		}
		else $im = $impression;
		
		$status_fn = '';
		if(isset($fn)){
			$fn_old = $fn;
			$fn = $list->fans;
			if($fn > $fn_old){
				$status_fn = '<font class="fa fa-caret-up" style="color:#00F"></font> ';
			}else{
				if($fn < $fn_old){
					$status_fn = '<font class="fa fa-caret-down" style="color:#F00"></font> ';
				}
			}
		}
		else $fn = $list->fans;
		
		echo '<td align="center">'.date('F', strtotime($list->month)).'</td>';
		//echo '<td align="right">'.$status_fr.number_format($fr, 2).'%</td>';
		echo '<td align="right" title="'.number_format($ft, 2).'">'.$status_ft.number_format($ft).'</td>';
		echo '<td align="right">'.$status_er.number_format($er, 2).'%</td>';
		echo '<td align="right">'.$status_mp.number_format($mp, 2).'%</td>';
		echo '<td align="right">'.$status_im.number_format($im).'</td>';
		echo '<td align="right">'.$status_fn.number_format($fn).'</td>';
		echo '<td align="center">'.$time.'</td>';
		echo '</tr>';
	}
}
else echo '<tr><td class="nodata" colspan="8">No data.</td></tr>';
?>
</tbody>
</table>