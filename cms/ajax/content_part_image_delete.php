<?php
session_start();
if($_SESSION['thebritishschool_admin']['admin_login']!=md5($_SESSION['thebritishschool_admin']['admin_password'].session_id()))
{
	header("location:../index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$content_part_id=$_POST['id'];
$content_part_data2=$mydb->select_field("content_part_data2","tbl_content_parts","content_part_id='$content_part_id'");
if(!empty($content_part_data2) and file_exists($myroot.CONTENT_IMG.$content_part_data2))
{
	unlink($myroot.CONTENT_IMG.$content_part_data2);
	unlink($myroot.CONTENT_IMG_THUMB.$content_part_data2);
}
$mydb->update_sql("tbl_content_parts",array("content_part_data2"),array(""),"content_part_id='$content_part_id'");
?>