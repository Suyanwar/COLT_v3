<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!$data) die('<p align="center" style="padding-top:25px">No data.</p>');
?>
<div id="demography_Country"></div>
<script type="text/javascript">
$('#demography_Country').highcharts({
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
			innerSize: '65%',
			dataLabels: {
				enabled: true,
				connectorColor: '#CCC',
				format: '{point.name}: {point.percentage:.1f}%'
			},
			showInLegend: true
		}
	},
	legend: {
		enabled: false
	},
	series: [{
		name: 'Number of users',
		data: [
		<?php
		$i=0;
		$count = count($data);
		if($count > 10):
		
		for($ii=0; $ii <= 10; $ii++){
			echo $i ? ',' : '';
			if($ii == 10){
				
				$total=0;
				for($iii=$ii; $iii < $count; $iii++){
					$total = $total + $data[$iii]->total;
				}
				
				echo '["OTHERS", '.$total.']';
			}
			else echo '["'.strtoupper($data[$ii]->title).'", '.$data[$ii]->total.']';
			$i=1;
		}
		
		else:
		foreach($data as $list){
			echo $i ? ',' : '';
			echo '["'.strtoupper($list->title).'", '.$list->total.']';
			$i=1;
		}
		endif;
		?>
		]
	}]
});
</script>