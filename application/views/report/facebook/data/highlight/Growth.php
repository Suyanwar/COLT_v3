<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="box">
<tbody>
<tr>
	<td><?php echo $data[0][0] ?><div><?php echo number_format($data[0][1]) ?></div></td>
	<td><?php echo $data[1][0] ?><div><?php echo number_format($data[1][1]) ?></div></td>
	<td class="highlight">The greatest growth<div><?php echo $data[2] ?></div></td>
</tr>
</tbody>
</table>