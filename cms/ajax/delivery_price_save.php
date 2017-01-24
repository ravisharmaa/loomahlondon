<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
//echo $_POST['d_id'];
if(isset($_POST['d_id']))
{
	foreach($_POST['delivery_price_aus_less_than_three'] as $d_id => $val)
	{

	$pro->updateDeliveryPrices($d_id,$_POST['delivery_price_aus_less_than_three'][$d_id],$_POST['delivery_price_aus_more_than_three'][$d_id],$_POST['delivery_price_nz_less_than_three'][$d_id],$_POST['delivery_price_nz_more_than_three'][$d_id]);	
	}
}
/*if(isset($_POST['dimension_id']))
{
	foreach($_POST['delivery_price'] as $dimension_id => $val)
	{

	$pro->updateDeliveryPricesMD($dimension_id,$_POST['delivery_price'][$dimension_id],$_POST['delivery_price_more_than_three'][$dimension_id],$_POST['delivery_price_nz'][$dimension_id],$_POST['delivery_price_nz_more_than_three'][$dimension_id]);	
	}
}
*/
?>
