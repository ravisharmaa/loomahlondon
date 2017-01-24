<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['refine_group_id']))
{
	$rfn->addRefineTag();
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add Refine Tag</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the tag name that you wish to add.
    </div>
    <form id="form_refine_tag_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Tag Name</td>
        <td class="formright"><input type="text" name="refine_tag_name" value="" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn refine_tag_save" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="refine_group_id" value="<?php echo $_REQUEST['id']; ?>" />
    </form>
    <script>
	$(function(){
		$('.refine_tag_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/refine_tag_add.php',
				type: 'post',
				data: $('#form_refine_tag_add').serialize(),
				success: function(){
					$('.saving').hide();
					t.show();
					$.fancybox.close();
				}
			});
		});
	});
	</script>
</div>