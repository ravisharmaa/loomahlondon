<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$cat_id=$_REQUEST['id'];
$row_cat=$cat->showCategory($cat_id);
?>
<img src="../<?php echo CAT_IMG.$row_cat['cat_image']; ?>" width="200" />
