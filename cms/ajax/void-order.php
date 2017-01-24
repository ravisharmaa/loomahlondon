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
$sale_id=$_POST['id'];
$pro->updateCancelStatus($sale_id);
?>