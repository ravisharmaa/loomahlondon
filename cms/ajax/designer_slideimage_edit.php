<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");

$slideshow_id=$_REQUEST['id'];
//echo $slideshow_id; exit;
if(isset($_POST['slideshow_id']))
{
	echo $cnt->saveDesignerSlideImage();
	exit;
}

$row_slide=$cnt->showEachDesignerSlideImage($slideshow_id);
?>
<div class="container" style="margin:0;">
    <h1>Edit slide image</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the slide image that you wish to update.
    </div>
    <form id="form_slide_edit">
    <table border="0" class="myform">
        <tr>
        <td class="formleft">Photo Credit</td>
        <td class="formright"><input type="text" name="photo_credit" value="<?php echo stripslashes($row_slide['photo_credit']); ?>" class="mytextbox" /></td>
    </tr>

	<?php
	if(empty($row_slide['slideshow_image']))
	{
		?>
        <tr>
            <td class="formleft">Upload Slide Image</td>
            <td class="formright"><input type="file" id="slideshow_image" name="slideshow_image" value="" />
                                 	 <br />
       		 <b>The uploaded image will appear as slideshow on the designer's page.
           <br />The dimension of this image should be <?php echo DESIGNER_SLIDE_IMG_W; ?> px in width and <?php echo DESIGNER_SLIDE_IMG_H; ?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
     
             </b></td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Image</td>
            <td class="formright"><img src="../<?php echo SLIDE_IMG.$row_slide['slideshow_image']; ?>" width="200" /></td>
        </tr>
		<tr>
            <td class="formleft">Replace Image</td>
            <td class="formright"><input type="file" id="slideshow_image" name="slideshow_image" />         	 <br />
       		 <b>The uploaded image will appear as slideshow on the home page.
            <br />The dimension of this image should be <?php echo DESIGNER_SLIDE_IMG_W; ?> px in width and <?php echo DESIGNER_SLIDE_IMG_H; ?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
             <br />If you decide to upload a new image, it will replace the existing one. 
</b></td>
        </tr>
		<?php
	}
	?>
      
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn slide_edit" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="slideshow_id" value="<?php echo $slideshow_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.slide_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/designer_slideimage_edit.php?id=<?php echo $slideshow_id; ?>',
				type: 'post',
				data: $('#form_slide_edit').serialize(),
				success: function(id){
					$("#slideshow_image").upload("ajax/designer_slideimage_upload.php?id=<?php echo $slideshow_id; ?>",function(res){
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