<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-tv"></font> Summary</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Top Posting <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top Posting</b><hr>Daftar <i>account</i> dan kompetitor yang di urutkan berdasarkan <i>posting</i> terbanyak.</span></span></sup></h1>
    <div id="summary_TopPosting"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top Fans <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top Fans</b><hr>Daftar <i>account</i> dan kompetitor yang di urutkan berdasarkan <i>fans</i> terbanyak.</span></span></sup></h1>
    <div id="summary_TopFollowers"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top Feedback</b><hr>Daftar <i>account</i> dan kompetitor yang di urutkan berdasarkan <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="summary_TopFeedback"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Effective Communication <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Effective Communication</b><hr>Daftar <i>account</i> dan kompetitor yang di urutkan berdasarkan komunikasi yang paling efektif.</span></span></sup></h1>
    <div id="summary_EffectiveCommunication"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('summary_TopPosting', 'facebook', 'summary_TopPosting', <?php echo $account ?>, {});
    report_load('summary_TopFollowers', 'facebook', 'summary_TopFollowers', <?php echo $account ?>, {});
    report_load('summary_TopFeedback', 'facebook', 'summary_TopFeedback', <?php echo $account ?>, {});
    report_load('summary_EffectiveCommunication', 'facebook', 'summary_EffectiveCommunication', <?php echo $account ?>, {});
}
</script>