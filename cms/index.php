<?php
session_start();
if(isset($_SESSION['nicolalawrence_admin']['admin_login']) and $_SESSION['nicolalawrence_admin']['admin_login']==md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:login.php");
	exit;
}
$myroot="../";
include_once($myroot."config/config.php");
if(isset($_POST['submitted']) and $_POST['submitted']=="Login")
{	
	//if(isset($_SESSION['security_code_cms']) and $_SESSION['security_code_cms']==addslashes($_POST['security_code_cms']))
	//{
		if(preg_match("/^[a-zA-Z0-9_]{3,16}$/",$_POST['admin_username']))
		{
			if($row1=$adm->adminLogin())
			{
				$_SESSION['nicolalawrence_admin']['admin_login']=md5($row1['admin_password'].session_id());
				$_SESSION['nicolalawrence_admin']['admin_id']=$row1['admin_id'];
				$_SESSION['nicolalawrence_admin']['admin_username']=$row1['admin_username'];
				$_SESSION['nicolalawrence_admin']['admin_password']=$row1['admin_password'];
				$_SESSION['nicolalawrence_admin']['admin_fullname']=$row1['admin_fullname'];
				$_SESSION['nicolalawrence_admin']['admin_type']=$row1['admin_type'];
				$fun->redirect("login.php");
			}
			else
			{
				$msg="Invalid username or password.";
			}
		}
		else
		{
			$msg="Invalid username or password.";
		}
	//}
//	else
	//{
		//$msg="Security code is incorrect.";	
	//}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content Management System | <?php echo SITE_NAME; ?></title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link href="css/mystyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">
	<div class="headerlogin"></div>
    <form action="" method="post">
    <div class="login">
    	<h1 class="login-logo"><?php echo SITE_NAME; ?></h1>
        <?php
		if(isset($msg) and !empty($msg))
		{
			?>
        	<div class="label_login" style="color:#900;" ><?php echo $msg; ?></div>
        	<?php
		}
		?>
        <div class="label_login">Username: </div>
        <div class="txtfield_login"><input class="txtfield_input" style="padding:2px 5px; border: 1px solid #ab9b94;" type="text" name="admin_username" value="" /></div>
        <div class="label_login">Password: </div>
        <div class="txtfield_login"><input class="txtfield_input" style="padding:2px 5px;border: 1px solid #ab9b94;" type="password" name="admin_password" value="" /></div>
        <?php /*?><div class="label_login">Security Code: </div>
        <div class="captchafield_login">
        	<img src="<?php echo SITE_URL;?>cms/captcha/captchaSecurityImagesNLCms.php?width=100&height=28&characters=4" style="float:left;" />
            <input type="text" name="security_code_cms" value="" style="width:80px; float:left; margin-left:6px;border: 1px solid #ab9b94;" />
        	<div class="clearboth"></div>
        </div><?php */?>
        <div class="btnfields"><input class="btnfield_input" type="submit" name="submitted" value="Login" style="border: 1px solid #ab9b94;" /> <a href="forgot-password.php" style="text-decoration:none;">Forgot Password?</a></div>
    </div>
  </form><br />
</div>
</body>
</html>
