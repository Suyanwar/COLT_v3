<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="header">
    <h1><font class="fa fa-object-ungroup"></font> Comparison</h1>
    <div class="close" onclick="report_close()" title="Close or press ESC key">X</div>
    <div class="clear"></div>
</div>
<div class="dateRangePicker"></div>
<div class="content">
    <h1><span class="fa fa-circle-o-notch"></span> Category</h1>
    <div id="comparison_Category"></div>
    <div id="comparison_Result"></div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	$("#comparison_Result").html('');
    report_load('comparison_Category', 'facebook', 'comparison_Category', <?php echo $account ?>, {});
});
</script>