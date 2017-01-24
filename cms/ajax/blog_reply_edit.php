<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['blog_reply_id']))
{
	echo $blg->saveBlogReply();
	exit;
}
$blog_reply_id=$_REQUEST['id'];
$row_reply=$blg->showReply($blog_reply_id);
?>
<div class="container" style="margin:0;">
    <h1>Edit Blog Reply</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the blog reply details that you wish to update.
    </div>
    <form id="form_blog_reply_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Full Name</td>
        <td class="formright">
        	<input type="text" name="blog_reply_name" value="<?php echo stripslashes($row_reply['blog_reply_name']); ?>" class="mytextbox" />
        	<br /><span class="grey">Provided text appears as the name who has made this reply.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">Email Address</td>
        <td class="formright">
        	<input type="text" name="blog_reply_email" value="<?php echo stripslashes($row_reply['blog_reply_email']); ?>" class="mytextbox" />
        	<br /><span class="grey">Provided text appears as the email who has made this reply.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">Website</td>
        <td class="formright">
        	<input type="text" name="blog_reply_website" value="<?php echo stripslashes($row_reply['blog_reply_website']); ?>" class="mytextbox" />
        	<br /><span class="grey">Provided text appears as the URL of the website.</span>
      	</td>
    </tr>
    <tr>
        <td class="formleft">Reply/Comment</td>
        <td class="formright">
        	<textarea name="blog_reply_comment" class="mytextarea"><?php echo stripslashes($row_reply['blog_reply_comment']); ?></textarea>
        	<span class="grey">Provided text appears as the reply/comment that has been made.</span>    
       	</td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<select id="blog_reply_status" name="blog_reply_status" class="myselectbox">
            	<option value="0" <?php if($row_reply['blog_reply_status']==0) echo "selected"; ?>>Unpublished</option>
                <option value="1" <?php if($row_reply['blog_reply_status']==1) echo "selected"; ?>>Published</option>
                <option value="2" <?php if($row_reply['blog_reply_status']==2) echo "selected"; ?>>Rejected</option>
                <option value="3">Delete</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn blog_reply_update" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="blog_reply_id" value="<?php echo $blog_reply_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.blog_reply_update').click(function(){
			if($('#blog_reply_status').val()==3){
				if(confirm('Are you sure that you wish to delete this reply?')){
					var t=$(this);
					t.hide();
					$('.saving').show();
					$.ajax({
						url: 'ajax/blog_reply_edit.php',
						type: 'post',
						data: $('#form_blog_reply_edit').serialize(),
						success: function(){
							$('.saving').hide();
							t.show();
							$.fancybox.close();
						}
					});
				}
			}
			else{
				var t=$(this);
				t.hide();
				$('.saving').show();
				$.ajax({
					url: 'ajax/blog_reply_edit.php',
					type: 'post',
					data: $('#form_blog_reply_edit').serialize(),
					success: function(){
						$('.saving').hide();
						t.show();
						$.fancybox.close();
					}
				});
			}
		});
	});
	</script>
</div>