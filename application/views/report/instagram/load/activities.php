<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-bar-chart"></font> Activities</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Activities Chart <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Activities Chart</b><hr>Rangkuman aktifitas <i>account</i> dalam satu bulan yang di tampilkan menggunakan grafik.</span></span></sup></h1>
    <div id="activities_ActivitiesChart"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Activities Detail <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Activities Detail</b><hr>Rangkuman aktifitas <i>account</i> dalam satu bulan.</span></span></sup></h1>
    <div id="activities_ActivitiesDetail"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('activities_ActivitiesChart', 'instagram', 'activities_ActivitiesChart', <?php echo $account ?>, {});
    report_load('activities_ActivitiesDetail', 'instagram', 'activities_ActivitiesDetail', <?php echo $account ?>, {});
}
</script>