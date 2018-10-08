<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!$data) die('<p align="center" style="padding-top:25px">No data.</p>');
$year = date('Y', strtotime(date('Y-m', $unix[0]).'-01'));
?>
<div id="activities_ActivitiesChart"></div>
<script type="text/javascript">
$('#activities_ActivitiesChart').highcharts({
	chart: {
		zoomType: 'xy'
	},
	title: {
		text: null
	},
	subtitle: {
		text: '<?php echo date('F, d Y', $unix[0]).' ~ '.date('F, d Y', $unix[1]) ?>'
	},
	xAxis: [{
		labels: {
			rotation: 320
		},
		categories: [
		<?php
		$i = 1;
		foreach($data as $list){
			echo ($i > 1) ? ',' : '';
			if($list[0] == $list[1]){
				echo "'<b>Week $i</b> (".date('j M', strtotime($list[1])).")'";
			}
			else echo "'<b>Week $i</b> (".date('j', strtotime($list[0]))." - ".date('j M', strtotime($list[1])).")'";
			$i++;
		}
		?>
		]
	}],
	yAxis: [{
		gridLineWidth: 0,
		labels: {
			format: '{value}',
			style: {
				color: '#89A54E'
			}
		},
		title: {
			text: 'Feedback',
			style: {
				color: '#89A54E'
			}
		}
	}, {
		/*min: 0,
		max: 140,
		tickInterval: 5,*/
		gridLineWidth: 0,
		title: {
			text: 'Post',
			style: {
				color: '#4572A7'
			}
		},
		labels: {
			format: '{value}',
			style: {
				color: '#4572A7'
			}
		},
		opposite: true
	}],
	tooltip: {
		shared: true
	},
	legend: {
		enabled: true,
		borderColor: '#DDD',
		itemStyle: {
			color: '#666'
		}
	},
	credits: {
		enabled: false
	},
	plotOptions: {
		column: {
			stacking: 'normal',
			dataLabels: {
				enabled: true,
				color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || '#000',
				style: {
					color: '#000',
					textShadow: false
				}
			}
		},
		spline: {
			dataLabels: {
				enabled: true,
				style: {
					color: '#000'
				}
			}
		}
	},
	series: [{
		type: 'column',
		name: 'Photo post',
		yAxis: 1,
		data: [
		<?php
		$i = 1;
		foreach($data as $list){
			echo ($i > 1) ? ',' : '';
			echo $this->report_instagram->activities($account, 'post', array('type' => 'image', "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '".$year.date('-m-d', strtotime($list[0]))."' AND '".$year.date('-m-d', strtotime($list[1]))."'" => NULL));
			$i++;
		}
		?>
		],
		tooltip: {
			valueSuffix: null
		}
	}, {
		type: 'column',
		name: 'Video post',
		color: '#D7CCC8',
		yAxis: 1,
		data: [
		<?php
		$i = 1;
		foreach($data as $list){
			echo ($i > 1) ? ',' : '';
			echo $this->report_instagram->activities($account, 'post', array('type' => 'video', "DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '".$year.date('-m-d', strtotime($list[0]))."' AND '".$year.date('-m-d', strtotime($list[1]))."'" => NULL));
			$i++;
		}
		?>
		],
		tooltip: {
			valueSuffix: null
		}
	}, {
		name: 'Feedback',
		color: '#89A54E',
		type: 'spline',
		data: [
		<?php
		$i = 1;
		foreach($data as $list){
			echo ($i > 1) ? ',' : '';
			echo $this->report_instagram->activities($account, 'engagement', array("DATE_FORMAT(post_time, '%Y-%m-%d') BETWEEN '".$year.date('-m-d', strtotime($list[0]))."' AND '".$year.date('-m-d', strtotime($list[1]))."'" => NULL));
			$i++;
		}
		?>
		],
		tooltip: {
			valueSuffix: null
		}
	}]
});
</script>