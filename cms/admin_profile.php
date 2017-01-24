<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
error_reporting(0);
?>
<h1>Admin Profile</h1>
<div class="clearboth"></div>
<?php
$admin_id=$_SESSION['nicolalawrence_admin']['admin_id'];
if(isset($_POST['submitted']))
{
	switch($_POST['submitted'])
	{
		case "Save":
			//foreach($_POST as $key => $val)	{ echo "$".$key."=addslashes($"."_POST['".$key."']);<br />"; } exit;
			$admin_fullname=addslashes($_POST['admin_fullname']);
			$admin_email=addslashes($_POST['admin_email']);
			$admin_username=addslashes($_POST['admin_username']);
			$err=0;
			if(strlen(trim($admin_fullname))==0)
			{
				$err+=1;
				$err_fullname="Please enter the full name.";	
			}
			$regexp_email="/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
			if(!preg_match($regexp_email,$admin_email))
			{
				$err+=1;
				$err_email="Please enter the valid email address.";
			}
			//else
			//{
			//	if($allcnt->checkAdminEmail($admin_email, $admin_id))
			//	{
			//		$err+=1;
			//		$err_email="Provided email address is already taken.";
			//	}
			//}
			$regexp_username="/^[A-z0-9_]+$/";
			if(!preg_match($regexp_username,$admin_username))
			{
				$err+=1;
				$err_username="Please enter the valid username.";
			}
			//else
			//{
			//	if($allcnt->checkAdminEmail($admin_username, $admin_id))
			//	{
			//		$err+=1;
			//		$err_username="Provided username is already taken.";
			//	}
		//	}
			if($err==0)
			{
				$update=$adm->updateNormalUser($admin_id)
				
					?>
                    <div class="ok">Your profile details is successfully updated.</div>
                    <?php
				
			}
			else
			{
				?>
                <div class="err">Please provide your details as marked in red.</div>
                <?php
			}
			break;	
	}
}
else
{
	$admin_fullname="";
	$admin_email="";
	$admin_username="";
	?>
	<div class="info">Change the profile details that you have created.</div>
    <?php
}
//$myquery_admin=$mydb->select_sql(array("*"),"tbl_admin","admin_id='$admin_id'");
//$row_admin=$mydb->fetch_array($myquery_admin);
$row_admin=$adm->getaAdmin($admin_id);
if(!isset($err))
{
	$admin_fullname=stripslashes($row_admin['admin_fullname']);
	$admin_email=stripslashes($row_admin['admin_email']);
	$admin_username=stripslashes($row_admin['admin_username']);
	$admin_type=$row_admin['admin_type'];
}
?>
<form action="" method="post">
<table border="0" class="myform">
<tr>
	<td class="formleft">Full Name</td>
	<td class="formright"><input type="text" name="admin_fullname" size="50" value="<?php echo $admin_fullname; ?>" /> <?php if(isset($err_fullname)) echo "<span class='err1'>".$err_fullname."</span>"; ?></td>
</tr>
<tr>
	<td class="formleft">Email Address</td>
	<td class="formright"><input type="text" name="admin_email" size="50" value="<?php echo $admin_email; ?>" /> <?php if(isset($err_email)) echo "<span class='err1'>".$err_email."</span>"; ?></td>
</tr>
<tr>
	<td class="formleft">Username</td>
	<td class="formright"><input type="text" name="admin_username" size="50" value="<?php echo $admin_username; ?>" /> <?php if(isset($err_username)) echo "<span class='err1'>".$err_username."</span>"; ?></td>
</tr>
<tr>
	<td class="formleft">&nbsp;</td>
	<td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /></td>
    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>"  />
</tr>
</table>
</form>
