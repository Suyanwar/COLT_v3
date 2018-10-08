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
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b>all account</b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post all account base on Feedback</b><hr>Daftar <i>posting account</i> dan kompetitor yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_AllAccount"></div>
    
    <?php if($account->category): ?>
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->category ?> account</b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->category ?> account base on Feedback</b><hr>Daftar <i>posting account</i> berdasarkan kategori <?php echo $account->category ?> yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_Category"></div>
    <?php endif ?>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Feedback</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_AllTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Feedback</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_AllLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Feedback - Not Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Feedback - Not Link</b><hr>Daftar <i>posting account</i> yang tidak memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_NotLinkTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Feedback - Not Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Feedback - Not Link</b><hr>Daftar <i>posting account</i> yang tidak memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_NotLinkLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Feedback - Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Feedback - Link</b><hr>Daftar <i>posting account</i> yang memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_LinkTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Feedback - Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Feedback - Link</b><hr>Daftar <i>posting account</i> yang memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_LinkLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Shares <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Shares</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>share</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_ShareTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Shares <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Shares</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>share</i> terendah.</span></span></sup></h1>
    <div id="feeds_ShareLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Likes <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Likes</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>like</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_LikeTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Likes <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Likes</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah <i>like</i> terendah.</span></span></sup></h1>
    <div id="feeds_LikeLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Comments <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Comments</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah komentar terbanyak.</span></span></sup></h1>
    <div id="feeds_CommentTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Comments <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Comments</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah komentar terendah.</span></span></sup></h1>
    <div id="feeds_CommentLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Boost <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Boost</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah Boost terbanyak.</span></span></sup></h1>
    <div id="feeds_BoostTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Boost <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Boost</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah Boost terendah.</span></span></sup></h1>
    <div id="feeds_BoostLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top post <b><?php echo $account->name ?></b> base on Organic <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top post <?php echo $account->name ?> base on Boost</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah Organic terbanyak.</span></span></sup></h1>
    <div id="feeds_OrganicTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least post <b><?php echo $account->name ?></b> base on Organic <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least post <?php echo $account->name ?> base on Boost</b><hr>Daftar <i>posting account</i> yang di urutkan berdasarkan jumlah Organic terendah.</span></span></sup></h1>
    <div id="feeds_OrganicLeastPost"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('feeds_AllAccount', 'facebook', 'feeds_AllAccount', <?php echo $account->account_id ?>, {});
    <?php if($account->category): ?>report_load('feeds_Category', 'facebook', 'feeds_Category', <?php echo $account->account_id ?>, {});<?php endif ?>
    report_load('feeds_AllTopPost', 'facebook', 'feeds_AllTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_AllLeastPost', 'facebook', 'feeds_AllLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_NotLinkTopPost', 'facebook', 'feeds_NotLinkTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_NotLinkLeastPost', 'facebook', 'feeds_NotLinkLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LinkTopPost', 'facebook', 'feeds_LinkTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LinkLeastPost', 'facebook', 'feeds_LinkLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_ShareTopPost', 'facebook', 'feeds_ShareTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_ShareLeastPost', 'facebook', 'feeds_ShareLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LikeTopPost', 'facebook', 'feeds_LikeTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LikeLeastPost', 'facebook', 'feeds_LikeLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_CommentTopPost', 'facebook', 'feeds_CommentTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_CommentLeastPost', 'facebook', 'feeds_CommentLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_BoostTopPost', 'facebook', 'feeds_BoostTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_BoostLeastPost', 'facebook', 'feeds_BoostLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_OrganicTopPost', 'facebook', 'feeds_OrganicTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_OrganicLeastPost', 'facebook', 'feeds_OrganicLeastPost', <?php echo $account->account_id ?>, {});
}
</script>