<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:../index.php");
	exit;
}
ini_set('display_errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
$myroot="../../";
include_once($myroot."config/config.php");
if($_POST['order_by']=="names")
{
	if($_POST['my_order']=="asc")
		$q=" order by bs.billing_lastname asc, bs.billing_firstname asc";
	else
		$q=" order by bs.billing_lastname desc, bs.billing_firstname desc";
}
else if($_POST['order_by']=="status")
{
	$q=" order by s.dispatch_status";
	if($_POST['my_order']=="pending")
		$q.=" desc";
	else
		$q.=" asc";
}
else
{
	$q="sale_date";
	if($_POST['my_order']=="asc")
		$r=" asc";
	else
		$r=" desc";	
}
echo $q; 
echo $r;
exit;
$myquery_sale=$mydb->select_sql(array("*"),"tbl_sales s join tbl_sale_billingshippings bs on s.sale_id=bs.sale_id","s.payment_status=1 and s.cancel_status=0".$q);
if($mydb->count_row($myquery_sale)>0)
{
    $sn=0;
    while($row_sale=$mydb->fetch_array($myquery_sale))
    {
        ?>
        <tr>
            <td align="center"><?php echo ++$sn; ?>.</td>
            <td><?php echo stripslashes($row_sale['billing_lastname']); ?>, <?php echo stripslashes($row_sale['billing_firstname']); ?></td>
            <td align="center"><?php echo $myfun->myDateTime("d M-d, h:i a",$row_sale['sale_date']); ?></td>
            <td align="center"><?php echo $row_sale['dispatch_status']==0?"Pending":"Dispatched"; ?></td>
            <td align="center"><a href="manage_orders.php?id=<?php echo $row_sale['sale_id']; ?>" class="fancybox fancybox.ajax">View Order Details</a></td>
        </tr>
        <?php
    }
}
else
{
	?>
    <tr>
    	<td colspan="5" height="50" align="center">No record found.</td>
    </tr>
    <?php	
}
?>