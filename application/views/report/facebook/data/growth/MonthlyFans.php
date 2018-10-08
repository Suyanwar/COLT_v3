<?php defined('BASEPATH') OR exit('No direct script access allowed');

$start = date('Y', $unix[0]);
$end = date('Y', $unix[1]);
$arr = array(1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
?>
<div id="chart_MonthlyFans"></div>
<script type="text/javascript">
$('#chart_MonthlyFans').highcharts({
	chart: {
		type: 'spline'
	},
	title: {
		text: null
	},
	subtitle: {
		text: '<?php echo ($start == $end) ? $start : $start.' ~ '.$end ?>'
	},
	xAxis: {
		categories: [
		<?php
		$x=0;
		for($i=$start; $i <= $end; $i++){
			for($m=1; $m <= count($arr); $m++){
				echo $x ? ',' : '';
				echo '"'.$arr[$m].','.$i.'"';
				$x=1;
			}
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
		$x=0;
		$cur_month = date('Yn');
		for($i=$start; $i <= $end; $i++){
			for($m=1; $m <= count($arr); $m++){
				echo $x ? ',' : '';
				echo ($i.$m == $cur_month) ? 0 : $this->report_facebook->growth($account, 'MonthlyFans', $i.'-'.(($m > 9) ? $m : '0'.$m));
				$x=1;
			}
		}
		?>
		]
	}]
});
</script>