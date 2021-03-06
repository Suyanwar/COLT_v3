<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<h1><span class="fa fa-circle-o-notch"></span> Daily Fans <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>INFORMASI</b><hr>Some text here..</span></span></sup></h1>
<div id="chart_DailyFans"></div>
<script type="text/javascript">
$('#chart_DailyFans').highcharts({
	title: {
		text: null
	},
	subtitle: {
		text: null
	},
	xAxis: {
		categories: [<?php for($i=1; $i < 32; $i++) echo $i.',' ?>],
		title: {
			text: 'Date'
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
	foreach($period as $month){
		$m = explode('-', $month);
		echo '{name: "'.date('F Y', strtotime($month.'-01')).'",';
		echo 'data: [';
		for($i=1; $i < 32; $i++){
			$count = $this->report_facebook->growth($account, 'CountFans', array('%Y-%m-%d', $month.'-'.(($i > 9) ? $i : '0'.$i)));
			
			if($i == 31){
				echo $count ? $count : '';
			}else{
				if($i > 28){
					if($m[1] == '02'){
						echo $count ? $count : '';
					}
					else echo $count.',';
				}
				else echo $count.',';
			}
		}
		echo ']},';
	}
	?>
	]
});
</script>