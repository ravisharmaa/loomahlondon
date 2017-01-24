<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
 error_reporting(0);
 $myroot="../../";
include_once($myroot."config/config.php");
$colourways_image_id=$_REQUEST['id'];

if(isset($_POST['submitted']) and $_POST['submitted']=="Submit")
{
 $colourways_image_id=$_POST['colourways_image_id'];
 $update=$pro->UpdateColourwaysImages($colourways_image_id);

 exit;
}
 $row_colourways_img=$pro->getSingleColourwaysImage($colourways_image_id);
 ?>  

<div class="container" style="margin:0;"> 
 <div class="spacer10"></div>
 <form method="post" action="" enctype="multipart/form-data" name="colourways_edit" id="colourways_edit">
<table border="0" class="myform">
  <tr>
        <td colspan="2" class="formright"><b>Edit image details.</b></td>
    </tr>
  <tr>
         <td class="formleft">Image Description</td>
        <td class="formright"><input type="text" name="colourways_img_name" class="mytextbox" value="<?php echo $row_colourways_img['colourways_img_name']; ?>"/></td>
  </tr>
  <?php if(!empty($row_colourways_img['colourways_image_sm']))
  {
	  ?>
	     <tr>
         <td class="formleft">Thumbnail Image</td>
        <td class="formright">
        	<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:150px">
            	<img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_colourways_img['colourways_image_sm']; ?>" width="150" border="0" />
            </div>
        </td>
  </tr>
  <?php
  }
  ?>
    <tr>
      
        <td class="formleft"> Replace thumbnail image</td>
		<td class="formright">
		<input type="file" name="theimageth" id="theimageth" size="25">
                  	<b>
                    <br />Provided image will appear as a thumbnail in the product detail page below the main image.
                    <br />The dimensions of the image should be <?php echo PRO_IMG_TH_W;?> px in width and <?php echo PRO_IMG_TH_H;?> px in height. 
                    <br />If it is different than this then it will appear incorrectly.
                    <br />Uploading the new image will replace the existing above one.
                                
                   
                                </b>
</td>
</tr>
  <?php if(!empty($row_colourways_img['colourways_image_md']))
  {
	  ?>
	     <tr>
         <td class="formleft">Large Image</td>
        <td class="formright">
        	<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:200px">
        		<img src="<?php echo SITE_URL.ALTERNATIVE_IMG_MD.$row_colourways_img['colourways_image_md']; ?>" width="200px" border="0" />
            </div>
        </td>
  </tr>
  <?php
  }
  ?>
<tr>
<td  class="formleft">Replace large image</td>
<td class="formright">
<input type="file" name="theimagemd" id="theimagemd" size="25">
			<b>
          		  <br />Provided image will appear in the product detail page.
          		  <br />The dimensions of the image should be <?php echo PRO_IMG_W;?> px in width and height may vary with maximum height of <?php echo PRO_IMG_H;?> px.
              	  <br />If it is different than this then it will appear incorrectly.
          	     <br />Uploading the new image will replace the existing above one.
            </b>
</td>
</tr>

      
       <tr>
         <td class="formleft">&nbsp;</td> 
          <td class="formright">  <input type="submit"  value="Save" class="mybtn" />
          <input type="hidden" name="submitted"  value="Submit"  /></td>
          </tr>
 </table>
    <input type="hidden" name="imagetype" value="2" />
        <input type="hidden" name="colourways_image_id" value="<?php echo $_REQUEST['id']; ?>" />
       <input type="hidden" name="product_id" value="<?php echo $row_colourways_img['product_id']; ?>"/>
 </form> 
   <script>
	$(function(){
		$('.mybtn').click(function(){		
			var t=$(this);
			t.hide();
			$('.saving').show();
			//alert('hellow');
			$.ajax({
				url: 'ajax/colourways_edit.php',
				type: 'post',
				data: $('#colourways_edit').serialize(),
				success: function(){
				alert('hellow');
					$("#theimageth").upload("ajax/colourways_image_upload.php?id=<?php echo $colourways_image_id; ?>",function(res){
					},function(data) {
					});
					$("#theimagemd").upload("ajax/colourways_image_upload.php?id=<?php echo $colourways_image_id; ?>",function(res){
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