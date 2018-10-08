<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
    <th width="25"></th>
    <th>Account</th>
    <th width="100">Engagement Ratio</th>
    <th width="100">Feedback Rate</th>
    <th width="100">Total Interaction</th>
    <th width="80">Total Fans</th>
</tr>
</thead>
<tbody>
<?php
if($data){
	$i = 1;
	$c = count($data);
	foreach($data as $list){
		
		$engagement_ratio = ($this->report_facebook->users($list->account_id, 'MostActiveCount', $date) / ($list->fans ? $list->fans : 1)) * 100;
		$e_ratio[$list->account_id] = $engagement_ratio;
		
		$feedback_rate = $list->feedback / ($list->post ? $list->post : 1);
		$f_rate[$list->account_id] = $feedback_rate;
		
		echo (($list->account_id == $account->account_id) && ($c > 1)) ? '<tr class="active" style="text-align:right">' : '<tr style="text-align:right">';
		echo '<td>'.$i.'</td>';
		echo '<td style="text-align:left"><a href="https://www.facebook.com/'.($list->username ? $list->username : $list->socmed_id).'" target="_blank">'.$list->name.'</a></td>';
		echo '<td>'.number_format($engagement_ratio, 2).'%</td>';
		echo '<td title="'.number_format($feedback_rate, 2).'">'.number_format($feedback_rate).'</td>';
		echo '<td>'.number_format($list->feedback).'</td>';
		echo '<td>'.number_format($list->fans).'</td>';
		echo '</tr>';
		$i++;
	}
}
else echo '<tr><td class="nodata" colspan="6">No data.</td></tr>';
?>
</tbody>
</table>

<h1><span class="fa fa-circle-o-notch"></span> Interaction Chart</h1>
<div id="performance_InteractionChart"></div>
<script type="text/javascript">
$('#performance_InteractionChart').highcharts({
	chart: {
		type: 'column'
	},
	title: {
		text: null
	},
	subtitle: {
		text: null
	},
	xAxis: {
		categories: ['Engagement Ratio', 'Feedback Rate'],
		labels: {
			style: {
				color: '#666',
				fontSize: '13px'
			}
		}
	},
	yAxis: {
		min: 0,
		gridLineWidth: 0,
		title: {
			text: null
		}
	},
	credits: {
		enabled: false
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}</td><td>:</td><td style="padding:0"><b>{point.y:,.2f}</b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: {
			dataLabels: {
				enabled: true,
				format: '{point.y:,.2f}',
				style: {
					color: '#000',
					fontSize: '10px',
					fontWeight: 'bold'
				}
			},
			pointPadding: 0.1,
			borderWidth: 0
		}
	},
	legend: {
		borderColor: '#DDD',
		itemStyle: {
			color: '#666',
			fontSize: '12px'
		}
	},
	series: [
	<?php
	if($data){
		$i = '';
		foreach($data as $list){
			echo $i ? ',' : '';
			echo '{name: "'.str_replace('"', '\"', $list->name).'", data: ['.$e_ratio[$list->account_id].','.$f_rate[$list->account_id].']}';
			$i = 1;
		}
	}
	?>
	]
});
</script>