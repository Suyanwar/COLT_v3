<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="container">
	<?php if($this->auth->session('role') == 1): ?>
    <div class="new">
    	<a onclick="popup(4, '<?php echo site_url('popup/new_dashboard') ?>', 600)"><span class="fa fa-plus"></span> New Dashboard</a>
    </div>
    <div class="clear"></div>
    <?php endif ?>
    <div class="tab">
        <span id="tab_facebook" class="fa fa-facebook-square" onclick="tab_home('facebook')" title="Facebook"></span>
        <span id="tab_twitter" class="fa fa-twitter-square" onclick="tab_home('twitter')" title="Twitter"></span>
        <span id="tab_instagram" class="fa fa-instagram" onclick="tab_home('instagram')" title="Instagram"></span>
        <!--span id="tab_youtube" class="fa fa-youtube-square" onclick="tab_home('youtube')" title="Youtube"></span-->
    </div>
    
    <div id="tab"></div>
    <div class="clear"></div>
</div>