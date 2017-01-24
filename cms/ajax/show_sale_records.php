<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:../index.php");
	exit;
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
$myroot="../../";
include_once($myroot."config/config.php");
//$myquery_sale=$mydb->select_sql(array("*"),"tbl_sales s join tbl_sale_billingshippings bs on s.sale_id=bs.sale_id","s.payment_status=1 and s.cancel_status=0 and (bs.billing_lastname like '%".$_POST['mysearch']."%' or bs.billing_firstname like '%".$_POST['mysearch']."%')");

$myquery_sale=$pro->showAllSearchResults();
if(count($myquery_sale))
{
    $sn=0;
	foreach($myquery_sale as $row_sale)
    {
	$sale_id=$row_sale['sale_id'];
    $row_sale_id=$pro->showEachSales($sale_id);
	  
	$date = strtotime($row_sale_id['sale_date']);
	if($pro->showAllActiveResults($sale_id))
	{
  
        ?>
         <tr>
            <td align="center"><?php echo ++$sn; ?>.</td>
            <td><?php echo ucfirst(stripslashes($row_sale['billing_firstname'])); ?> <?php echo ucfirst(stripslashes($row_sale['billing_lastname'])); ?></td>
            <td align="center"><?php echo date("j F Y",$date); ?></td>
            <td align="center"><?php echo $row_sale_id['dispatch_status']==0?"Pending":"Dispatched"; ?></td>
            <td align="center"><a href="manage_orders.php?id=<?php echo $row_sale['sale_id']; ?>" class="fancybox fancybox.ajax">View Details</a></td>
        </tr>
        <?php
	}
	}
   
}
else
{
	?>
    <tr>
    	<td colspan="5" align="center"><br /><br />No record found.<br /><br /></td>
    </tr>
    <?php	
}
?>