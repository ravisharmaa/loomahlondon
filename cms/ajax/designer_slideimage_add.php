<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['designer_id']))
{
	echo $cnt->addDesignerSlideImage();
	exit;
}
$designer_id=$_REQUEST['id'];
$row_cat=$cat->showCategory($designer_id);
?>
<div class="container" style="margin:0;">
    <h1>Add slide image</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the slide image that you wish to add.
    </div>
    <form id="form_slide_add">
    <table border="0" class="myform">
     <tr>
        <td class="formleft">Photo Credit</td>
        <td class="formright"><input type="text" name="photo_credit" class="mytextbox" /></td>
    </tr>
	<tr>
        <td class="formleft">Slide Image</td>
        <td class="formright"><input type="file" id="slideshow_images" name="slideshow_image" />
                <br />
        <b>The uploaded image will appear as slideshow on the <?php echo strtolower(stripslashes($row_cat['cat_name'])); ?> page.
        <br />The dimension of this image should be <?php echo DESIGNER_SLIDE_IMG_W; ?> px in width and <?php echo DESIGNER_SLIDE_IMG_H; ?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
</b></td>
    </tr>

	<tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn slide_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="designer_id" value="<?php echo $designer_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.slide_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/designer_slideimage_add.php',
				type: 'post',
				data: $('#form_slide_add').serialize(),
				success: function(id){
					$("#slideshow_images").upload("ajax/designer_slideimage_upload.php?id="+id,function(res){
						$('.saving').hide();
						$.fancybox.close();	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
   
</div>