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
	echo $cat->addCategory();
	exit;
}
$parent_id=0;
?>
<div class="container" style="margin:0;">
    <h1>Add a designer</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the designer name and its image that you wish to add.
    </div>
    <form id="form_cat_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Category Name</td>
        <td class="formright"><input type="text" name="cat_name" value="" class="mytextbox" /></td>
    </tr>
   <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="cat_desc" class="mytextarea"></textarea></td>
    </tr>
   
    <tr>
        <td class="formleft">Upload Image</td>
        <td class="formright"><input type="file" id="cat_image" name="cat_image" />
        <br /><b>The uploaded image will appear on the collection index page.
        <br />The dimension of this image should be <?php echo CAT_IMG_W; ?> px in width and <?php echo CAT_IMG_H; ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
        </td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn cat_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.cat_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/cat_add.php',
				type: 'post',
				data: $('#form_cat_add').serialize(),
				success: function(id){
					$("#cat_image").upload("ajax/cat_image_upload.php?id="+id,function(res){
						$(location).attr('href','login.php?p_id=manage_products&id='+id);	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
</div>