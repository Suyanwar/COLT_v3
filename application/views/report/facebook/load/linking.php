<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-user"></font> Fans Connect</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Top Fanpage <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top Fanpage</b><hr>Perkiraan jumlah <i>fanpage</i> terbanyak yang di ikuti oleh <i>user</i> yang aktif.</span></span></sup></h1>
    <div id="linking_TopFanpage"></div>
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
	report_load('linking_TopFanpage', 'facebook', 'linking_TopFanpage', <?php echo $account ?>, {});
}
</script>