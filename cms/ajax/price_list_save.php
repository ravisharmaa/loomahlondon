<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
//echo $_POST['product_id'];
if(isset($_POST['product_id']))
{
	foreach($_POST['price_per_meter'] as $product_id => $val)
	{

	$pro->updatePrices($product_id,$_POST['price_per_meter'][$product_id],$_POST['sample_price'][$product_id]);	
	}
}
if(isset($_POST['dimension_id']))
{
	foreach($_POST['price'] as $dimension_id => $val)
	{

	$pro->updateMultDimensionPrices($dimension_id,$_POST['price'][$dimension_id]);	
	}
}
?>
