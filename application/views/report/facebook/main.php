<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div id="meta">
	<a id="acc">
        <img src="<?php echo base_url('static/i/frame-facebook.png') ?>" style="background-image:url(<?php echo $account->photo_profile ?>)">
        <?php echo $account->name.'<sup><img src="'.base_url('static/i/flag-'.$account->fl_active.'.png').'" title="'.($account->fl_active ? 'Active' : 'Idle').'"></sup>' ?>
	</a>
    <a href="https://www.facebook.com/<?php echo $account->username ? $account->username : $account->socmed_id ?>" target="_blank"><sup class="fa fa-external-link"></sup></a>
</div>

<div id="accounts">
<?php
if($accounts){
	echo '<ul>';
	foreach($accounts as $acc){
		echo '<li><a href="'.site_url('report/'.$acc->socmed.'/'.$acc->account_id).'"><img src="'.base_url('static/i/spacer.gif').'" style="background-image:url('.$acc->photo_profile.')" />'.$acc->name.'<sup><img src="'.base_url('static/i/flag-'.$acc->fl_active.'.png').'" title="'.($acc->fl_active ? 'Active' : 'Idle').'"></sup></a></li>';
	}
	echo '</ul>';
	echo '<div class="clear"></div>';
}
?>
</div>

<ul class="ca-menu-circle">
    <?php
    foreach($menus as $mn){ ?>
    <li>
        <a onclick="report_content('facebook', '<?php echo $mn[1] ?>', <?php echo $account->account_id ?>)">
            <span class="ca-icon-circle fa fa-<?php echo $mn[0] ?>"></span>
            <div class="ca-content-circle">
                <h2 class="ca-main-circle"><?php echo $mn[2] ?></h2>
            </div>
        </a>
    </li>
<?php } ?>
</ul>
<script>setup_ca_menu_circle(<?php echo count($menus) ?>)</script>
<div class="clear"></div>
<div id="content"></div>