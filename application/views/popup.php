<?php defined('BASEPATH') OR exit('No direct script access allowed');

switch($tp){

case 'my_profile':
if($list_data) $data = $list_data[0]; else exit('<center>Forbidden!</center>');
?>

<div id="ifbox_body">
    <div class="iheader">My Profile</div>
    <div class="ibody">
    	<div id="iform_r1"></div>
    	<form method="post" action="<?php echo site_url('process/my_profile') ?>" id="iform_f1" onsubmit="return iForm_s(1)">
        <table border="0" width="100%" class="lists" cellpadding="0" cellspacing="0">
            <tr><td width="100">Full Name</td><td width="5">:</td><td colspan="2"><input type="text" name="name" value="<?php echo input($data->full_name) ?>" maxlength="32" /></td></tr>
            <tr><td>Username</td><td>:</td><td colspan="2"><input type="text" name="uname" value="<?php echo input($data->username) ?>" maxlength="50" /></td></tr>
            <tr><td>Change Password</td><td>:</td><td><input type="password" name="new_pswd" placeholder="New password" style="text-align:center" /></td><td><input type="password" name="current_pswd" placeholder="Current password" style="text-align:center" /></td></tr>
        </table>
        <div class="ifooter">
            <input type="submit" value="Save Changes" />
            <input type="button" class="ifclose" value="Close" />
        </div>
        </form>
	</div>
</div>

<?php
break;

case 'new_dashboard':
?>

<div id="ifbox_body">
    <div class="iheader">Create New Dashboard <a class="ifclose fa fa-times" title="Close" style="float:right;font-size:20px;padding-right:15px"></a></div>
    <div class="ibody">
    	<form onSubmit="return search_account()">
        <table border="0" width="100%" class="search" cellpadding="0" cellspacing="0">
        <tr>
        	<td><input type="search" id="search_keyword" placeholder="Search Facebook / Twitter / Instagram" style="text-align:center" /></td>
            <td><div class="fa fa-search" onClick="search_account()"></div></td>
        </tr>
        </table>
        </form>
        <div id="search_result"></div>
	</div>
</div>

<?php
break;
}