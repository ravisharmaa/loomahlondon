<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$row_replies=$blg->showBlogReplies($_POST['id']);
if(count($row_replies))
{
	?>
    <table class="mytab">
    <thead>
        <tr>
            <th align="left">Reply/Comment</th>
            <th width="300" align="left">Full Name / Email Address</th>
            <th width="100">Status</th>
            <th width="50">Action</th>
        </tr>    
	</thead>
    <tbody>
    	<?php    
    	foreach($row_replies as $row_reply)
		{
			?>
            <tr>
            	<td><?php echo substr(stripslashes($row_reply['blog_reply_comment']),0,50); ?>...
                <br /><?php echo $fun->myDateTime("d F Y",$row_reply['blog_reply_date']); ?></td>
                <td><?php echo stripslashes($row_reply['blog_reply_name']); ?><br /><?php echo stripslashes($row_reply['blog_reply_email']); ?></td>
                <td align="center">
					<?php 
					if($row_reply['blog_reply_status']==0)
					{
						?>
                        Unpublished
                        <?php
					}
					else if($row_reply['blog_reply_status']==1)
					{
						?>
                        Published
                        <?php
					}
					else if($row_reply['blog_reply_status']==2)
					{
						?>
                        Rejected
                        <?php		
					}
					?>
                </td>
                <td align="center">
                	<a href="ajax/blog_reply_edit.php?id=<?php echo $row_reply['blog_reply_id']; ?>" class="blog_edit fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                </td>    
            </tr>
			<?php
		}
		?>
	</tbody>
    </table>
    <div class="clearboth"></div>
	<script>
    $(function(){
        $('.blog_edit').fancybox({
            beforeClose: function(){
				$.ajax({
					url: 'ajax/blog_reply_show.php',
					type: 'post',
					data: { id: '<?php echo $_POST['id']; ?>' },
					success: function(data){
						$('#blog_block').html(data);
					}
				});	
			}
        });
	});
    </script>
	<?php
}
else
{
	?>
    <div class="unavailable">No reply for this blog is available.</div>
    <?php	
}
?>