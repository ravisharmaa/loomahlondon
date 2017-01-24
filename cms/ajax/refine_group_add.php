<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['refine_group_name']))
{
	echo $rfn->addRefineGroup();
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add Refine Group</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the group name that you wish to add.
    </div>
    <form id="form_refine_group_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Group Name</td>
        <td class="formright"><input type="text" name="refine_group_name" value="" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn refine_group_save" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    </form>
    <script>
	$(function(){
		$('.refine_group_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/refine_group_add.php',
				type: 'post',
				data: $('#form_refine_group_add').serialize(),
				success: function(id){
					$(location).attr('href','login.php?p_id=manage_refine_tags&id='+id);
				}
			})
		});
	});
	</script>
</div>