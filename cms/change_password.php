<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
if(isset($_POST['submitted']) and $_POST['submitted']=="Change Password")
{
	$ret=$adm->updatePassword();
	if($ret=="Your password is successfully changed.")
	{
		$msg=$ret;	
	}
	else
	{
		$err=$ret;	
	}
}
?>
<div class="myform1">
	<h1>Change Password</h1>
    <div class="clearboth"></div>
    <div class="breadcrumb"><a href="login.php">Dashboard</a> &raquo; Change Password </div>
	<?php
    if(isset($err) and !empty($err))
	{
		?>
    	<div class="err"><?php echo $err; ?></div>
    	<?php
	}
	else if(isset($msg) and !empty($msg))
	{
		?>
    	<div class="ok"><?php echo $msg; ?></div>
    	<?php
	}
	else
	{
		?>
    	<div class="info">Frequently changing your login password helps you keep your website secure.</div>
    	<?php	
	}
	?>
    <div style="border:#CCC 1px solid;padding:20px 0;">
        <form action="" method="post">
        <div class="formleft">Current Password</div>
        <div class="formright"><input type="password" name="password1" size="30" value="" /></div>
        <div class="clearboth"></div>
        <div class="formleft">New Password</div>
        <div class="formright"><input type="password" name="password2" size="30" value="" /></div>
        <div class="clearboth"></div>
        <div class="formleft">Confirm Password</div>
        <div class="formright"><input type="password" name="password3" size="30" value="" /></div>
        <div class="clearboth"></div>
        <div class="formleft">&nbsp;</div>
        <div class="formright"><input type="submit" name="submitted" value="Change Password" class="mybtn" />
        <input type="hidden" name="user_name" value="<?php echo $_SESSION['nicolalawrence_admin']['admin_username']; ?>" class="mybtn" /></div>
        <div class="clearboth"></div>
        </form>
	</div>        
</div>
