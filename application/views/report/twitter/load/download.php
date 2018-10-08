<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/ca-menu-bar.css') ?>" />
<div class="header">
    <h1><font class="fa fa-download"></font> Download</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <div id="download_Summary"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('download_Summary', 'twitter', 'download_Summary', <?php echo $account ?>, {});
}
</script>