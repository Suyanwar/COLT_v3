<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<h1><span class="fa fa-circle-o-notch"></span> Monthly Growth <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>INFORMASI</b><hr>Some text here..</span></span></sup></h1>
<div id="chart_MonthlyGrowth"></div>
<script type="text/javascript">
$('#chart_MonthlyGrowth').highcharts({
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
		$s=0;
		for($i=1; $i <= count($months); $i++){
			
			$counts = $this->report_twitter->growth($account, 'MonthlyFans', $year.'-'.(($i > 9) ? $i : '0'.$i));
			if($s){
				$count = $last ? ($counts - $last) : 0;
			}
			else $count = $counts - $this->report_twitter->growth($account, 'MonthlyFans', date('Y-m', strtotime('-1 month', strtotime($year.'-'.(($i > 9) ? $i : '0'.$i).'-01'))));
			
			if($year.$i == $cur_month){
				$counts = 0;
				echo '0,';
			}
			else echo $count.',';
			
			$last = $counts;
			$s=1;
		}
		echo ']},';
	}
	?>
	]
});
</script>