<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-bar-chart"></font> Hashtag</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Most Engage Tag in Post <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Engage Tag in Post</b><hr>Daftar <i>hashtag</i> yang sering digunakan dalam <i>posting</i>-an pada periode saat ini.</span></span></sup></h1>
    <div id="hashtag_MostEngage"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('hashtag_MostEngage', 'instagram', 'hashtag_MostEngage', <?php echo $account ?>, {});
}
</script>