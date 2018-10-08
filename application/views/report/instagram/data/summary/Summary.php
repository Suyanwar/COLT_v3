<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td width="300">
    	<?php if(isset($data['post']['post_time'])): ?>
        <table class="feed_list">
        <tr>
        <td>
            <table>
            <tr><td colspan="2" style="display:none"></td></tr>
            <tr>
            	<?php if($data['post']['image_url']){ ?>
                <td><a href="<?php echo $data['post']['permalink'] ?>" target="_blank"><img src="<?php echo base_url('static/i/spacer.gif') ?>" style="background-image:url(<?php echo $data['post']['image_url'] ?>)"></a></td>
            	<?php }elseif($data['post']['video_url']){ ?>
                <td><video src="<?php echo $data['post']['video_url'] ?>"></video></a></td>
                <?php }else{ ?>
                <td><a href="<?php echo $data['post']['permalink'] ?>" target="_blank"><img src="<?php echo base_url('static/i/spacer.gif') ?>" style="background-image:url(<?php echo base_url('static/i/no-image-available.jpg') ?>)"></a></td>
                <?php } ?>
                <td>Likes: <b><?php echo number_format($data['post']['likes_count']) ?></b><br>Comments: <b><?php echo number_format($data['post']['comment_count']) ?></b><?php if($data['post']['type'] == 'video') echo '<br>View: <b>'.number_format($data['post']['view_count']).'</b>' ?><br>Total: <b><?php echo number_format($data['post']['likes_count'] + $data['post']['comment_count']) ?></b></td>
            </tr>
            <tr><td colspan="2"><h2><a href="<?php echo $data['post']['permalink'] ?>" target="_blank"><?php echo date('d M Y - H:i', strtotime($data['post']['post_time'])) ?></a></h2><div><?php echo limit_text(str_replace(array('#'), ' #', $data['post']['text']), 23) ?></div></td></tr>
            </table>
        </td>
        </tr>
        </table>
        <?php endif ?>
    </td>
    
	<td style="padding-left:10px">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
        <thead>
        <tr>
            <th colspan="2" style="text-align:left">Statistics</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width="180">Photo Post</td>
            <td><b><?php echo number_format($data['photo_post']) ?></b></td>
        </tr>
        <tr>
            <td>Video Post</td>
            <td><b><?php echo number_format($data['video_post']) ?></b></td>
        </tr>
        <tr>
            <td>Feedback Rate</td>
            <td><b title="<?php echo number_format($data['engagement_post'], 2) ?>"><?php echo number_format($data['engagement_post']) ?></b></td>
        </tr>
        </tbody>
        </table>
        
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="list">
        <thead>
        <tr>
            <th colspan="2" style="text-align:left">Feedback</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width="180">Likes</td>
            <td><b><?php echo number_format($data['like_post']) ?></b></td>
        </tr>
        <tr>
            <td>Comments</td>
            <td><b><?php echo number_format($data['comment_post']) ?></b></td>
        </tr>
        <tr>
            <td>Total</td>
            <td><b><?php echo number_format($data['feedback_total']) ?></b></td>
        </tr>
        </tbody>
        </table>
    </td>
</tr>
</table>