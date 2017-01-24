<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['blog_cat_name']))
{
	echo $blg->saveBlogCategory();
	exit;
}
$blog_cat_id=$_REQUEST['id'];
$row_blog_cat=$blg->showBlogCategory($blog_cat_id);
?>
<div class="container" style="margin:0;">
    <h1>Edot a Category</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the category name that you wish to update.
    </div>
    <form id="form_blog_cat_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Category Name</td>
        <td class="formright"><input type="text" name="blog_cat_name" value="<?php echo stripslashes($row_blog_cat['blog_cat_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn blog_cat_update" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="blog_cat_id" value="<?php echo $blog_cat_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.blog_cat_update').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/blog_cat_edit.php',
				type: 'post',
				data: $('#form_blog_cat_edit').serialize(),
				success: function(id){
					$('.saving').hide();
					t.show();
					$.fancybox.close();
				}
			})
		});
	});
	</script>
</div>