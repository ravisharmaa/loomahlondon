<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$pro->delColourwaysImageWithPro($_POST['id']);
$pro->delProduct($_POST['id']);


$delall=$pro->showCompatibleProductsFromRelation($_POST['id']);
if(count($delall)){
	foreach($delall as $deleach){
		$pro_id=$deleach['product_id'];
		$pro->delProductCompatibleInRelationTable($pro_id,$_POST['id']);
	}
}
$delrefinetags=$rfn->showRefinedTagsForProducts($_POST['id']);
if(count($delrefinetags)){
	foreach($delrefinetags as $delrefinetag){
		$refine_tag_id=$delrefinetag['refine_tag_id'];
		$rfn->removeRefinedTag($refine_tag_id,$_POST['id']);
	}
}


?>