<?php
session_start();
$myroot="../";
include_once $myroot."config/config.php";
if(isset($_POST['submitted']) and $_POST['submitted']=="Send")
{
	$ret=$adm->resetPassword();
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content Management System :: <?php echo SITE_NAME; ?></title>
<link rel="shortcut icon" href="../images/favicon.ico" />
<link href="<?php echo SITE_URL; ?>cms/css/mystyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">
	<div class="headerlogin"></div>


		 <?php if($_REQUEST['code'])
		 {
			 ?>
		
             <form action="" method="post">
    <div class="login">
   	    <h1  class="login-logo"><?php echo SITE_NAME; ?></h1>
        
                
           <?php
            if(isset($err) and !empty($err))
            {
                ?>
                <div class="err"><?php echo $err; ?></div><br />
                <?php
            }
            else if(isset($msg) and !empty($msg))
            {
                ?>
                <div class="label_login"><?php echo $msg; ?></div><br />
                <?php
            }
            else
            {
                ?>
                <div class="label_login">Reset your new password.</div>
                <?php	
            }
            ?>

            <div class="label_login">New Password: </div>
            <div class="txtfield_login"><input type="password" name="password1" valeu="" /></div>
             <div class="label_login">Confirm Password: </div>
            <div class="txtfield_login"><input type="password" name="password2" valeu="" /></div>
            <div class="label_login">Security Code: </div>
            <div class="captchafield_login">
                <img src="<?php echo SITE_URL; ?>captcha/captchaSecurityImages.php?width=100&height=27&characters=5"  style="float:left;"/>
                <input type="text" name="security_code" valeu="" style="width:80px; float:left; margin-left:6px;border: 1px solid #ab9b94;"  />
                <div class="clearboth"></div>
            </div>
            <div class="btnfields"><input type="submit" name="submitted" value="Send"  class="btnfield_input"/><a href="<?php echo SITE_URL;?>cms">Back to login page</a></div>
            <input type="hidden" name="code" value="<?php echo $_REQUEST['code']; ?>" /> 
          
    </div>
    </form>
        <?php
		 }
		 ?>

	
    </div>

</body>
</html>