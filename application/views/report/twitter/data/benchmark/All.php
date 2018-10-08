<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
	<th width="170">Type</th>
	<th>Data</th>
</tr>
</thead>
<tbody>
	<tr>
        <td>Growth</td>
        <td><?php echo $data['growth'] ?></td>
    </tr>
	<tr>
        <td>Market Penetration</td>
        <td><?php echo $data['market_penetration'] ?></td>
    </tr>
	<tr>
        <td>Engagement Ratio</td>
        <td><?php echo $data['engagement_ratio'] ?></td>
    </tr>
	<tr>
        <td>Effective Communication</td>
        <td><?php echo $data['effective_communication'] ?></td>
    </tr>
	<tr>
        <td>Conversations</td>
        <td><?php echo $data['conversations'] ?></td>
    </tr>
	<tr>
        <td>Users Active</td>
        <td><?php echo $data['users_active'] ?></td>
    </tr>
	<tr>
        <td>Number of Accounts</td>
        <td><?php echo $data['num_accounts'] ?></td>
    </tr>
	<tr>
        <td style="vertical-align:top">List of Accounts</td>
        <td><?php echo $data['list_accounts'] ?></td>
    </tr>
</tbody>
</table>