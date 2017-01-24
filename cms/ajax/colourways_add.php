<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$cat_id=$_REQUEST['id'];
?>
<div class="container" style="margin:0;">
    <h1>Add new Colourway</h1>
    <div class="clearboth"></div>
      <div class="info" style="margin-top:0px;"> If you wish to add a new colourway image, browse thumbnail and large image below.</div>
    		  <script language="javascript">
          function form_validate(){
          if(document.available_img_frm.theimageth.value==""){
          alert("Please upload the thumbnail image")
          return false;
          }
          if(document.available_img_frm.theimagemd.value==""){
          alert("Please upload the large image")
          return false;
          }
          }
          </script>
   <form class="form_two" name="available_img_frm" action="" method="post" onsubmit="return form_validate();"  enctype="multipart/form-data">
    <table id="available_images" border="0" class="myform">
        <tr>
          <td  class="formleft">
          Colourway title
          </td>
          <td  class="formright">
               <input type="text" name="colourways_img_name"  class="mytextbox" style="width:200px;"  /><br /><br />
          </td>
          
          </tr>
            <tr>
          <td  class="formleft">&nbsp;
         
          </td>
          <td  class="formright">
          Is this colourway sample available? 
          &nbsp;&nbsp;&nbsp;<input type="radio" class="sample_yes" name="sample_available" checked="checked" value="1"  />&nbsp;&nbsp;Yes
          &nbsp;&nbsp;&nbsp;<input type="radio" class="sample_no" name="sample_available" value="0"  />&nbsp;&nbsp;No
     <div class="sample_yes_desc">
       <textarea name="sample_available_desc_yes" class="myeditor" >Sample prices are subsidised by Nicola Lawrence and/or the suppliers and are therefore limited to SIX samples per order. Sample price includes postage. As a guide, the lead time for samples will be the same as for fabric/wallpapers and will vary from one to six weeks, depending on where sampling is held.</textarea>
       </div>
          <div style="display:none" class="sample_no_desc">
          <textarea name="sample_available_desc_no" class="myeditor" style="display:none;">Samples are not yet available/printed for this colourway.  If you are interested in this design please email <a href="mailto:samples@nicolalawrence.com.au">samples@nicolalawrence.com.au</a> for further advice.</textarea>
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
          <tr>
           <td  class="formleft">Thumbnail image</td>
          <td  class="formright"><input type="file" name="theimageth" size="25">

                      <b>
                         <br />The uploaded image will appear as a thumbnail in the product detail page below the main image.
                         <br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
                         
                      </b>
          </td>
          </tr>
          <tr>
          <td  class="formleft">Large image</td>
           <td  class="formright"><input type="file" name="theimagemd" size="25">
                      <b>
                      <br />The uploaded image will appear in the product detail page.
                     <br />The dimensions of this image should be <?php echo PRO_IMG_W;?> px in width and <?php echo PRO_IMG_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 

                      </b>
          </td>
          </tr>

      <?php /*?>    <tr>
          <td class="formleft">Alternative Image</td>
              <td class="formright">Would you like to add alternative images for this colourways?<br />
                  <input type="radio" name="alt_img_radio" class="alt_colourways_yes" /> yes &nbsp; &nbsp; &nbsp; &nbsp;
                  <input type="radio" name="alt_img_radio" checked="checked" class="alt_colourways_no"  /> No
              </td>
          </tr><?php */?>
          </table>
          <?php /*?><table id="available_images" border="0" class="myform upload_alt_img" style="display:none;">
          <tr>
              <td colspan="2" class="formright"><b>If you wish to add a new alternative image for this colourway, browse thumbnail and large image below.</b></td>
          </tr>
          <td  class="formleft">
          Image title
          </td>
          <td  class="formright">
               <input type="text" name="alt_img_name"  class="mytextbox" style="width:200px;"  /><br /><br />

          </td>
          </tr>
         
    
          <tr>
           <td  class="formleft">Thumbnail image</td>
          <td  class="formright"><input type="file" name="alt_imageth" size="25">

                      <b>
                         <br />The uploaded image will appear as a thumbnail in the product detail page below the main image.
                         <br /><br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
                         
                      </b>
          </td>
          </tr>
          <tr>
          <td  class="formleft">Large image</td>
           <td  class="formright"><input type="file" name="alt_imagemd" size="25">
                      <b>
                      <br />The uploaded image will appear in the product detail page.
                      <br /><br />The dimensions of the image should be <?php echo PRO_IMG_W;?> px in width.
                      <br /><br />The height may vary with a maximum height of <?php echo PRO_IMG_H;?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.

                      </b>
          </td>
          </tr>
          </table><?php */?>
          
             <table class="myform">
          <tr>
              <td class="formleft">&nbsp;</td>
              <td class="formright"><input type="submit" name="save_colourways_img" value="Save" class="mybtn" /> &nbsp; &nbsp;<br />
      
               </td>
          </tr>
          </table>
        <input type="hidden" name="imagetype" value="2" />
          <input type="hidden" name="cat_id" id="cat_id" value="<?php echo stripslashes($_REQUEST['cat_id']); ?>" />
          <input type="hidden" name="product_id" id="product_id" value="<?php echo stripslashes($_REQUEST['id']); ?>" />
          </form>

</div>

  <script>
	$(function(){
		$('.alt_colourways_yes').click(function(){
		$('.upload_alt_img').show();
		});
		$('.alt_colourways_no').click(function(){
		$('.upload_alt_img').hide();
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