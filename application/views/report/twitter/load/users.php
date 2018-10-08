<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-user"></font> Users</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Top Speakers <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top Speakers</b><hr>Perkiraan daftar <i>user</i> yang dapat memberikan <i>amplification</i> lebih banyak.</span></span></sup></h1>
    <div id="users_TopSpeakers"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Most Active <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Active</b><hr>Daftar <i>user</i> yang lebih aktif memberikan <i>feedback</i> dalam periode saat ini.</span></span></sup></h1>
    <div id="users_MostActive"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Most Retweet <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Retweet</b><hr>Daftar <i>user</i> yang lebih aktif me-<i>retweet</i> dalam periode saat ini.</span></span></sup></h1>
    <div id="users_MostShare"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Most Reply <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Reply</b><hr>Daftar <i>user</i> yang lebih aktif me-<i>respon tweet</i> dalam periode saat ini.</span></span></sup></h1>
    <div id="users_MostMention"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
	report_load('users_TopSpeakers', 'twitter', 'users_TopSpeakers', <?php echo $account ?>, {});
	report_load('users_MostActive', 'twitter', 'users_MostActive', <?php echo $account ?>, {});
    report_load('users_MostShare', 'twitter', 'users_MostShare', <?php echo $account ?>, {});
    report_load('users_MostMention', 'twitter', 'users_MostMention', <?php echo $account ?>, {});
}
</script>