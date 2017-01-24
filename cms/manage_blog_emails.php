<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../";
include_once($myroot."config/config.php");
?>
<script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
<?php
if(isset($_POST['action_email_content'])){
	$action_email_content=$_POST['action_email_content'];
	if($action_email_content==1){
		$email_content=$_POST["email_content_desc"];
		
		$blog_id=$_POST['blog_id'];
		$get_blog=$blg->showBlog($blog_id);
		if($get_blog['blog_desc']!=""){
		$select_blog_id=$blg->showBlogEmailContent($blog_id);
		if(count($select_blog_id)>0){
			$blg->saveBlogEmailContent($blog_id);
			}
			else{
					$blg->addBlogEmailContent($blog_id);
			}
		
		include("emailscript_subscription.php");
		print"<script>window.location='login.php?p_id=manage_blog_emails&id=".$blog_id."&emailsent=yes'</script>";
	die();
	}
	else{
		echo "<script>alert('Blog content is empty.');</script>";
		}
		
		}
	}
if(isset($_POST["action_email"])){
	$action_email=$_POST["action_email"];


if($action_email == 1)
{
	$txtemail=$_POST["txtemail"];
	$id=$_REQUEST['id'];
	include("emailscript_testemail.php");
	print"<script>window.location='login.php?p_id=manage_blog_emails&id=".$_REQUEST['id']."&emailsent=done'</script>";
	die();
}
}
if(isset($_POST['submitted']))
{
	switch($_POST['submitted'])
	{
		case "Save":
			//foreach($_POST as $key => $val)	{ echo "$".$key."=addslashes($"."_POST['".$key."']);<br />"; }
			$blog_subscriber_id=$_POST['blog_subscriber_id'];
			$blog_subscriber_name=addslashes($_POST['blog_subscriber_name']);
			$blog_subscriber_email=addslashes($_POST['blog_subscriber_email']);
			$blog_subscriber_status=$_POST['blog_subscriber_status'];
			if($mydb->update_sql("tbl_blog_subscribers",array("blog_subscriber_name","blog_subscriber_email","blog_subscriber_status"),array($blog_subscriber_name,$blog_subscriber_email,$blog_subscriber_status),"blog_subscriber_id='$blog_subscriber_id'"))
			{
				$myfun->redirect("login.php?p_id=manage_blog_subscribers","Subscriber has been updated successfully.");	
			}
			break;	
	}
}
if(isset($_REQUEST['act']))
{
	switch($_REQUEST['act'])
	{
		case "edit":
			$blog_subscriber_id=$_REQUEST['id'];
            $myquery_blog_subscriber=$mydb->select_sql(array("*"),"tbl_blog_subscribers","blog_subscriber_id='$blog_subscriber_id'");
            $row_blog_subscriber=$mydb->fetch_array($myquery_blog_subscriber);
            ?>
			<h1>Subscriber List</h1>
            <div class="breadcrumb">
        		<a href="login.php">Dashboard</a> &raquo; Blogs &raquo; <a href="login.php?p_id=manage_blog_categories">Subscriber List</a> &raquo; Edit Subscriber
    		</div>
            <div class="info">Provide the information for the subscriber that you wish to update.</div>
            <form action="" method="post" enctype="multipart/form-data">
            <table border="0" class="myform">
            <tr>
            	<td class="formleft">Subscriber Name</td>
                <td class="formright"><input type="text" name="blog_subscriber_name" value="<?php echo stripslashes($row_blog_subscriber['blog_subscriber_name']); ?>" size="100" class="mytextbox" /></td>
            </tr>
            <tr>
            	<td class="formleft">Email Address</td>
                <td class="formright"><input type="text" name="blog_subscriber_email" value="<?php echo stripslashes($row_blog_subscriber['blog_subscriber_email']); ?>" size="100" class="mytextbox" /></td>
            </tr>
            <tr>
            	<td class="formleft">Status</td>
                <td class="formright"><select name="blog_subscriber_status" style="padding:3px 5px;border:#CCC 1px solid;">
                	<option value="0" <?php if($row_blog_subscriber['blog_subscriber_status']=="0") echo "selected"; ?>>Unscbscribed</option>
                    <option value="1" <?php if($row_blog_subscriber['blog_subscriber_status']=="1") echo "selected"; ?>>Subscribed</option>
                </select></td>
            </tr>
            <tr>
            	<td class="formleft">&nbsp;</td>
                <td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /> <input type="button" value="Cancel" class="mybtn_cancel" onclick="location.href='login.php?p_id=manage_blog_subscribers';" /></td>
            </tr>
            </table>
            <input type="hidden" name="blog_subscriber_id" value="<?php echo $blog_subscriber_id; ?>" />
            </form>
            <?php
			break;
		case "del":
			$blog_subscriber_id=$_REQUEST['id'];
			if($mydb->delete_sql("tbl_blog_subscribers","blog_subscriber_id='$blog_subscriber_id'"))
			{
				$myfun->redirect("login.php?p_id=manage_blog_subscribers","Subscriber has been deleted successfully.");
			}
			break;
	}
}
else
{
	$blog_id=$_REQUEST['id'];
	$row_blog=$blg->showBlog($blog_id);
	
	?>
    <h1>Email Blog to Subscribers: <?php echo stripslashes($row_blog['blog_title']); ?></h1>
    <div class="clearboth"></div>
    <div class="breadcrumb">
        <a href="login.php">Dashboard</a> &raquo; News &raquo; <a href="login.php?p_id=manage_blogs"> All News </a> &raquo; <?php echo stripslashes($row_blog['blog_title']); ?>
    </div>
	<?php
    $myquery_blog_subscribers=$blg->isSubscribed();
	if(count($myquery_blog_subscribers))
	{
		?>
        <div class="info">
        	Select the subscribers those you wish to email the blog to.
        </div>
        <form method="post" action="">
        <div style="padding: 10px 0 0 10px;border:#EEE 1px solid;">
        	<script>
			$(function(){
				$('#select_all').click(function(){
					if($(this).is(':checked')){
						$('.checkboxes').prop('checked','checked');	
					}
					else{
						$('.checkboxes').removeAttr('checked');	
					}
				});	   
			});
			</script>
               
			<div style="float:left;width:200px;margin: 0 10px 10px 0;padding:10px;border:#DDD 1px solid;background:#EEE;">
                <label><input type="checkbox" id="select_all" checked /> Select All Subscribers</label>
            </div>    
            <div class="clearboth"></div>
            <?php
			$sn=0;
            foreach($myquery_blog_subscribers as $row_blog_subscriber)
            {
				$sn++;	
                ?>
                <div style="float:left;width:205px;margin: 0 10px 10px 0;padding:10px;border:#DDD 1px solid;background:#EEE;">
                	<label><input type="checkbox" name="subscribers['<?php echo stripslashes($row_blog_subscriber['blog_subscriber_email']); ?>']" class="checkboxes" checked  /> &nbsp; <?php echo stripslashes($row_blog_subscriber['blog_subscriber_name']); ?><br /><?php echo stripslashes($row_blog_subscriber['blog_subscriber_email']); ?></label>
                </div>    
                <?php
				if($sn%4==0){
					?>
                    <div class="clearboth"></div>
                    <?php
				}
				
            }
            ?>
            <div class="clearboth"></div>
        </div>
        <div style="margin-top:10px;padding: 10px;border:#EEE 1px solid;">
     
        <input type="hidden" name="blog_id" value="<?php echo $row_blog['blog_id']; ?>">
        
        <textarea name="email_content_desc" class="myeditor" rows="2" >
    
       <p>We have published a new post on our website: <?php echo stripslashes($row_blog['blog_title']); ?></p>
       <p>You may view the latest post at <?php echo SITE_URL; ?>news-detail/<?php echo $row_blog['blog_alias']; ?>.</p>
       <p>You received this e-mail because you asked to be notified when new updates are posted.</p>            
       </textarea>
        <input type="hidden" name="action_email_content" value="1">
        <br>
        <div class="common"><input type="submit" name="submit" value="Send" style="padding:3px 14px;" class="mybtn"></div>
        <div style="clear:both;"></div>
        </div>
       </form>
        
        <?php
	}
	else
	{
		?>
        <p style="margin-top:20px;">Currently no subscriber is available.</p>
        <?php	
	}
}
?>