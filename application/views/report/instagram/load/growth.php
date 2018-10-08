<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-line-chart"></font> Growth</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Daily Fans <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Daily Fans</b><hr>Jumlah <i>fans</i> per hari pada periode saat ini.</span></span></sup></h1>
    <div id="growth_DailyFans"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Daily Growth <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Daily Growth</b><hr>Jumlah perkembangan <i>fans</i> per hari pada periode saat ini.</span></span></sup></h1>
    <div id="growth_DailyGrowth"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Monthly Fans <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Monthly Fans</b><hr>Jumlah <i>fans</i> per bulan pada periode saat ini.</span></span></sup></h1>
    <div id="growth_MonthlyFans"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Monthly Growth <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Monthly Growth</b><hr>Jumlah perkembangan <i>fans</i> per bulan pada periode saat ini.</span></span></sup></h1>
    <div id="growth_MonthlyGrowth"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('growth_DailyFans', 'instagram', 'growth_DailyFans', <?php echo $account ?>, {});
    report_load('growth_DailyGrowth', 'instagram', 'growth_DailyGrowth', <?php echo $account ?>, {});
    report_load('growth_MonthlyFans', 'instagram', 'growth_MonthlyFans', <?php echo $account ?>, {});
    report_load('growth_MonthlyGrowth', 'instagram', 'growth_MonthlyGrowth', <?php echo $account ?>, {});
}
</script>