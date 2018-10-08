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
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b>all account</b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet all account base on Feedback</b><hr>Daftar <i>tweet account</i> dan kompetitor yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_AllAccount"></div>
    
    <?php if($account->category): ?>
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->category ?> account</b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->category ?> account base on Feedback</b><hr>Daftar <i>tweet account</i> berdasarkan kategori <?php echo $account->category ?> yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_Category"></div>
    <?php endif ?>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->name ?></b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->name ?> base on Feedback</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_AllTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least tweet <b><?php echo $account->name ?></b> base on Feedback <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least tweet <?php echo $account->name ?> base on Feedback</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_AllLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->name ?></b> base on Feedback - Not Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->name ?> base on Feedback - Not Link</b><hr>Daftar <i>tweet account</i> yang tidak memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_NotLinkTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least tweet <b><?php echo $account->name ?></b> base on Feedback - Not Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least tweet <?php echo $account->name ?> base on Feedback - Not Link</b><hr>Daftar <i>tweet account</i> yang tidak memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_NotLinkLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->name ?></b> base on Feedback - Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->name ?> base on Feedback - Link</b><hr>Daftar <i>tweet account</i> yang memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_LinkTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least tweet <b><?php echo $account->name ?></b> base on Feedback - Link <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least tweet <?php echo $account->name ?> base on Feedback - Link</b><hr>Daftar <i>tweet account</i> yang memakai <i>link</i> dan di urutkan berdasarkan jumlah <i>feedback</i> terendah.</span></span></sup></h1>
    <div id="feeds_LinkLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->name ?></b> base on Retweets <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->name ?> base on Retweets</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>retweet</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_ShareTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least tweet <b><?php echo $account->name ?></b> base on Retweets <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least tweet <?php echo $account->name ?> base on Retweets</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>retweet</i> terendah.</span></span></sup></h1>
    <div id="feeds_ShareLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->name ?></b> base on Favourites <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->name ?> base on Favourites</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>favourite</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_LikeTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least tweet <b><?php echo $account->name ?></b> base on Favourites <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least tweet <?php echo $account->name ?> base on Favourites</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>favourite</i> terendah.</span></span></sup></h1>
    <div id="feeds_LikeLeastPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Top tweet <b><?php echo $account->name ?></b> base on Replies <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Top tweet <?php echo $account->name ?> base on Replies</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>reply</i> terbanyak.</span></span></sup></h1>
    <div id="feeds_CommentTopPost"></div>
    
    <h1><span class="fa fa-circle-o-notch"></span> Least tweet <b><?php echo $account->name ?></b> base on Replies <sup><span class="fa fa-info-circle tooltip"><span class="tooltiptext"><b>Least tweet <?php echo $account->name ?> base on Replies</b><hr>Daftar <i>tweet account</i> yang di urutkan berdasarkan jumlah <i>reply</i> terendah.</span></span></sup></h1>
    <div id="feeds_CommentLeastPost"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	reportLoad();
	if($("#dateRangePicker").length){
		$("#dateRangePicker").dateRangePicker().bind("datepicker-change", function(event, obj){reportLoad()});
	}
});
function reportLoad(){
    report_load('feeds_AllAccount', 'twitter', 'feeds_AllAccount', <?php echo $account->account_id ?>, {});
    <?php if($account->category): ?>report_load('feeds_Category', 'twitter', 'feeds_Category', <?php echo $account->account_id ?>, {});<?php endif ?>
    report_load('feeds_AllTopPost', 'twitter', 'feeds_AllTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_AllLeastPost', 'twitter', 'feeds_AllLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_NotLinkTopPost', 'twitter', 'feeds_NotLinkTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_NotLinkLeastPost', 'twitter', 'feeds_NotLinkLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LinkTopPost', 'twitter', 'feeds_LinkTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LinkLeastPost', 'twitter', 'feeds_LinkLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_ShareTopPost', 'twitter', 'feeds_ShareTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_ShareLeastPost', 'twitter', 'feeds_ShareLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LikeTopPost', 'twitter', 'feeds_LikeTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_LikeLeastPost', 'twitter', 'feeds_LikeLeastPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_CommentTopPost', 'twitter', 'feeds_CommentTopPost', <?php echo $account->account_id ?>, {});
    report_load('feeds_CommentLeastPost', 'twitter', 'feeds_CommentLeastPost', <?php echo $account->account_id ?>, {});
}
</script>