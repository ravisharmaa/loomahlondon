<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");

// echo $_POST['product_id']; exit;
if(isset($_POST['product_id']))
{
	$pro->saveProduct();
	$pro->save_order_qty();

	//foreach($_POST['attribute_name'] as $attribute_id => $val)
	//{
		//$pro->updateAttribute($attribute_id,$_POST['attribute_name'][$attribute_id],$_POST['attribute_value'][$attribute_id]);	
	//}
	//$attribute=$pro->addAttribute();

}
?>
