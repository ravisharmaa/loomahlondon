<?php
$todaysdate = date("Y-m-d");
error_reporting(0);
$myroot="../";
include_once($myroot."config/config.php");
include_once('../class.phpmailer.php');
foreach($_POST['subscribers'] as $email_address=>$value)
{ 
	//print_r($_POST['subscribers']);
	$mail= new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host ='doublarddesign.com'; // SMTP server

	$subject="We have published a new 'News' item.";
	$email_address=str_replace("'","",$email_address);
	$get_subscriber=$blg->checkSubscribedEmail($email_address);
	$body="<html><head><style type='text/css'>
						body{
							font-size: 10pt; 
							font-family: arial;
						} 
						td{
							font-size: 10pt;
						}
						</style>
		</head>
		<body>
		<table width='600' align='center'  cellpadding='0' cellspacing='0'>

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
			<tr>
				<td>Dear ".$get_subscriber['blog_subscriber_name']."<br /><br />".$email_content."</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Kind regards</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Nicola Lawrence</td></tr>
			<tr><td>&nbsp;</td></tr>
		<tr><td><img src='".SITE_URL."img/nicola-lawrence.png' border='0' width='250'/></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href='mailto:nicola@nicolalawrence.com.au' style='text-decoration: none; color:#000;'>nicola@nicolalawrence.com.au</a></td></tr>
        <tr><td><a href='http://www.nicolalawrence.com.au' style='text-decoration: none; color:#000;'>www.nicolalawrence.com.au</a></td></tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
			</table>
			</body>
			</html>";	
			$mail->From       = 'info@nicolalawrence.com.au';
			$mail->FromName   = 'Nicola Lawrence';
			$mail->Subject    = $subject;
			$mail->MsgHTML($body);
			$mail->AddAddress($email_address,$email_address);
			if(!$mail->Send()) 
			{
				echo "Mailer Error: " . $mail->ErrorInfo;
			}
			else
			{
				//echo "Message sent!";
			} 
			$mail->ClearAddresses();
			
}
//echo $subslist["semail"];
?>