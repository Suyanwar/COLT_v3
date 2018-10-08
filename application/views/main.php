<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="left">
<h1><?php echo date('l, d F Y') ?></h1>
<ul>
    <li<?php echo active_menu($menu, 'report') ?>><a href="<?php echo base_url() ?>"><div><span class="fa fa-clipboard"></span>Account</div></a></li>
    <ol>
        <li<?php echo active_menu($menu, 'report_facebook') ?>><a href="<?php echo base_url('main/accounts/facebook') ?>"><div>Facebook</div></a></li>
        <li<?php echo active_menu($menu, 'report_twitter') ?>><a href="<?php echo base_url('main/accounts/twitter') ?>"><div>Twitter</div></a></li>
        <li<?php echo active_menu($menu, 'report_instagram') ?>><a href="<?php echo base_url('main/accounts/instagram') ?>"><div>Instagram</div></a></li>
    </ol>
    <?php if($this->auth->session('role') == 1): ?>
    <li<?php echo active_menu($menu, 'account') ?>><a href="<?php echo site_url('main/account') ?>"><div><span class="fa fa-user-secret"></span>Account Management</div></a></li>
    <li<?php echo active_menu($menu, 'users') ?>><a href="<?php echo site_url('main/users') ?>"><div><span class="fa fa-users"></span>Users Management</div></a></li>
    <?php endif ?>
</ul>
</div>

<div class="right">
    <?php $this->load->view($page, $content) ?>
</div>
<div class="clear"></div>