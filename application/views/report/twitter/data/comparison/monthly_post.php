<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<h1><span class="fa fa-circle-o-notch"></span> Monthly Post <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>INFORMASI</b><hr>Some text here..</span></span></sup></h1>
<div id="chart_MonthlyPost"></div>
<script type="text/javascript">
$('#chart_MonthlyPost').highcharts({
	title: {
		text: null
	},
	subtitle: {
		text: null
	},
	xAxis: {
		categories: [
		<?php
		$months = arr_month(1);
		for($i=1; $i <= count($months); $i++){
			echo '"'.$months[$i].'",';
		}
		?>
		],
		title: {
			text: 'Month'
		}
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
		line: {
			dataLabels: {
				enabled: true,
				style: {
					fontSize: '11px'
				}
			}
		}
	},
	series: [
	<?php
	$cur_month = date('Yn');
	foreach($period as $year){
		echo '{name: "'.$year.'",';
		echo 'data: [';
		for($i=1; $i <= count($months); $i++){
			echo ($year.$i == $cur_month) ? '0,' : $this->report_twitter->growth($account, 'CountPost', array('%Y-%m', $year.'-'.(($i > 9) ? $i : '0'.$i))).',';
		}
		echo ']},';
	}
	?>
	]
});
</script>