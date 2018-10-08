<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<ul class="ca-menu-bar">
<?php foreach($menus as $mn){ ?>
	<li>
		<a href="<?php echo site_url('download/facebook/'.$mn[1].'/'.$account.'?from='.$unix[0].'&to='.$unix[1]) ?>">
			<span class="ca-icon-bar fa fa-<?php echo $mn[0] ?>"></span>
			<div class="ca-content-bar">
				<h2 class="ca-main-bar"><?php echo $mn[2] ?></h2>
				<h3 class="ca-sub-bar"><?php echo $mn[1] ?></h3>
			</div>
		</a>
	</li>
<?php } ?>
</ul>
<div class="clear"></div>
<script>setup_ca_menu_bar(<?php echo count($menus) ?>)</script>