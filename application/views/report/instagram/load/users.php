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
    <h1><span class="fa fa-circle-o-notch"></span> Most Active <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Active</b><hr>Daftar <i>user</i> yang lebih aktif memberikan <i>feedback</i> dalam periode saat ini.</span></span></sup></h1>
    <div id="users_MostActive"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Most Commenters <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Commenters</b><hr>Daftar <i>user</i> yang lebih aktif memberikan komentar dalam periode saat ini.</span></span></sup></h1>
    <div id="users_MostCommenters"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Most Likers <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Most Likers</b><hr>Daftar <i>user</i> yang lebih aktif memberikan <i>like</i> dalam periode saat ini.</span></span></sup></h1>
    <div id="users_MostLikers"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		<?php if(in_array($account, exc_account('n3o'), true)){ ?>
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
		<?php }else{ ?>
		$("#dateRangePicker").dateRangePicker({
			batchMode: 'month',
			singleMonth: true,
			showShortcuts: false
		}).bind("datepicker-change", function(event, obj){reportLoad()});
		<?php } ?>
	}
});
function reportLoad(){
	report_load('users_MostActive', 'instagram', 'users_MostActive', <?php echo $account ?>, {});
    report_load('users_MostCommenters', 'instagram', 'users_MostCommenters', <?php echo $account ?>, {});
    report_load('users_MostLikers', 'instagram', 'users_MostLikers', <?php echo $account ?>, {});
}
</script>