<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");


$colourways_image_id=$_REQUEST['id'];
$row_slide=$pro->getSingleColourwaysImage($colourways_image_id);
if(isset($_POST['colourways_image_id']))
{
	$pro->UpdateColourwaysImages($colourways_image_id);
	exit;
}
$pro_id=$pro->ColourwaysImage($colourways_image_id);
$mpro_id=$pro_id['product_id'];
?>
<div class="container" style="margin:0;">
   
    <div class="clearboth"></div>
    <div class="info">
        Provide the colourway title and images that you wish to update.
    </div>
    <form id="form_slide_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="colourways_img_name" value="<?php echo stripslashes($row_slide['colourways_img_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
          <td  class="formleft">&nbsp;
         
          </td>
          <td  class="formright">
          Is this colourway sample available? 
          &nbsp;&nbsp;&nbsp;<input type="radio" class="sample_yes" name="sample_available" <?php if($row_slide['sample_available']==1) echo "checked";?> value="1"  />&nbsp;&nbsp;Yes
          &nbsp;&nbsp;&nbsp;<input type="radio" class="sample_no" name="sample_available" <?php if($row_slide['sample_available']==0) echo "checked";?> value="0"  />&nbsp;&nbsp;No<br />
          <br />
               <div <?php if($row_slide['sample_available']==0){?> style="display:none"<?php } ?>  class="sample_yes_desc">
       <textarea name="sample_available_desc_yes" class="myeditor" ><?php echo stripslashes($row_slide['sample_available_desc_yes']); ?></textarea>
       </div>
          <div <?php if($row_slide['sample_available']==1){?> style="display:none"<?php } ?>  class="sample_no_desc">
          <textarea name="sample_available_desc_no" class="myeditor"><?php echo stripslashes($row_slide['sample_available_desc_no']); ?></textarea>
		      </div>
    <script>
	$(function(){
		$('.sample_yes').click(function(){
		//alert('hellow');
		$('.sample_no_desc').hide();
		$('.sample_yes_desc').show();
		});
		$('.sample_no').click(function(){
		$('.sample_yes_desc').hide();
		$('.sample_no_desc').show();
		});
	});
	</script>

      
      
          
         
		         
		
             
          </td>
          
          </tr>

    <?php
	if(empty($row_slide['colourways_image_sm']))
	{
		?>
        <tr>
            <td class="formleft">Upload thumbnail image</td>
            <td class="formright"><input type="file" id="colourways_image_sm" name="theimageth" value="" />
              	 <br />
       		 <b>The uploaded image will appear as a thumbnail in the product detail page below the main image.
                <br /> The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
             
</b>  </td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Thumbnail image</td>
            <td class="formright"><img width="200px" src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_slide['colourways_image_sm']; ?>" /></td>
        </tr>
		<tr>
            <td class="formleft">Replace thumbnail image</td>
            <td class="formright"><input type="file" id="colourways_image_sm" name="theimageth" />
         	 <br />
       		 <b>The uploaded image will appear as a thumbnail in the product detail page below the main image.
                <br /> The dimensions of this image should be<?php echo PRO_IMG_TH_W;?>  px in width and <?php echo PRO_IMG_TH_H;?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
             <br />If you decide to upload a new image, it will replace the existing one. 
</b>  </td>
        </tr>
		<?php
	}
	?>
 <?php
	if(empty($row_slide['colourways_image_md']))
	{
		?>
        <tr>
            <td class="formleft">Upload large image</td>
            <td class="formright"><input type="file" id="colourways_image_md" name="theimagemd" value="" />
                     	             	 <br />
       		 <b>The uploaded large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked. 
                <br /> The dimensions of this image should be <?php echo PRO_IMG_W;?>  px in width and <?php echo PRO_IMG_H;?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
             
</b></td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Large image</td>
            <td class="formright"><img width="200px" src="<?php echo SITE_URL.ALTERNATIVE_IMG_MD.$row_slide['colourways_image_md']; ?>" /></td>
        </tr>
		<tr>
            <td class="formleft">Replace large image</td>
            <td class="formright"><input type="file" id="colourways_image_md" name="theimagemd" />
           <br />
       		 <b>The uploaded large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked. 
                <br /> The dimensions of this image should be <?php echo PRO_IMG_W;?>  px in width and <?php echo PRO_IMG_H;?>  px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                 <br />If you decide to upload a new image, it will replace the existing one. 
             
</b>  </td>
        </tr>
		<?php
	}
	?>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn scroll_edit" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="colourways_image_id" value="<?php echo $colourways_image_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.scroll_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/colourways_edit.php?id=<?php echo $colourways_image_id; ?>',
				type: 'post',
				data: $('#form_slide_edit').serialize(),
				success: function(){
					$("#colourways_image_sm").upload("ajax/colourways_img_upload.php?id=<?php echo $colourways_image_id; ?>",function(res){
					},function(data) {
					});
				
					$("#colourways_image_md").upload("ajax/colourways_img_upload.php?id=<?php echo $colourways_image_id; ?>",function(res){
					},function(data) {
					});
					$('.saving').hide();
					$.fancybox.close();	
				}
			})
		});
	});
	</script>
    
   <?php /* <form class="form_two" name="available_img_frm" action="" method="post" onsubmit="return form_validate();"  enctype="multipart/form-data">
          <br /><br />
          <table id="available_images" border="0" class="myform">
          <tr>
              <td colspan="2" class="formright"><b>Add or delete alternative images</b></td>
          </tr>

         <tr>
              <td class="formleft">Alternative image</td>
              <td class="formright alt_image">
              <table class="">
              <tr>
              <td>
                 <?php
              $product_id=$_REQUEST['id'];
              $alt_image_id=$pro->getAltImage($product_id);
              if($alt_image_id)
              {
                  ?>
                   <ul id='mysorter_alt'>
                     <?php
                  foreach($alt_image_id as $alt_images)
                  {
                      
                  ?>
              
                 <li id="recordsArray_<?php echo $alt_images['alt_image_id']; ?>" style="margin:0;">
                  <div class='mybb' style="position:relative;">
                    <div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
                     <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$alt_images['alt_image_sm']; ?>" width="185"  border="0" />
                       <p style="text-align:center;line-height:20px;color:#333; padding:5px 0;">&nbsp;<?php echo stripslashes($alt_images['alt_img_name']); ?></p>
                       <div class="mybb" style="width:100px;">
                       
                        <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_alt_img&alt_id=<?php echo $alt_images['alt_image_id']; ?>&id=<?php echo $mpro_id;?>','Are you sure that you want to delete this products ?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
                                                </div>
                    </div>
                  </div>
                  </li>
                  
                  <?php
                      
                  }
                  ?>
                  </ul>
            
                  <?php
              }
              else
              {
                  ?>
                  No alternative images have been added.
                  <?php
              }
              
              ?>     
           <script>
          $(function(){
              $("#mysorter_alt").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                  var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
                  $.post("ajax/alt_img_sort.php", order, function(theResponse){
                      //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                  }); 															 
              }								  
              });
          });
          </script></td>
              </tr>
              </table>
              <script>
                    $(function(){
                        $('.available_images').fancybox({
                           beforeClose: function(){
                           $.ajax({
                              url: 'show_additional_images.php',
                              type: 'post',
                              data: { id: '<?php echo $_REQUEST['id']; ?>' },
                                  success: function(data){
                                      $('.alt_image').html(data);
                                   }
                               });
                                   
                           }
                           });
                    });
                    </script>
              <br />
              
           </td>
          </tr>
          <tr>
            </table>
             <br />
          <table id="available_images" border="0" class="myform">
          <tr>
              <td colspan="2" class="formright"><b>If you wish to add a new alternative image, browse thumbnail and large image below.</b></td>
          </tr>
          <td  class="formleft">
          Image title
          </td>
          <td  class="formright">
               <input type="text" name="alt_title"  class="mytextbox" style="width:200px;"  /><br /><br />

          </td>
          </tr>
         
    
          <tr>
           <td  class="formleft">Thumbnail image</td>
          <td  class="formright"><input type="file" name="theimageth" size="25">

                      <b>
                         <br />The uploaded image will appear as a thumbnail in the product detail page below the main image.
                         <br /><br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
                         
                      </b>
          </td>
          </tr>
          <tr>
          <td  class="formleft">Large image</td>
           <td  class="formright"><input type="file" name="theimagemd" size="25">
                      <b>
                      <br />The uploaded image will appear in the product detail page.
                      <br /><br />The dimensions of the image should be <?php echo PRO_IMG_W;?> px in width.
                      <br /><br />The height may vary with a maximum height of <?php echo PRO_IMG_H;?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.

                      </b>
          </td>
          </tr>

          
          <br />
          
          
           </td>
          </tr>
          <tr>
              <td class="formleft">&nbsp;</td>
              <td class="formright"><input type="submit" name="save_alternative_img" value="Save" class="mybtn" /> &nbsp; &nbsp;<br />
            <!-- <b>*If you wish to upload more available images, click the button Add More.<br /></b> -->
               </td>
          </tr>
          </table>
          <input type="hidden" name="imagetype" value="2" />
          <input type="hidden" name="cat_id" id="cat_id" value="<?php echo stripslashes($_REQUEST['cat_id']); ?>" />
          <input type="hidden" name="colourways_id" id="colourways_id" value="<?php echo stripslashes($_REQUEST['id']); ?>" />
          </form> */?>
</div>
<script>
	$('.myeditor').ckeditor({
		langCode: 'en', 
		width : '100%',
		height : '150',
		toolbar:
		[
			['Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'LeftJustify'],
			['Image', 'Link', 'Unlink', 'Flash'],
			['TextColor','BGColor'],
			['Font','FontSize']
		],
		filebrowserBrowseUrl:'ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl:'ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl:'ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'  
	});

	</script>