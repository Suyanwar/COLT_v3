<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="headerx">
    <h1>Users Management</h1>
    <!--table border="0">
        <tr>
            <td><a onclick="popup(3, '<?php echo site_url('popup/users/create') ?>', 500)">Add New</a></td>
            <td><form method="get" action="<?php echo base_url(uri_string()) ?>"><input type="text" name="q" placeholder="Search" value="<?php echo input($this->input->get('q')) ?>" /></form></td>
        </tr>
    </table-->
</div>
<div class="body">
    <table class="list" width="100%" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
    	<th width="25">No.</th>
    	<th>Full Name</th>
    	<th width="300">Username</th>
    	<th width="150">Role Access</th>
    	<th width="60"></th>
    </tr>
    </thead>
    <tbody>
    <?php
	if($list_data){
		$no = 1;
		foreach($list_data as $list){
			echo '<tr id="ls'.$list->admin_id.'">';
			echo '<td>'.$no.'</td>';
			echo '<td>'.$list->full_name.'</td>';
			echo '<td>'.$list->username.'</td>';
			echo '<td>'.$list->name.'</td>';
			if(($list->admin_id == 1) || ($list->admin_id == $this->auth->session('id'))){
				echo '<td class="attr'.$list->admin_id.'" align="center"><a onclick="popup(3, \''.site_url('popup/users/update/'.$list->admin_id).'\', 500)"><span class="fa fa-pencil-square-o" title="Edit"></span></a></td>';
			}
			else echo '<td class="attr'.$list->admin_id.'" align="center"><a onclick="popup(3, \''.site_url('popup/users/update/'.$list->admin_id).'\', 500)" style="margin-right:15px"><span class="fa fa-pencil-square-o" title="Edit"></span></a><a class="delete" t="user" tp="process/users/delete" dx="'.$list->admin_id.'"><span class="fa fa-trash" title="Delete"></span></a></td>';
			echo '</tr>';
			$no++;
		}
	}
	else echo '<tr><td class="nodata" colspan="5">No data.</td></tr>';
	?>
    </tbody>
    </table>
    <?php
	$extra = $this->input->get('q') ? '?q='.$this->input->get('q') : false;
	echo pagination($pagination['page'], site_url('main/users').'/', ceil($pagination['num_rows'] / $pagination['limit']), $pagination['num_rows'], 'href', $extra);
	?>
    </div>
</div>