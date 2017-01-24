<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
?>
<h1>User Profile</h1>
<div class="info">View your profile details.</div>
<?php
$admin_id=$_SESSION['nicolalawrence_admin']['admin_id'];
$myquery_admin=$mydb->select_sql(array("*"),"tbl_admin","admin_id='$admin_id'");
$row_admin=$mydb->fetch_array($myquery_admin);
?>
<table border="0" class="myform">
<tr>
	<td class="formleft">Full Name</td>
	<td class="formright"><input type="text" size="50" value="<?php echo stripslashes($row_admin['admin_fullname']); ?>" readonly /></td>
</tr>
<tr>
	<td class="formleft">Email Address</td>
	<td class="formright"><input type="text" size="50" value="<?php echo stripslashes($row_admin['admin_email']); ?>" readonly /></td>
</tr>
<tr>
	<td class="formleft">Username</td>
	<td class="formright"><input type="text" size="50" value="<?php echo stripslashes($row_admin['admin_username']); ?>" readonly /></td>
</tr>
<?php
if($row_admin['admin_type']=="Departmental")
{
	?>
    <tr>
        <td class="formleft">Department</td>
        <td class="formright"><input type="text" size="50" value="<?php echo stripslashes($mydb->select_field("department_name","tbl_departments","department_id='".$row_admin['admin_department']."'")); ?>" readonly /></td>
    </tr>
    <?php
}
else
{
	?>
    <tr>
        <td class="formleft">Type</td>
        <td class="formright"><input type="text" size="50" value="Administrator" readonly /></td>
    </tr>
    <?php
}
?>
</table>
