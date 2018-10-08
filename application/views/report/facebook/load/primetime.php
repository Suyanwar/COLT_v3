<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-clock-o"></font> Prime Time</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Daily Post <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Daily Post</b><hr>Jumlah <i>posting fanpage</i> yang di kelompokkan berdasarkan waktu / jam.</span></span></sup></h1>
    <div id="primetime_DailyPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Daily Comment <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Daily Comment</b><hr>Jumlah komentar <i>user</i> yang di kelompokkan berdasarkan waktu / jam.</span></span></sup></h1>
    <div id="primetime_DailyComment"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('static/js/heatmap.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('primetime_DailyPost', 'facebook', 'primetime_DailyPost', <?php echo $account ?>, {});
    report_load('primetime_DailyComment', 'facebook', 'primetime_DailyComment', <?php echo $account ?>, {});
}
</script>