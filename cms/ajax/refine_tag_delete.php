<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$rfn->deleteRefineTag($_POST['id']);
$delall=$rfn->showRefineTagFromRelation($_POST['id']);
if(count($delall)){
	foreach($delall as $deleach){
		$pro_id=$deleach['product_id'];
		$rfn->delRefineTagInRelationTable($pro_id,$_POST['id']);
	}
}
?>