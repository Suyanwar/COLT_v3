<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div id="performance_VsCompetitor"></div>
<script type="text/javascript">
$('#performance_VsCompetitor').highcharts({
	chart: {
		type: 'column'
	},
	title: {
		text: null
	},
	subtitle: {
		text: 'Total Followers per Month'
	},
	xAxis: {
		categories: [
		<?php
		for($i=2; $i >= 0; $i--){
			echo '"'.date('F, Y', strtotime("- $i month", $date)).'",';
		}
		?>
		],
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
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}</td><td>:</td><td style="padding:0"><b>{point.y}</b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: {
			dataLabels: {
				enabled: true,
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
	echo '{name: "'.str_replace('"', '\"', $account->name).'", data: [';
	for($i=2; $i >= 0; $i--){
		echo $this->report_twitter->performance($account->account_id, 'VsCompetitor', date('Y-m', strtotime("- $i month", $date)));
		echo $i ? ',' : '';
	}
	echo ']}';
	
	if($competitor):
	foreach($competitor as $list){
		echo ', {name: "'.str_replace('"', '\"', $list->name).'", data: [';
		for($i=2; $i >= 0; $i--){
			echo $this->report_twitter->performance($list->account_id, 'VsCompetitor', date('Y-m', strtotime("- $i month", $date)));
			echo $i ? ',' : '';
		}
		echo ']}';
	}
	endif;
	?>
	]
});
</script>