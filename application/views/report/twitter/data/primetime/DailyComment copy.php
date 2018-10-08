<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div id="chart_DailyComment"></div>
<!--br />
<div id="chart_DailyComment2"></div-->
<script type="text/javascript">
$('#chart_DailyComment').highcharts({
	chart: {
		type: 'heatmap',
		marginTop: 40,
		marginBottom: 80
	},
	title: {
		text: null
	},
	subtitle: {
		text: '<?php echo date('F, d Y', $unix[0]).' ~ '.date('F, d Y', $unix[1]) ?>'
	},
	xAxis: {
		useHTML: true,
		categories: [
		<?php
		for($i=0; $i < 24; $i++)
		$sph[$i] = $this->report_twitter->primetime($account, 'SumComment', array($date, '%H', $i));
		
		natsort($sph);
		foreach($sph as $num)
		$sp = $num;
		
		for($i=0; $i < 24; $i++){
			echo $i ? ',' : '';
			if($sp){
				if($sp == $sph[$i]){
					echo '"<b>'.(($i > 9) ? $i : '0'.$i).':00</b><br><b>('.$sph[$i].')</b>"';
				}
				else echo '"'.(($i > 9) ? $i : '0'.$i).':00<br>('.$sph[$i].')"';
			}
			else echo '"'.(($i > 9) ? $i : '0'.$i).':00<br>('.$sph[$i].')"';
		}
		?>
		]
	},
	yAxis: {
		useHTML: true,
		reversed: true,
		gridLineWidth: 0,
		categories: [
		<?php
		$day = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		for($ii=0; $ii < count($day); $ii++)
		$spw[$ii] = $this->report_twitter->primetime($account, 'SumComment', array($date, '%w', $ii));
		
		natsort($spw);
		foreach($spw as $num)
		$sp = $num;
		
		for($ii=0; $ii < count($day); $ii++){
			echo $ii ? ',' : '';
			if($sp){
				if($sp == $spw[$ii]){
					echo '"<b>'.$day[$ii].' ('.$spw[$ii].')</b>"';
				}
				else echo '"'.$day[$ii].' ('.$spw[$ii].')"';
			}
			else echo '"'.$day[$ii].' ('.$spw[$ii].')"';
		}
		?>
		],
		title: null
	},
	colorAxis: {
		min: 0,
		minColor: '#FFF',
		maxColor: Highcharts.getOptions().colors[0]
	},
	legend: {
		enabled: false
	},
	credits: {
		enabled: false
	},
	tooltip: {
		formatter: function () {
			return '<b>' + this.series.xAxis.categories[this.point.x] + '/59</b><br><b>' +
			this.point.value + '</b> post(s) on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
		}
	},
	plotOptions: {
		series: {
			states: {
				hover: {
					enabled: false
				}
			}
		}
	},
	colors : ['#FFF', '#33B5E5', '#A6C', '#9C0', '#FB3', '#F44', '#09C', '#93C', '#690', '#F80', '#C00', '#C88830', '#D0A848'],
	colorAxis : {
		dataClassColor : 'category',
		dataClasses : [{
				to : 0
			}, {
				from : 1
			}, {
				from : 2
			}, {
				from : 3
			}, {
				from : 4
			}, {
				from : 5
			}, {
				from : 6,
			}, {
				from : 7,
			}, {
				from : 8
			}, {
				from : 9,
				to: 13
			}, {
				from : 14,
				to: 17
			}, {
				from : 18,
				to: 21
			}, {
				from : 22
			}
		]
	},
	series: [{
		name: 'Number of posts',
		color: '#F3F3F3',
		borderWidth: 1,
		data: [
		<?php
		$x=0;
		for($i=0; $i < 24; $i++){
			for($ii=0; $ii < 7; $ii++){
				$pt[$i.'_'.$ii] = $this->report_twitter->primetime($account, 'DailyComment', array($date, (($i > 9) ? $i : '0'.$i).'/'.$ii));
				echo $x ? ',' : '';
				echo '['.$i.', '.$ii.', '.$pt[$i.'_'.$ii].']';
				$x=1;
			}
		}
		?>
		],
		dataLabels: {
			enabled: true,
			color: '#FFF',
			style: {
				textShadow: false 
			}
		}
	}]
});

/*$('#chart_DailyComment2').highcharts({
	chart: {
		type: 'column'
	},
	title: {
		text: null
	},
	subtitle: {
		text: '<?php //echo date('F, d Y', $unix[0]).' ~ '.date('F, d Y', $unix[1]) ?>'
	},
	xAxis: {
		categories: [
		<?php
		/*for($i=0; $i < 24; $i++){
			echo $i ? ',' : '';
			echo "'".(($i > 9) ? $i : '0'.$i).":00'";
		}*/
		?>
		]
	},
	yAxis: {
		min: 0,
		gridLineWidth: 0,
		title: {
			text: 'Number of posts'
		},
		stackLabels: {
			enabled: true,
			formatter:function(){
				if(this.total > 0)
					return this.total;
			},
			style: {
				fontWeight: 'bold',
				color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			}
		}
	},
	credits: {
		enabled: false
	},
	tooltip: {
		formatter: function() {
			return '<b>'+ this.x +'</b><br/>'+
				this.series.name +': '+ this.y +'<br/>'+
				'Total: '+ this.point.stackTotal;
		}
	},
	plotOptions: {
		column: {
			stacking: 'normal',
			dataLabels: {
				enabled: true,
				color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
			}
		},
		series: {
			dataLabels:{
				enabled:true,
				formatter:function(){
					if(this.y > 0)
						return this.y;
				},
				style: {
					textShadow: false 
				}
			}
		}
	},
	series: [
	<?php
	/*for($ii=0; $ii < count($day); $ii++){
		echo $ii ? ',' : '';
		echo '{name: "'.$day[$ii].'",data: [';
		for($i=0; $i < 24; $i++){
			echo $i ? ',' : '';
			echo $pt[$i.'_'.$ii];
		}
		echo ']}';
	}*/
	?>
	]
});*/
</script>