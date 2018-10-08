<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-globe"></font> Demography</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Base on Country <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Base on Country</b><hr>Pemetaan <i>user</i> pada periode saat ini berdasarkan negara.</span></span></sup></h1>
    <div id="demography_Country"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Base on State <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Base on State</b><hr>Pemetaan <i>user</i> pada periode saat ini berdasarkan provinsi.</span></span></sup></h1>
    <div id="demography_State"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Base on City <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Base on City</b><hr>Pemetaan <i>user</i> pada periode saat ini berdasarkan kota.</span></span></sup></h1>
    <div id="demography_City"></div>
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
    report_load('demography_Country', 'twitter', 'demography_Country', <?php echo $account ?>, {});
    report_load('demography_State', 'twitter', 'demography_State', <?php echo $account ?>, {});
    report_load('demography_City', 'twitter', 'demography_City', <?php echo $account ?>, {});
}
</script>