<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['parent_id']))
{
	echo $cnt1->addContent($_POST['parent_id']);
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add Page</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the page name that you wish to add.
    </div>
    <form id="form_content_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Page Name</td>
        <td class="formright"><input type="text" name="content_name" value="" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn content_save" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="parent_id" value="<?php echo $_REQUEST['id']; ?>" />
    </form>
    <script>
	$(function(){
		$('.content_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/content_add.php',
				type: 'post',
				data: $('#form_content_add').serialize(),
				success: function(id){
					$(location).attr('href','login.php?p_id=manage_content&id='+id);
				}
			})
		});
	});
	</script>
</div>