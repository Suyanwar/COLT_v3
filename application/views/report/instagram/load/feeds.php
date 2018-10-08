<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-rss"></font> Feeds</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker">
    <label for="dateRangePicker" title="Select a date range"><span class="fa fa-calendar"></span></label>
    <input type="text" id="dateRangePicker" value="<?php echo lastmonth() ?>" placeholder="Select a date range:" onkeydown="return false" onfocus="$(this).blur()" />
</div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Top post base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post base on Feedback</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_AllTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post base on Feedback</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_AllLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post base on Likes <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post base on Likes</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>like</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_LikeTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post base on Likes <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post base on Likes</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>like</i> terendah.</span></span></sup></h1>
    <div id="feeds_LikeLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post base on Comments <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post base on Comments</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah komentar terbanyak.</span></span></sup></h1>
    <div id="feeds_CommentTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post base on Comments <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post base on Comments</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah komentar terendah.</span></span></sup></h1>
    <div id="feeds_CommentLeastPost"></div>

    <h1><span class="fa fa-circle-o-notch"></span> Top video post base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top video post base on Feedback</b><hr>Daftar <i>video posting account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_VideoTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least video post base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least video post base on Feedback</b><hr>Daftar <i>video posting account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_VideoLeastPost"></div>

    <h1><span class="fa fa-circle-o-notch"></span> Top video post base on Views <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top video post base on Views</b><hr>Daftar <i>video posting account</i> yang di urutkan berdasarkan jumlah <i>views</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_ViewVideoTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least video post base on Views <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least video post base on Views</b><hr>Daftar <i>video posting account</i> yang di urutkan berdasarkan jumlah <i>views</i> terendah.</span></span></sup></h1>
    <div id="feeds_ViewVideoLeastPost"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('feeds_AllTopPost', 'instagram', 'feeds_AllTopPost', <?php echo $account ?>, {});
    report_load('feeds_AllLeastPost', 'instagram', 'feeds_AllLeastPost', <?php echo $account ?>, {});
    report_load('feeds_LikeTopPost', 'instagram', 'feeds_LikeTopPost', <?php echo $account ?>, {});
    report_load('feeds_LikeLeastPost', 'instagram', 'feeds_LikeLeastPost', <?php echo $account ?>, {});
    report_load('feeds_CommentTopPost', 'instagram', 'feeds_CommentTopPost', <?php echo $account ?>, {});
    report_load('feeds_CommentLeastPost', 'instagram', 'feeds_CommentLeastPost', <?php echo $account ?>, {});
    report_load('feeds_VideoTopPost', 'instagram', 'feeds_VideoTopPost', <?php echo $account ?>, {});
    report_load('feeds_VideoLeastPost', 'instagram', 'feeds_VideoLeastPost', <?php echo $account ?>, {});
    report_load('feeds_ViewVideoTopPost', 'instagram', 'feeds_ViewVideoTopPost', <?php echo $account ?>, {});
    report_load('feeds_ViewVideoLeastPost', 'instagram', 'feeds_ViewVideoLeastPost', <?php echo $account ?>, {});
}
</script>