<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:../index.php");
	exit;
}
error_reporting(0);
$myroot="../../";
include_once($myroot."config/config.php");
include_once('../../class.phpmailer.php');
$sale_id=$_POST['id'];
$dispatch_status=1;
$dispatch_date=date("Y-m-d h:i:sa");
$dispatch_note=addslashes($_POST['mynote']);

$htmlFile = SITE_URL."cms/delivery_invoice.php?id=".$sale_id; 
$content = file_get_contents($htmlFile); 
require_once(dirname(__FILE__).'/../../html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$filename="nl-inv-".time()."-".$sale_id.".pdf";
$dispatch_pdf="../../invoices/".$filename;
$html2pdf->Output($dispatch_pdf,'F');

$row_delivery=$pro->showSaleBillingShippingAddress($sale_id);
$row_orders=$pro->showAllSaleOrders($sale_id);
if(count($row_orders)>1){
	$s="s";
}
else{
	$s="";
}

$delivery_fname=stripslashes($row_delivery['shipping_firstname']);
$delivery_lname=stripslashes($row_delivery['shipping_lastname']);
$delivery_email=stripslashes($row_delivery['shipping_email']);

$message="<html><head><style type='text/css'>
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
	<td align='center'>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>Dear  ".$delivery_fname."</td>
</tr>    
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>The order you placed with Nicola Lawrence has been dispatched. Please find attached a copy of your receipt.</td>
</tr>


<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>Kind regards<br /><br />Nicola Lawrence</td>
</tr>
<tr>
	<td><img src='".SITE_URL."img/nicola-lawrence.png' border='0' width='250'/></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td><a href='mailto:nicola@nicolalawrence.com.au' style='text-decoration: none; color:#000;'>nicola@nicolalawrence.com.au</a></td></tr>
<tr><td><a href='http://www.nicolalawrence.com.au' style='text-decoration: none; color:#000;'>www.nicolalawrence.com.au</a></td></tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td><span style='color: #9a9a9a;'>Please do not reply to this email. This mailbox is not monitored and you will not receive a response.</span></td>
</tr>
</table>
</body>
</html>";

$subject="Nicola Lawrence: Dispatch Receipt";
$mail= new PHPMailer();
$mail->IsSMTP();
$mail->Host = "doublarddesign.com"; // SMTP server
$mail->From = "sales@nicolalawrence.com.au";
$mail->FromName = "Nicola Lawrence";
$mail->Subject = $subject;
$mail->MsgHTML($message);
$mail->AddAddress($delivery_email,$delivery_fname);
$mail->AddAttachment($dispatch_pdf);

if(!$mail->Send())
{
	//echo "Mailer Error: " . $mail->ErrorInfo;
	
}
else
{
	//echo "Message sent!";
}

$mail->ClearAddresses();
$pro->updateDispatchSucess($sale_id,$filename);

echo SITE_URL."invoices/".$filename;

?>
