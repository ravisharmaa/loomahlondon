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
	echo $blg->addBlogCategory();
	exit;
}
?>
<div class="container" style="margin:0;">
    <h1>Add a category</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the category name that you wish to add.
    </div>
    <form id="form_blog_cat_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Category Name</td>
        <td class="formright"><input type="text" name="blog_cat_name" value="" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn blog_cat_save" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    </form>
    <script>
	$(function(){
		$('.blog_cat_save').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/blog_cat_add.php',
				type: 'post',
				data: $('#form_blog_cat_add').serialize(),
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