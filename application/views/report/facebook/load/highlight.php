<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-star-half-full"></font> Highlight</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Summary <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Summary</b><hr>Ringkasan informasi <i>account</i> pada periode saat ini.</span></span></sup></h1>
    <div id="highlight_Summary"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Growth <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Growth</b><hr>Jumlah pertumbuhan <i>fans</i> pada periode saat ini.</span></span></sup></h1>
    <div id="highlight_Growth"></div>
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
    report_load('highlight_Summary', 'facebook', 'highlight_Summary', <?php echo $account ?>, {});
    report_load('highlight_Growth', 'facebook', 'highlight_Growth', <?php echo $account ?>, {});
}
</script>