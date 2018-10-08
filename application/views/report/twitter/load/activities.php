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
    <h1><span class="fa fa-circle-o-notch"></span> Account Tweet <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Account Tweet</b><hr>Jumlah <i>tweet</i> yang di kelompokkan berdasarkan kategori / jenis.</span></span></sup></h1>
    <div id="activities_AccountPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Total Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Total Feedback</b><hr>Jumlah <i>feedback</i> dari <i>tweet</i> yang di kelompokkan berdasarkan kategori / jenis.</span></span></sup></h1>
    <div id="activities_TotalFeedback"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Total Amplification <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Total Amplification</b><hr>Jumlah <i>amplification</i> dari <i>tweet</i> yang di kelompokkan berdasarkan kategori / jenis.</span></span></sup></h1>
    <div id="activities_TotalAmplification"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('activities_AccountPost', 'twitter', 'activities_AccountPost', <?php echo $account ?>, {});
    report_load('activities_TotalFeedback', 'twitter', 'activities_TotalFeedback', <?php echo $account ?>, {});
   	report_load('activities_TotalAmplification', 'twitter', 'activities_TotalAmplification', <?php echo $account ?>, {});
}
</script>