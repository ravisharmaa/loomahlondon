<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$csd->delCaseStudy($_POST['id']);
$allparts=$csd->showAllPartsCaseStudy($_POST['id']);
foreach($allparts as $eachparts)
{
	$casestudypartid=$eachparts['casestudy_part_id'];
	$csd->deleteCaseStudyPart($casestudypartid);
}

?>