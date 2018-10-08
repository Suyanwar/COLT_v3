<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
    <th colspan="2" style="text-align:left">Likes Rate</th>
</tr>
</thead>
<tbody>
<tr>
    <td width="100">Per Photo</td>
    <td><b><?php echo number_format($data['like_photo']) ?></b></td>
</tr>
<tr>
    <td>Per Video</td>
    <td><b><?php echo number_format($data['like_video']) ?></b></td>
</tr>
</tbody>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
<thead>
<tr>
    <th colspan="2" style="text-align:left">Comments Rate</th>
</tr>
</thead>
<tbody>
<tr>
    <td width="100">Per Photo</td>
    <td><b><?php echo number_format($data['comment_photo']) ?></b></td>
</tr>
<tr>
    <td>Per Video</td>
    <td><b><?php echo number_format($data['comment_video']) ?></b></td>
</tr>
</tbody>
</table>