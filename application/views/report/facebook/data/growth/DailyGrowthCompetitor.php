<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!$data) die('<p align="center" style="padding-top:25px">No data.</p>');
?>
<div id="chart_DailyGrowthCompetitor_<?php echo $account ?>"></div>
<script type="text/javascript">
$('#chart_DailyGrowthCompetitor_<?php echo $account ?>').highcharts({
	chart: {
		type: 'spline'
	},
	title: {
		text: null
	},
	subtitle: {
		text: '<?php echo date('F, d Y', $unix[0]).' ~ '.date('F, d Y', $unix[1]) ?>'
	},
	xAxis: {
		categories: [
		<?php
		$i=0;
		foreach($data as $list){
			echo $i ? ',' : '';
			echo '"'.date('M,d', strtotime($list->created_time)).'"';
			$i=1;
		}
		?>
		]
	},
	yAxis: {
		gridLineWidth: 0,
		title: {
			text: null
		}
	},
	credits: {
		enabled: false
	},
	tooltip: {
		valueSuffix: null
	},
	plotOptions: {
		spline: {
			dataLabels: {
				enabled: true,
				style: {
					fontSize: '11px'
				}
			}
		}
	},
	legend: {
		enabled: false
	},
	series: [{
		name: 'Fans',
		data: [
		<?php
		$i=0;
		foreach($data as $list){
			if($i){
				echo ','.($list->count - $last);
			}
			else echo $list->count - $this->report_facebook->growth($account, 'DailyPrevious', date('Y-m-d', $unix[0]));
			
			$last = $list->count;
			$i=1;
		}
		?>
		]
	}]
});
</script>