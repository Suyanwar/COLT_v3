<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div id="hashtag_MostEngage"></div>
<script type="text/javascript">
$('#hashtag_MostEngage').highcharts({
	chart: {
		type: 'bar'
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
		$i = 0;
		foreach($data as $list){
			echo $i ? ',' : '';
			echo "'$list->text'";
			$i = 1;
		}
		?>
		],
		title: {
			text: null
		},
		labels: {
			style: {
				fontSize: '11px'
			}
		}
	},
	yAxis: {
		min: 0,
		gridLineWidth: 0,
		title: {
			text: null,
			align: 'high'
		},
		labels: {
			enabled: false
		}
	},
	tooltip: {
		valueSuffix: null
	},
	plotOptions: {
		bar: {
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
	credits: {
		enabled: false
	},
	series: [{
		name: 'Total',
		data: [
		<?php
		$i = 0;
		foreach($data as $list){
			echo $i ? ',' : '';
			echo $list->total;
			$i = 1;
		}
		?>
		]
	}]
});
</script>