<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$admin_code=$adm->generateRandomCode(30);            
if(isset($_POST['submitted']) and $_POST['submitted']=="Add")
{
	$addadmin=$adm->addAdmin();
		echo "<script language='javascript'>document.location='login.php?p_id=admin_users'</script>";
}
if(isset($_POST['submitted']) and $_POST['submitted']=="Update")
{
	$admin_id=$_POST['admin_id'];
	$addadmin=$adm->updateAdmin($admin_id);
	echo "<script language='javascript'>document.location='login.php?p_id=admin_users'</script>";
}
if(isset($_REQUEST['act']))
{
	switch($_REQUEST['act'])
	{
		case "add":
			?>
            <h1>Add New User</h1>
             <div class="goback"><a href="login.php?p_id=admin_users">Back to User Profile</a></div>
			<div class="clearboth"></div>
<div class="breadcrumb"> <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=admin_users">User Profile</a> &raquo; Add New User </div>

	<div class="clearboth"></div>
			<div class="info">Provide the details for the user that you want to create.</div>
            <form action="" method="post">
            <script>
$(function(){
	$('.mybtn').click(function(){
		var admin_email=$('#admin_email').val();
		var admin_username=$('#admin_username').val();
		var admin_password1=$('#admin_password1').val();
		var admin_password2=$('#admin_password2').val();
		var admin_type=$('#admin_type').val();
		
		var filter=/^((([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+(\.([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+)*)@((((([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.))*([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.)[\w]{2,4}|(((([0-9]){1,3}\.){3}([0-9]){1,3}))|(\[((([0-9]){1,3}\.){3}([0-9]){1,3})\])))$/;
		if(!filter.test(admin_email)){
			alert('Please enter the valid email address.');
			$('#admin_email').focus();
			return false;
		}
		else if(admin_username==''){
			alert('Please enter your username.');
			$('#admin_username').focus();
			return false;
		}
			else if(admin_password1==''){
			alert('Your password is empty.');
			$('#admin_password1').focus();
			return false;
		}
		else if(admin_password2==''){
			alert('Your confirmed password is empty.');
			$('#admin_password2').focus();
			return false;
		}
		else if(admin_password1!=admin_password2){
			alert('Your passwords didnot matched');
			$('#message').focus();
			return false;
		}
			else if(admin_type==''){
			alert('Select user type');
			$('#admin_type').focus();
			return false;
		}

	});	   
});
</script>
            <table border="0" class="myform">
            <tr>
            	<td class="formleft">Full Name</td>
                <td class="formright"><input type="text" name="admin_fullname" size="50" /></td>
            </tr>
            <tr>
            	<td class="formleft">Email Address</td>
                <td class="formright"><input type="text" name="admin_email" id="admin_email" size="50"/></td>
            </tr>
            <tr>
            	<td class="formleft">Username</td>
                <td class="formright"><input type="text" name="admin_username" id="admin_username" size="50" /> </td>
            </tr>
            <tr>
            	<td class="formleft">Password</td>
                <td class="formright"><input type="password" name="admin_password1" id="admin_password1" size="50" value="" /></td>
            </tr>
            <tr>
            	<td class="formleft">Confirm Password</td>
                <td class="formright"><input type="password" name="admin_password2" id="admin_password2" size="50" value="" /></td>
            </tr>
            <tr>
            	<td class="formleft">Type</td>
                <td class="formright"><select name="admin_type" id="admin_type" style="width:200px;">
                    <option value=""> - - Select User Type - - </option>
                    <option value="Admin">Admin User</option>
                    <option value="Normal" >Normal User</option>
				</select></td>
            </tr>
            <tr>
            	<td class="formleft">&nbsp;</td>
                <td class="formright"><input type="submit" name="submitted" value="Add" class="mybtn add" />
           
                <input type="hidden" name="code" value="<?php echo $admin_code; ?>" />
                </td>
            </tr>
            </table>
            </form>
            </div>
			<?php
			break;
		case "edit":
		$admin_id=$_REQUEST['id'];
		$select=$adm->getaAdmin($admin_id)
			?>
			    <h1>Edit User</h1>
             <div class="goback"><a href="login.php?p_id=admin_users">Back to User Profile</a></div>
			<div class="clearboth"></div>
<div class="breadcrumb"> <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=admin_users">User Profile</a> &raquo; Edit User </div>
			<div class="info">Change the details for the user that you have created.</div>
            <form action="" method="post">
            <script>
$(function(){
	$('.update').click(function(){
			var update_email=$('#update_email').val();
					var filter=/^((([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+(\.([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+)*)@((((([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.))*([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.)[\w]{2,4}|(((([0-9]){1,3}\.){3}([0-9]){1,3}))|(\[((([0-9]){1,3}\.){3}([0-9]){1,3})\])))$/;
			if(!filter.test(update_email)){
				alert('Please enter the valid email address.');
				$('#update_email').focus();
				return false;
			}
			/*var admin_password1=$('#admin_password1').val();
			var admin_password2=$('#admin_password2').val();
		
		
				   if(admin_password1==''){
						alert('Your new password is empty.');
						$('#admin_password1').focus();
						return false;
					}
					else if(admin_password2==''){
						alert('Your confirmed password is empty.');
						$('#admin_password2').focus();
						return false;
					}
					else if(admin_password1!=admin_password2){
						alert('Your passwords didnot matched');
						$('#admin_password2').focus();
						return false;
					}*/
			
	});	   
});
</script>

            <table border="0" class="myform">
            <tr>
            	<td class="formleft">Full Name</td>
                <td class="formright"><input type="text" name="admin_fullname" size="50" value="<?php echo $select['admin_fullname']; ?>" /> </td>
            </tr>
            <tr>
            	<td class="formleft">Email Address</td>
                <td class="formright"><input type="text" name="update_email" id="update_email" size="50" value="<?php echo $select['admin_email']; ?>" /> </td>
            </tr>
            <tr>
            	<td class="formleft">Username</td>
                <td class="formright"><input type="text" name="admin_username" size="50" value="<?php echo $select['admin_username']; ?>" /></td>
            </tr>
   <?php /*?> <tr>
            	<td class="formleft">Password</td>
                <td class="formright"><input type="password" name="admin_password1" id="admin_password1" size="50" value="" /> </td>
            </tr><?php */?>
            <input type="hidden" name="admin_password1"  value="" /> 
            <tr>
            	<td class="formleft">New Password</td>
                <td class="formright"><input type="password" name="admin_password2" id="admin_password2"  size="50" value="" /></td>
            </tr>
            <tr>
            	<td class="formleft">Type</td>
                <td class="formright"><select name="admin_type" style="width:200px;">
                    <option value=""> - - Select User Type - - </option>
                    <option value="Admin" <?php if($select['admin_type']=="Admin") echo "selected";?>>Admin User</option>
                    <option value="Normal" <?php if($select['admin_type']=="Normal") echo "selected";?>>Normal User</option>
				</select></td>
            </tr>
            <tr>
            	<td class="formleft">&nbsp;</td>
                <td class="formright"><input type="submit" name="submitted" value="Update" class="mybtn update" /></td>
            </tr>
            </table>
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>" />
             <input type="hidden" name="code" value="<?php echo $admin_code; ?>" />
          
            </form>
            </div>
            <?php
         break;
		case "del":
			
			$admin_id=$_REQUEST['id'];
			$delete=$adm->delAdmin($admin_id);
			echo "<script language='javascript'>document.location='login.php?p_id=admin_users'</script>";
		
	}
}
else
{
	?>
    			    <h1>User Profile</h1>
        			<div class="clearboth"></div>
<div class="breadcrumb"> <a href="login.php">Dashboard</a> &raquo; User Profile </div>
	<div class="myadd"><a href="login.php?p_id=admin_users&act=add">Add New User</a></div>
	<table border=0 class='mytab'>
	<tr>
		<th width="30" align=center>SN</th>
		<th align="left">Username</th>
		<th align="left">Full Name [ E-mail Address ]</th>
		<th width="100">User Type</th>
		<!-- <th width="100" align=center>Status</th> -->
        <th width="30" align=center>Edit</th>
        <th width="30" align=center>Del</th>
	</tr>
	

<?php
$adminstatus=0;
$aadmin=$adm->getUsers($adminstatus);
if($aadmin)
{
$sn=0;
	foreach($aadmin as $row_admin)
	{	
		?>
		<tr>
			<td align="center"><?php echo ++$sn; ?>.</td>
			<td><?php echo stripslashes($row_admin['admin_username']); ?></td>
			<td><?php echo stripslashes($row_admin['admin_fullname']); ?> [ <?php echo stripslashes($row_admin['admin_email']); ?> ]</td>
			<td align="center"><?php echo stripslashes($row_admin['admin_type']); ?> User</td>
			<td align=center><a href='login.php?p_id=admin_users&act=edit&id=<?php echo $row_admin['admin_id']; ?>'><img src="images/icon_edit.png" height="20" border="0" /></a></td>
            <td align=center><a href="JavaScript:delRecord('login.php?p_id=admin_users&act=del&id=<?php echo $row_admin['admin_id']; ?>','Are you sure you want to delete this admin?');"><img src="images/icon_delete.png" height="20" border="0" /></a></td>
		</tr>    
		<?php
	}
}
	?>
	</table>
    
	<?php
}
?>