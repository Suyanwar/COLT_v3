<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- Developed by: me@irvanfauzie.com -->
<head>
    <title>COLT - Nabata Technology</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="icon" type="image/x-ico" href="<?php echo base_url('static/i/favicon.png') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/page.css') ?>" />
    <script type="text/javascript">var base_urls = "<?php echo base_url() ?>", site_urls = "<?php echo site_url() ?>";</script>
    <script type="text/javascript" src="<?php echo base_url('static/js/jquery.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/form.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/popup.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/highcharts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/moment.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/daterangepicker.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/page.js') ?>"></script>
</head>
<body>
<noscript>
    <p align="center">This application rich of javascript, please enabled your JavaScript browser</p>
</noscript>

<table id="ifbox" border="0" cellpadding="0" cellspacing="0">
    <tr class="ifheader"><td class="ifleft"></td><td class="ifmiddle"></td><td class="ifright"></td></tr>
    <tr class="ifbody"><td colspan="3" class="ifmiddle"><div id="ifpopcontent"></div></td></tr>
    <tr class="iffooter"><td class="ifleft"></td><td class="ifmiddle"></td><td class="ifright"></td></tr>
</table>

<div id="loading">
	<span>Loading..</span>
</div>

<ul id="load_holder"></ul>

<div id="page-container">

<div id="header">
    <div class="left">
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url('static/i/logo.png') ?>" /></a>
    </div>
    
    <div class="right">
    <ul>
        <li><a href="<?php echo site_url('authentication/logout') ?>" onclick="return confirm('Are you sure you want to logout?')"><span class="fa fa-power-off"></span> Logout</a></li>
        <li><a onclick="popup(3, '<?php echo site_url('popup/my_profile') ?>', 500)"><span class="fa fa-user"></span> <font id="user_name"><?php echo $this->auth->session('name') ?></font></a></li>
    </ul>
    </div>
    
    <div class="clear"></div>
</div>

<div id="body">
	<?php $this->load->view($view[0], $view['data']) ?>
</div>

</div>
</body>
</html>