<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!$data) die('<p align="center" style="padding-top:25px">No data.</p>');
?>
<div id="activities_TotalAmplification"></div>
<script type="text/javascript">
$('#activities_TotalAmplification').highcharts({
	chart: {
		type: 'pie'
	},
	title: {
		text: null
	},
	subtitle: {
		text: null
	},
	credits: {
		enabled: false
	},
	tooltip: {
		enabled: false
	},
	plotOptions: {
		pie: {
			innerSize: '65%'
		}
	},
	legend: {
		enabled: false
	},
	series: [{
		name: 'Number of posts',
		data: [
		<?php
		$i=0;
		foreach($data as $list){
			echo $i ? ',' : '';
			echo '["'.strtoupper($list->type).' ('.number_format($list->total).')", '.$list->total.']';
			$i=1;
		}
		?>
		]
	}]
});
</script>