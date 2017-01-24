<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");

$resources_id=$_REQUEST['id'];
$row_cat=$blg->showResource($resources_id);
if(isset($_POST['resources_id']))
{
	echo $blg->updateResource();
	exit;
}

?>
<div class="container" style="margin:0;">
    <h1>Edit a <?php echo strtolower(stripslashes($row_cat['resources_name'])); ?></h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the <?php echo strtolower(stripslashes($row_cat['resources_name'])); ?> name and its image that you wish to add.
    </div>
    <form id="form_resource_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="resources_name" value="<?php echo stripslashes($row_cat['resources_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Designer Name</td>
        <td class="formright"><input type="text" name="designer_name" value="<?php echo stripslashes($row_cat['designer_name']); ?>" class="mytextbox" /></td>
    </tr>
   <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="resource_desc" class="myeditor"><?php echo stripslashes($row_cat['resource_desc']); ?></textarea></td>
    </tr>
       <?php
	if(empty($row_cat['resource_img']))
	{
		?>
    <tr>
        <td class="formleft">Upload Image</td>
        <td class="formright"><input type="file" id="resource_image" name="resource_img"  value="" />
        <br /><b>The uploaded image will appear on the resources page.
        <br /><br />The dimension of this image should be <?php echo RESOURCE_IMG_W; ?> px in width and <?php echo RESOURCE_IMG_H; ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
        </td>
    </tr>
    <?php
	}
	else
	{
	?>
    	<tr>
            <td class="formleft">Image</td>
            <td class="formright showimgage"><img src="../<?php echo RESOURCE_IMG.$row_cat['resource_img']; ?>" width="200" /></td>
        </tr>
		<tr>
            <td class="formleft">Upload Image</td>
            <td class="formright"><input type="file" id="resource_image" name="resource_img" />
             <b class="line_height"><br />The uploaded image will appear on the resources page.
            <br /><br />The dimension of this image should be <?php echo RESOURCE_IMG_W ?> px in width and <?php echo RESOURCE_IMG_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
            <br /><br />If you decide to upload a new image, it will replace the existing one. 
            </b></td>
        </tr>
    <?php

        
	}
	?>
          <?php
	if($row_cat['resources_cat_id']==3)
	{
	?>
     <tr>
        <td class="formleft">Resource Link</td>
        <td class="formright"><input type="text" name="resource_link" value="<?php echo $row_cat['resource_link']; ?>" class="mytextbox" />
        <br /><b>Please enter the full url like (https://www.nicolalawrence.com.au)</b></td>
    </tr>
    <?php
	}
	else
	{
	?>
    <input type="hidden" name="resource_link" value="" class="mytextbox" />
    <?php
	}
	?>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn resource_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="resources_id" value="<?php echo $resources_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.resource_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/resource_edit.php?id=<?php echo $resources_id; ?>',
				type: 'post',
				data: $('#form_resource_add').serialize(),
				success: function(id){
					$("#resource_image").upload("ajax/resource_image_upload.php?id=<?php echo $resources_id; ?>",function(res){
						$(location).attr('href','login.php?p_id=manage_resource&id=<?php echo $row_cat['resources_cat_id']; ?>');	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
    <script>
	$('.myeditor').ckeditor({
		langCode: 'en', 
		width : '100%',
		height : '150',
		toolbar:
		[
			['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
			['Image', 'Link', 'Unlink', 'Flash'],
			['Format'],
			['TextColor','BGColor'],
			['Font','FontSize'],
		],
		filebrowserBrowseUrl:'ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'  
	});

	</script>
</div>