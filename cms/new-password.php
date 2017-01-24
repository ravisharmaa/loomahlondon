<?php
session_start();
if(isset($_SESSION['nicolalawrence_admin']['admin_login']) and $_SESSION['nicolalawrence_admin']['admin_login']==md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:login.php");
	exit;
}
$myroot="../";
include_once($myroot."config/config.php");
if(isset($_POST['submitted']) and $_POST['submitted']=="Change Password")
{	
	$admin_code=$_REQUEST['code'];
	$password2=addslashes($_POST['admin_password1']);
	$password3=addslashes($_POST['admin_password2']);
	if(!empty($password2))
	{
		if($password2==$password3)
		{
			$password2=$mysec->md5_encrypt($password2,$KEY);
			if($myquery=$mydb->update_sql("tbl_admin",array("admin_password","admin_code"),array($password2,''),"admin_code='$admin_code'"))
			{
				$myfun->redirect("index.php","New password has been successfully set.");
			}
		}
		else
			$msg="Invalid new passwords.";
	}
	else
		$msg="Invalid new passwords.";			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content Management System :: <?php echo SITE_NAME; ?></title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link href="css/mystyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">
	<div class="headerlogin"></div>
    <div class="login">
    	<h1><?php echo SITE_NAME; ?></h1>
        <?php
		if(isset($_REQUEST['code']))
		{
			$admin_code=$_REQUEST['code'];
			$myquery1=$mydb->select_sql(array("*"),"tbl_admin","admin_code='$admin_code' and admin_status=1");
			if($mydb->count_row($myquery1)==1)
			{
				$row1=$mydb->fetch_array($myquery1);
				if(isset($msg))
				{
					?>
					<div class="err"><?php echo $msg; ?></div>
					<?php
				}
				else
				{
					?>
					<div class="info">Provide your new password</div>
					<?php
				}
				?>
				<form action="" method="post">
				<div class="label">Username: </div>
				<div class="txtfield"><input type="text" value="<?php echo $row1['admin_username']; ?>" disabled="disabled" /></div>
				<div class="label">New Password: </div>
				<div class="txtfield"><input type="password" name="admin_password1" value="" /></div>
				<div class="label">Confirm Password: </div>
				<div class="txtfield"><input type="password" name="admin_password2" value="" /></div>
				<div class="btnfield"><input type="submit" name="submitted" value="Change Password" /></div>
				</form>
                <?php
			}
			else
			{
				?>
                <div class="err">Invalid Attempt</div>
                <p>Either you are invalid user to this system or your request expires.</p>
                <br />
                <p><a href="forgot-password.php">Please try again.</a></p>
                <br />
                <br />
                <br />
                <br />
                <br />
                <?php	
			}
		}
		else
		{
			?>
            <div class="err">Invalid Attempt</div>
            <p>Either you are invalid user to this system or your request expires.</p>
            <br />
            <p><a href="forgot-password.php">Please try again.</a></p>
            <br />
            <br />
            <br />
            <br />
            <br />
            <?php	
		}
		?>
	</div>
</div>
</body>
</html>
