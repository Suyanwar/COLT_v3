<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<form action="<?php echo site_url('data/twitter/comparison/'.$account) ?>" method="post" id="comparison_Form" onSubmit="return comparison()" style="margin-bottom:25px">
<select name="category" onChange="dochange('comparison_option', this.value);$('#comparison_Result').html('')" style="text-align:center">
	<option value="">Select Category:</option>
	<optgroup label="FOLLOWERS">
		<option value="daily_fans">Daily Followers</option>
		<option value="daily_growth">Daily Growth</option>
		<option value="monthly_fans">Monthly Followers</option>
		<option value="monthly_growth">Monthly Growth</option>
    </optgroup>
	<optgroup label="POST">
		<option value="daily_post">Daily Post</option>
		<option value="monthly_post">Monthly Post</option>
    </optgroup>
</select>
<div id="comparison_option"></div>
</form>