<?php defined('BASEPATH') OR exit('No direct script access allowed'); $this->auth->cookie() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- Developed by: me@irvanfauzie.com -->
<head>
    <title>COLT - Nabata Technology</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="icon" type="image/x-ico" href="<?php echo base_url('static/i/favicon.png') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/login.css') ?>" />
    <script type="text/javascript">var base_urls = "<?php echo base_url() ?>", site_urls = "<?php echo site_url() ?>";</script>
    <script type="text/javascript" src="<?php echo base_url('static/js/jquery.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/form.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/js/login.js') ?>"></script>
</head>
<body>
<noscript>
    <p align="center">This application rich of javascript, please enabled your JavaScript browser</p>
</noscript>
<div id="page-container">

<div id="login">
	<h1>COLT Management</h1>
    
    <div class="box">
    <h3 id="iflogin_r">Please insert your username and password to continue</h3>
    <form method="post" action="<?php echo site_url('authentication/login') ?>" id="iflogin_f" onsubmit="return iFlogin_s()">
    	<div class="form">
            <div class="input"><span class="fa fa-user"></span><input type="text" name="uname" id="uname" placeholder="Username" /></div>
            <div class="input"><span class="fa fa-lock"></span><input type="password" name="ifpssd" placeholder="Password" /></div>
            <div class="check"><label><input type="checkbox" name="keep" value="true" /> Keep me logged in.</label></div>
        </div>
    	<input type="submit" id="iflogin_s" value="Log in" />
    </form>
    </div>
</div>

</div>
</body>
</html>