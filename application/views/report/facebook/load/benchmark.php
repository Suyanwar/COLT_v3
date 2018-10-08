<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-braille"></font> Benchmark</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
	<?php
	if($data):
	foreach($data as $list){
		echo '<h1><span class="fa fa-circle-o-notch"></span> '.$list->category.' <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Category '.$list->category.'</b><hr>Data <i>benchmark</i> akun facebook terdaftar yang di dapatkan berdasarkan kategori <i>'.$list->category.'</i>.</span></span></sup></h1>';
		echo '<div id="benchmark_'.str_replacing('alpha_num', $list->category).'"></div>';
	}
	endif;
	?>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker({
			batchMode: 'month',
			singleMonth: true,
			showShortcuts: false
		}).bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
	<?php
	if($data):
	foreach($data as $list){
		echo 'report_load("benchmark_'.str_replacing('alpha_num', $list->category).'", "facebook", "benchmark", '.$account.', {"category":"'.$list->category.'"});';
	}
	endif;
	?>
}
</script>