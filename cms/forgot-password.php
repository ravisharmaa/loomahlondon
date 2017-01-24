<?php
session_start();
if(isset($_SESSION['nicolalawrence_admin']['admin_login']) and $_SESSION['nicolalawrence_admin']['admin_login']==md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:login.php");
	exit;
}
error_reporting(0);
$myroot="../";
include_once($myroot."config/config.php");
if(isset($_POST['submitted']) and $_POST['submitted']=="Send")
{	
	$admin_username=$_POST['admin_username'];
	$admin_status=0;
	//echo $_SESSION['security_code'].'--'.$_POST['security_code'];
	//exit;
	if(isset($_SESSION['security_code']) and $_SESSION['security_code']==$_POST['security_code'])
	{
				$row1=$adm->getCmsUsers($admin_username, $admin_status);
			 	$admin_email=$row1['admin_email'];
				$reset_link=SITE_URL."cms/reset-password/".$row1['admin_code'];
				$message="<table width='600' align='center'  cellpadding='0' cellspacing='0'><tr><td align='center'><img  align='center' src='".SITE_URL."img/nicola-lawrence.png' border='0' width='226'  /></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
<tr><td >Dear ".$row1['admin_username'].",<br /><br />
						
						<p>We are sending this email as you suggested that you have forgotten your password. <br>In order to reset your password, please click on the link below.</p>
						<p><a href='".$reset_link."'>".$reset_link."</a></p>	  <br /><br />
		 </td></tr></table>
		  ";	
		
				include_once('../class.phpmailer.php');
                $mail= new PHPMailer();
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->Host       = "doublarddesign.com"; // SMTP server
				$mail->From       ="info@nicolalawrence.com.au";
				$mail->FromName   = "Nicola Lawrence";
				$mail->Subject    = "Reset Password";
				$mail->MsgHTML($message);
				$mail->AddAddress($admin_email);
				if(!$mail->Send())
				{
					//echo "Mailer Error: " . $mail->ErrorInfo;
			
				} 
				else 
				{
					//echo "Message sent!";
				} 
				$mail->ClearAddresses();
			
    			echo "<script language='javascript'>document.location='forgot-password.php?error=1'</script>";
                die();
	}
		
 else{
	echo "<script language='javascript'>document.location='forgot-password.php?error=2'</script>";
	die();
	}
				
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content Management System | <?php echo SITE_NAME; ?></title>
<link rel="shortcut icon" href="../images/favicon.ico" />
<link href="css/mystyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">
	<div class="headerlogin"></div>
    <form action="" method="post">
    <div class="login">
    	<h1 class="login-logo"><?php echo SITE_NAME; ?></h1>
        <?php
		   if($_REQUEST["error"]==1)
      	   {?> <div class="label_login">Login details has been emailed.</div>
          <?php 
		  }
          else if($_REQUEST["error"]==2){?>
      <div class="label_login">Matching username not found!</div>
     <?php }
			
			?>
			<div class="label_login">Username: </div>
			<div class="txtfield_login"><input type="text" name="admin_username" valeu="" /></div>
			<div class="label_login">Security Code: </div>
			<div class="captchafield_login">
            <img src="../captcha/captchaSecurityImages.php?width=100&height=28&characters=5" style="float:left;" />
			
				<input type="text" name="security_code" valeu="" style="width:80px; float:left; margin-left:6px;border: 1px solid #ab9b94;"  />
				<div class="clearboth"></div>
			</div>
			<div class="btnfields"><input type="submit" class="btnfield_input" name="submitted" value="Send" style="border: 1px solid #ab9b94;" /> <a href="<?php echo SITE_URL;?>cms">Back to login page</a></div>


    </div>
    </form>
</div>
</body>
</html>
