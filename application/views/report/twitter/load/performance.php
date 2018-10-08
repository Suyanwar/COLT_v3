<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-arrow-circle-up"></font> Performance</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Summary <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Summary</b><hr>Ringkasan informasi <i>account</i> pada periode saat ini.</span></span></sup></h1>
    <div id="performance_Summary"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> <?php echo $account->name ?> <font style="text-transform:lowercase">VS</font> Competitor <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b><?php echo $account->name ?> vs Competitor</b><hr>Perbandingan <i>follower</i> antara <i>account</i> dengan kompetitor.</span></span></sup></h1>
    <div id="performance_VsCompetitor"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Interaction <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Interaction</b><hr>Daftar <i>account</i> dan kompetitor yang di urutkan berdasarkan interaksi terbanyak.</span></span></sup></h1>
    <div id="performance_Interaction"></div>
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
    report_load('performance_Summary', 'twitter', 'performance_Summary', <?php echo $account->account_id ?>, {});
    report_load('performance_VsCompetitor', 'twitter', 'performance_VsCompetitor', <?php echo $account->account_id ?>, {});
    report_load('performance_Interaction', 'twitter', 'performance_Interaction', <?php echo $account->account_id ?>, {});
}
</script>