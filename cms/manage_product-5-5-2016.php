<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=2;
$show_tab="pro_detail";
$product_id=$_REQUEST['id'];
$row_pro=$pro->showProduct($product_id);
$row_colourways=$pro->getDefaultColourwaysImage($product_id);
$cat_id=$row_pro['cat_id'];
$row_cat=$cat->showCategory($cat_id);
$row_pro=$pro->getaProduct($product_id);
$getattribute=$pro->getAttribute($product_id);
$product_price=$pro->getaProductPrice($product_id);
?>
<?php
if(isset($_REQUEST['show_tab']))
	{
		$show_tab=$_REQUEST['show_tab'];
		?>
		<script>
		$(function(){
			$('html, body').animate({ scrollTop: $('#<?php echo $show_tab; ?>').offset().top },1000);	   
		});
		</script>
<?php
	}  
?>
<?php
if(isset($_POST['submitted']))
{
	switch($_POST['submitted'])
	{
		case "downloadablefiles":
			$pro->saveProDownloadableFiles();
			echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=downloadablefiles'</script>";
			break;
		case "main_image":
			$pro->saveProMainImg();
			echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=product_images'</script>";
			break;
 
	}
}
if(isset($_POST['save_colourways_img']) and $_POST['save_colourways_img']=="Save")
{
	$product_id=$_REQUEST['id'];
	$product=$pro->addColourwaysImage($product_id);
	echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=colourways'</script>";
	    break;
	
}
?>
<?php
if(isset($_REQUEST['act']))
{
	switch($_REQUEST['act'])
	{
	  case "del_cad_file":
	  $id=$_REQUEST['id'];
	  $pro->delCadFile($id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=downloadablefiles'</script>";
	  break;
	  
	  case "del_pdf_file":
	  $id=$_REQUEST['id'];
	  $pro->delPdfFile($id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=downloadablefiles'</script>";
	  break;	
	  
	  case "del_alt_img":
	  $alt_id=$_REQUEST['alt_id'];
	  $id=$_REQUEST['id'];
	  $product=$pro->delColourwaysImage($alt_id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&act=edit&id=".$id."&show_tab=colourways'</script>";
	  break;	
	}
}
		
?>
<h1><?php echo stripslashes($row_pro['product_name']); ?></h1>
<div class="goback"><a href="login.php?p_id=manage_products&id=<?php echo $cat_id; ?>">Back to <?php echo stripslashes($row_cat['cat_name']); ?></a></div>
<div class="clearboth"></div>
<div class="breadcrumb"> <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_textiles">Textiles</a> &raquo; <a href="login.php?p_id=manage_products&id=<?php echo $cat_id; ?>"><?php echo stripslashes($row_cat['cat_name']); ?></a> &raquo; <?php echo stripslashes($row_pro['product_name']); ?> </div>
<br />
	<div class="clearboth"></div>
	<div style="float:left; margin-right:40px; width: 350px;" class="main_img">
   					 <?php 
					  if(!empty($row_pro['product_image_sm']))
					 {
					 ?>
					 <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_pro['product_image_sm']; ?>" width="300" border="0" />
                     <?php
					 }
					 elseif(!empty($row_colourways['colourways_image_sm']))
					 {
					 ?>
					 <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_colourways['colourways_image_sm']; ?>" width="300" border="0" />
                     <?php
					 }
					 else
					 {
					 ?> <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM; ?>replace-small.jpg" width="300" border="0" />
                     <?php
					 }
					 ?>
  			</div>
			<div style="float:left; width: 570px;" class="summary4">
    			<style>
				.summary4 p{
					margin-bottom: 6px;	
				}
				</style>
                <div class="clearboth"></div>   
                                              
                <div style="font-size: 11pt; border-bottom: 1px dotted #cccccc; padding-bottom:5px;">  <h3>Descriptions</h3></div>
                <br />
           
                <?php if(!empty($row_pro['composition']))
				{
					?>
                <b>Composition</b>: <?php echo stripslashes($row_pro['composition']); ?><br /><br />
                <?php
				}
				?>
                <?php if(!empty($row_pro['width']))
				{
					?>
                <b>Width</b>: <?php echo stripslashes($row_pro['width']); ?><br /><br />
                <?php
				}
				?>
                  <?php if(!empty($row_pro['pro_repeat']))
				{
					?>
                <b>Repeat</b>: <?php echo stripslashes($row_pro['pro_repeat']); ?><br /><br />
                <?php
				}
				?>
                  <?php if(!empty($row_pro['origin']))
				{
					?>
                <b>Origin</b>: <?php echo stripslashes($row_pro['origin']); ?><br /><br />
                <?php
				}
				?>
                <?php if(!empty($row_pro['care_order']))
				{
					?>
                <b>Care / Other</b>: <?php echo stripslashes($row_pro['care_order']); ?><br /><br />
                <?php
				}
				?>
                
                   
                <?php if(!empty($row_pro['product_desc']))
				{
					?>
                <b>Description</b>: <?php echo stripslashes($row_pro['product_desc']); ?><br /><br />
                <?php
				}
				?>

              <?php /*?>  <b>Min Order Qty</b>: <?php if($row_pro['min_order_qty']==0){echo "1"; } else {echo stripslashes($row_pro['min_order_qty']); } ?><br /><br /><?php */?>

	
    		</div>
  			<div class="clearboth"></div>
<div class="accordion"><a href="JavaScript:void(0);" rel="pro_detail" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="pro_detail") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE PRODUCT DETAIL</a></div>
<div id="pro_detail" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="pro_detail")?"block":"none"; ?>;">
           	   <?php /*?>   <div class="info">If you wish to update the button label for this product, please overwrite the text below and click the "Save" button.</div>
                <table border="0" class="myform">
                <tr>
                    <td class="formleft">Button label</td>
                    <td class="formright"><input id="button_label1" type="text" value="<?php echo $pro->getButtonLabel($product_id,1); ?>" class="mytextbox" /></td>
                </tr>
                <tr>
                	<td class="formleft">&nbsp;</td>
                    <td class="formright">
                    	<input type="button" class="mybtn btnlabel1" value="Save" />
                        <div class="saving">Saving...</div>
                        <div class="saved">Successfully saved</div>
					</td>
                </tr>
                </table>
                <script>
				$(function(){
					$('.btnlabel1').click(function(){
						var t=$(this);
						t.hide();
						$('.saving').show();
						$.ajax({
							url: 'ajax/button_label_save.php',
							type: 'post',
							data: { id:'<?php echo $product_id; ?>', btn:'1', label:$('#button_label1').val() },
							success: function(data){
								$('.saving').hide();
								$('.saved').fadeIn(function(){
									$(this).delay(1000).fadeOut(function(){
										t.show();	
									});		
								})
							}
						});
					});
				});
				</script>
                <br /><br />  <?php */?>
  <div class="info"> Provide the product name and its detail that you wish to update. </div>
  <form id="form_product_edit">
    <table border="0" class="myform">
      <tr>
        <td class="formleft">Product Name</td>
        <td class="formright"><input type="text" name="product_name" value="<?php echo stripslashes($row_pro['product_name']); ?>" class="mytextbox" /></td>
      </tr>
      <tr>
        <td class="formleft">Composition</td>
        <td class="formright"><input type="text" name="composition" value="<?php echo stripslashes($row_pro['composition']); ?>" class="mytextbox"  /></td>
      </tr>
      <tr>
        <td class="formleft">Width</td>
        <td class="formright"><textarea  name="width" class="mytextbox" style="height:24px; resize:none;" ><?php echo stripslashes($row_pro['width']); ?></textarea></td>
      </tr>
        <tr>
        <td class="formleft">Repeat</td>
        <td class="formright"><textarea  name="pro_repeat" class="mytextbox" style="height:24px; resize:none;" ><?php echo stripslashes($row_pro['pro_repeat']); ?></textarea></td>
      </tr>
       <tr>
        <td class="formleft">Minimum Order</td>
        <td class="formright">
         <select name="min_order_qty" style="min-width:50px;" >
      <?php
		for ($x = 0.5; $x <= 5; $x += 0.5) {
		?>
		 <option <?php if($x==$row_pro['min_order_qty']) echo "selected"; ?> value="<?php  echo $x; ?>"><?php  echo $x; ?> meter</option>
		   
			<?php
		}
		?>
        </select>
        <?php /*?><textarea  name="min_order" class="mytextbox" style="height:24px; resize:none;" ><?php echo stripslashes($row_pro['min_order_qty']); ?></textarea><?php */?>
        </td>
      </tr>
      
        <tr>
        <td class="formleft">Origin</td>
        <td class="formright"><textarea  name="origin" class="mytextbox" style="height:24px; resize:none;" ><?php echo stripslashes($row_pro['origin']); ?></textarea></td>
      </tr>
      
     
       <tr>
        <td class="formleft">Care/Other</td>
        <td class="formright"><textarea name="care_order" class="mytextbox" style="resize:none;"><?php echo stripslashes($row_pro['care_order']); ?></textarea></td>
      </tr>
        <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="product_desc" class="mytextbox" style="resize:none;"><?php echo stripslashes($row_pro['product_desc']); ?></textarea></td>
      </tr>
        <?php /*?>       <tr>
        <td class="formleft">Minimum order quantity</td>
        <td class="formright"><input type="hidden" name="min_order_qty" value="<?php if($row_pro['min_order_qty']==0){echo "1"; } else {echo stripslashes($row_pro['min_order_qty']); } ?>" class="mytextbox" style="width:100px;" /></td>
      </tr>
      <input type="hidden" name="min_order_qty" value="<?php if($row_pro['min_order_qty']==0){echo "1"; } else {echo stripslashes($row_pro['min_order_qty']); } ?>" class="mytextbox" style="width:100px;" />
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        Stock availability:&nbsp;  &nbsp;<input type="radio" name="stock" value="0" <?php if($row_pro['in_stock']==0){ ?> checked="checked"<?php }?>/>&nbsp;In stock
                              &nbsp; &nbsp; <input type="radio" name="stock" value="1" <?php if($row_pro['in_stock']==1){ ?> checked="checked"<?php }?> />&nbsp;Out of Stock </td>
      </tr>
        <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">Do you wish to feature this item  as a favourite collection?  &nbsp; &nbsp;<input type="radio" name="fc" value="1" <?php if($row_pro['collection_favourite']==1){ ?> checked="checked"<?php }?>/>&nbsp;Yes
                               &nbsp; &nbsp; <input type="radio" name="fc" value="0" <?php if($row_pro['collection_favourite']==0){ ?> checked="checked"<?php }?> />&nbsp;No</td>
      </tr>
            <?php
                        if(!empty($getattribute))
                        {
                            ?>
    
                            <?php 
                            foreach($getattribute as $moregetattribute)
                            {
                                ?>
                                <tr>
                                    <td class="formleft">
                                        <input type="text" name="attribute_name[<?php echo $moregetattribute["attribute_id"]; ?>]" value="<?php echo $moregetattribute["attribute_name"]; ?>" style="height:20px; width:160px; margin-top:8px; padding: 5px;" />
                                    </td>
                                    <td class="formright">
                                        <textarea name="attribute_value[<?php echo $moregetattribute["attribute_id"]; ?>]"  class="myeditor"><?php echo $moregetattribute["attribute_value"]; ?></textarea>
                                    </td>
                                </tr>
                                <?php
                            }
 
                        }
                        ?>
                    <?php
                    $product_id=$_REQUEST['id'];
                    $row_attr=$pro->getAttribute($product_id);
                    ?>
                    <tr>
                        <td colspan="2" class="formright"><b>If you wish to add a new attribute, please provide the attribute name and its description below and click the "Save" button.</b></td>
                    </tr>
                    <tr>
                        <td class="formleft">Attribute name</td>
                        <td  class="formright"><input  id='textbox1' type="text" name="attribute_name2" class="mytextbox"  /></td>
                    </tr>
                    <tr>
                        <td class="formleft">Attribute description</td>
                        <td class="formright"><textarea id="desc" name="attribute_value2" class="myeditor"></textarea></td>
                    </tr>
					<?php */?>
                    
      <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;"><input type="button" value="Save" class="mybtn product_edit" />
          <div class="saving_detail">Saving...</div>
          <div class="saved_detail">Successfully Saved.</div></td>
      </tr>
    </table>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
  </form>
  <script>
	$(function(){
		$('.product_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving_detail').show();
			$.ajax({
				url: 'ajax/product_edit.php',
				type: 'post',
				data: $('#form_product_edit').serialize(),
				success: function(){
			
						$('.saving_detail').fadeOut(function(){
							$('.saved_detail').show().delay(2000).hide(function(){
								t.show();
								
							});	
						});
						alertify.success('Successfully Saved.');
						//window.location = "login.php?p_id=manage_product&id=<?php echo $product_id;?>&show_tab=pro_detail";
				}
			
			})
		});
	});
	</script> 
</div>

<!-- ###################################################  AVAILABLE IMAGES  START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="product_images" class="accordiontab">CLICK HERE TO EDIT THE ROOMSHOT IMAGE</a></div>
<div id="product_images" class="accordionblock" style="display:<?php echo (isset($show_tab) and ($show_tab=="available_image" or $show_tab=="product_images"))?"block":"none"; ?>;">
      <div id="product_img_block" style="padding:10px 15px 20px 15px;">
          <form action="" method="post" enctype="multipart/form-data">
          <table border="0" class="myform">
         
          <?php
          if(!empty($row_pro['product_image_sm']))
          {
              ?>
              <tr>
                  <td class="formleft">Thumbnail image</td>
                  <td class="formright">
                    <div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:150px">
                      <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_pro['product_image_sm']; ?>" width="150" border="0" />
                      </div>
                  </td>
              </tr>
              <tr>
                  <td class="formleft">Replace thumbnail image</td>
                  <td class="formright">
                      <input type="file" name="theimageth" />
                      <b><br />The uploaded thumbnail image will appear on the product index page.
                      <br /><br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and  <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                      <br /><br />If you decide to upload a new image, it will replace the existing one.
                      </b><br />
                  </td>
              </tr>
              <?php
          }
          else
          {
              ?>
              <tr>
                  <td class="formleft">Thumbnail image</td>
                  <td class="formright">
                      <input type="file" name="theimageth" />
                          <b><br />The uploaded thumbnail image will appear on the product index page.
                      <br /><br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and  <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                     
                      </b><br />
          
                  </td>
              </tr>
              <?php
          }
          if(!empty($row_pro['product_image_lg']))
          {
              ?>
              <tr>
                  <td class="formleft">Large image</td>
                  <td class="formright">
                    <div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:200px">
                      <img src="<?php echo SITE_URL.PRO_IMG.$row_pro['product_image_lg']; ?>" width="200" border="0" />
                      </div>
                  </td>
              </tr>
              <tr>
                  <td class="formleft">Replace large image</td>
                  <td class="formright">
                      <input type="file" name="theimagemd" />
                
                      <b><br />The uploaded large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
                      <br /><br />The dimensions of the image should be <?php echo PRO_IMG_W;?> px in width.
                      <br /><br />The height may vary with a maximum height of <?php echo PRO_IMG_H;?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product. 
                      <br /><br />If you decide to upload a new image, it will replace the existing one.
                      </b><br />
                     
                  </td>
              </tr>
              <?php
          }
          else
          {
              ?>
              <tr>
                  <td class="formleft">Large image</td>
                  <td class="formright">
                      <input type="file" name="theimagemd" />
              
                      <b><br /><br />The uploaded large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
                      <br /><br />The dimensions of the image should be <?php echo PRO_IMG_W;?> px in width.
                      <br /><br />The height may vary with a maximum height of <?php echo PRO_IMG_H;?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product. 
                      </b><br />
                   
                  </td>
              </tr>
              <?php
          }
          /*
          if(!empty($row_pro['main_image_lg']))
          {
              ?>
              <tr>
                  <td class="formleft">Hover Image</td>
                  <td class="formright">
                      <img src="<?php echo SITE_URL.FURNITURE_IMG_LG.$row_pro['main_image_lg']; ?>" width="200" border="0" />
                  </td>
              </tr>
              <tr>
                  <td class="formleft">Upload Image</td>
                  <td class="formright">
                      <input type="file" name="theimagelg" />
                      <b><br />The dimension of the image should be <?php echo PRO_IMG_LG_W;?>px in width and <?php echo PRO_IMG_LG_H;?>px in height. 
                      <br />Provided image will appear when hover the image in product detail page.
                      <br />Uploading the new image will replace the existing above one.
                      </b>
                  </td>
              </tr>
              <?php
          }
          else
          {
              ?>
              <tr>
                  <td class="formleft">Hover Image</td>
                  <td class="formright">
                      <input type="file" name="theimagelg" />
                      <b><br />The dimension of the image should be <?php echo PRO_IMG_LG_W;?>px in width and <?php echo PRO_IMG_LG_H;?>px in height. 
                      <br />Provided image will appear when hover the image in product detail page.
                      </b>
                  </td>
              </tr>
              <?php
          }
          */
          ?>
        
          <?php /*?><tr>
              <td class="formleft">Image description</td>
              <td class="formright">
                  <input type="text" name="product_name" value="<?php echo stripslashes($row_pro['product_name']); ?>" class="mytextbox"/>
                  <br />
                  <b>This description will appear below the main image as a description for the alternative images.</b>
              </td>
          </tr><?php */?>
        
          <tr>
              <td class="formleft">&nbsp;</td>
              <td class="formright"><input type="submit" value="Save" class="mybtn" /></td>
          </tr>
          </table>
          <input type="hidden" name="product_id" value="<?php echo stripslashes($row_pro['product_id']); ?>" />
          <input type="hidden" name="submitted" value="main_image" />
          </form>
          			<script language="javascript">
                    function form_validate(){
                    if(document.available_img_frm.theimageth.value==""){
                    alert("Please upload the thumbnail image")
                    return false;
                    }
					if(document.available_img_frm.theimageth.value==""){

                    alert("Please upload the large image")
                    return false;
                    }
                    }
                    </script>
         
          
          
          <div class="clearboth"></div>
      </div>
  </div>
 <!-- ###################################################   AVAILABLE IMAGES  END   ##################################################################################-->


    <div class="accordion"><a href="JavaScript:void(0);" rel="colourways" class="accordiontab">CLICK HERE TO ADD OR EDIT COLOURWAYS FOR THIS PRODUCT</a></div>
<div id="colourways" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="colourways")?"block":"none"; ?>;">     
  <div class="myadd" style="margin-top:10px; margin-left:10px;">
    	<a href="ajax/colourways_add.php?id=<?php echo $product_id; ?>" class="colourways_add_link fancybox.ajax">Add new colourway</a>
    </div>
    	<script>
	$(function(){
		$('.colourways_add_link').fancybox();
	});
	</script>
    <div class="clearboth"></div>   
                     <form class="form_two" name="available_img_frm" action="" method="post" onsubmit="return form_validate();"  enctype="multipart/form-data">
           
        <table>
             <tr>
              <td class="formright colourways_image" colspan="2">
              <table class="">
              <tr>
              <td>
                 <?php
              $product_id=$_REQUEST['id'];
              $colourways_image_id=$pro->getColourwaysImage($product_id);
              if($colourways_image_id)
              {
                  ?>
                   <ul id='mysorter_alt'>
                     <?php
                  foreach($colourways_image_id as $colourways_images)
                  {
                      
                  ?>
              
                 <li id="recordsArray_<?php echo $colourways_images['colourways_image_id']; ?>" style="margin:0;">
                  <div class='mybb' style="position:relative;">
                    <div style="border:#DDD 1px solid; padding:10px 10px 5px 10px;margin: 5px 5px 0 5px;">
                       <a href="available_images.php?id=<?php echo $colourways_images['colourways_image_id']; ?>" class="available_images fancybox.iframe" ><img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$colourways_images['colourways_image_sm']; ?>" width="202" height="160px;"  border="0" /></a>  
                       <p style="text-align:center;line-height:20px;color:#333; padding:5px 0;">&nbsp;<?php echo stripslashes($colourways_images['colourways_img_name']); ?></p>
                       <div class="mybb" style="width:100%;">
                         <a href="available_images.php?id=<?php echo $colourways_images['colourways_image_id']; ?>" class="available_images fancybox.iframe" ><img src="images/icon_edit.png" width="26" height="26" border="0" /></a>
                        <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_alt_img&alt_id=<?php echo $colourways_images['colourways_image_id']; ?>&id=<?php echo $_REQUEST['id']; ?>','Are you sure that you want to delete this products ?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
                           
                             <div style="float:right;width:66px;padding-top:5px;">
                    		<label><input style="margin-right:5px;" type="checkbox" id="checkbox-<?php echo $colourways_images['colourways_image_id']; ?>" class="publish_product" <?php if($colourways_images['default_colourways']) echo "checked"; ?> />Default</label>
							</div>
                            <div id="img-<?php echo $colourways_images['colourways_image_id']; ?>" style="float:right;width:30px;display:none;">
                                <img src="images/loading.gif" width="20" height="20" border="0" />
                            <div class="clear"></div>
                            </div>
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
                 <p> No colourways images have been added.</p>
                  <?php
              }
              
              ?>     
           <script>
          $(function(){
              $("#mysorter_alt").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                  var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
                  $.post("ajax/colourways_img_sort.php", order, function(theResponse){
                      //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                  }); 															 
              }								  
              });
			$('.publish_product').click(function(){
					var tt=$(this);
					var id=tt.attr('id').split('-')[1];
					$('#img-'+id).show();
					var status=0;
					if($(this).is(':checked'))
						status=1;	
					$.ajax({
						url: 'ajax/colourways_status.php?product_id=<?php echo $product_id; ?>',
						type: 'post',
						data: { id: id, status: status },
						success: function(){
							$('#img-'+id).hide();	
						}
					});
					  $.ajax({
                              url: 'show_additional_images.php',
                              type: 'post',
                              data: { id: '<?php echo $_REQUEST['id']; ?>' },
                                  success: function(data){
                                      $('.colourways_image').html(data);
									  
                                   }
                               });
					  $.ajax({
                              url: 'show_main_image.php',
                              type: 'post',
                              data: { id: '<?php echo $_REQUEST['id']; ?>' },
                                  success: function(data){
                                      $('.main_img').html(data);
									  
                                   }
                               });
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
                                      $('.colourways_image').html(data);
									  
                                   }
                               });
                                   
                           }
                           });
                    });
                    </script>
              <br />
              
           </td>
          </tr>
          
            </table>
            
             <div class="info" style="margin-top:0px;"> If you wish to add a new colourways image, browse thumbnail and large image below.</div>
          <table id="available_images" border="0" class="myform">
        
          <td  class="formleft">
          Colourwys title
          </td>
          <td  class="formright">
               <input type="text" name="colourways_img_name"  class="mytextbox" style="width:200px;"  /><br /><br />
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
              <td class="formright"><input type="submit" name="save_colourways_img" value="Save" class="mybtn" /> &nbsp; &nbsp;<br />
      
               </td>
          </tr>
          </table>
          <input type="hidden" name="imagetype" value="2" />
          <input type="hidden" name="cat_id" id="cat_id" value="<?php echo stripslashes($_REQUEST['cat_id']); ?>" />
          <input type="hidden" name="product_id" id="product_id" value="<?php echo stripslashes($_REQUEST['id']); ?>" />
          </form>
          <script>
          $(function(){
              $("#mysorter_alt").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                  var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
                  $.post("ajax/colourways_img_sort.php", order, function(theResponse){
                      //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                  }); 															 
              }								  
              });
          });
          </script>
          </div>


<!-- ###################################################   PRICE START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="price" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="price") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO ADD OR EDIT PRICE FOR THIS ITEM</a></div>
  <div id="price" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="price")?"block":"none"; ?>;">
  <div class="info"> Please provide the price for this item that you wish to have. </div>
  <form id="form_page_price">
    <table border="0" class="myform">
   
      <tr>
        <td class="formleft">Price per meter</td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input class="mytextbox" type="text" style="width:100px;" name="price_per_meter" value="<?php echo stripslashes($product_price['price_per_meter']); ?>" /></td>
      </tr>
        <tr>
        <td class="formleft">Sample price</td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input type="text"  style="width:100px;" name="sample_price" value="<?php echo stripslashes($product_price['sample_price']); ?>" class="mytextbox" /></td>
      </tr>
       <td class="formleft">Delivery price</td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input type="text"  style="width:100px;" name="delivery_price" value="<?php echo stripslashes($product_price['delivery_price']); ?>" class="mytextbox" /></td>
      </tr>

      <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;"><input type="button" value="Save" class="mybtn save_price" />
          <div class="saving">Saving...</div>
          <div class="saved">Successfully Saved.</div></td>
      </tr>
    </table>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
    <input type="hidden" name="price_list_id" value="2" />
  </form>
  <script>
	$(function(){
		$('.save_price').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/product_price_save.php',
				type: 'post',
				data: $('#form_page_price').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).hide(function(){
							t.show();	
						});	
					});
					alertify.success('Successfully Saved.');
				}
				
			})
		});
	});
	</script> 
</div>
<!-- ###################################################   PRICE END   ##################################################################################-->
<?php /*?><!-- ###################################################   SEARCH TAG START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="search_tag" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="price") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO ADD OR EDIT REFINE BY TAGS FOR THIS ITEM</a></div>
  <div id="search_tag" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="search_tag")?"block":"none"; ?>;">
        <div class="info">
               Displayed below are refine by tags that have already been selected for this product. If none have been selected they will of course not appear.
            <br /><br />Click on the "Manage refine by tags" button below in order to add or remove tags.
        </div>
        <div style="margin:15px 0 7px 0;">
        <a href="ajax/refined_tags_select.php?id=<?php echo $_REQUEST['id']; ?>" class="select_refined_tags fancybox.ajax mybtn ">Manage refine by tags</a>
        </div>
        <script>
        $(function(){
            $('.select_refined_tags').fancybox({
                beforeClose: function(){
                    $.ajax({
                        url: 'ajax/refined_tags_show_selected.php',
                        type: 'post',
                        data: { id: '<?php echo $_REQUEST['id']; ?>' },
                        success: function(data){
                            $('.show_refined_tags').html(data);
                        }
                    });	
                }
            });
        });
        </script>
        <div class="clearboth"></div>
        <div class="spacer10"></div>
        <div class="show_refined_tags">
            <script>
            $(function(){
                $.ajax({
                    url: 'ajax/refined_tags_show_selected.php',
                    type: 'post',
                    data: { id: '<?php echo $_REQUEST['id']; ?>' },
                    success: function(data){
                        $('.show_refined_tags').html(data);
                    }
                });	
            });
            </script>
        </div>
</div>
<!-- ###################################################  SEARCH TAG END   ##################################################################################-->
<?php */?>
<!-- ###################################################   PRICE LIST START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="pro_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="pro_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE PRODUCT PAGE</a></div>
<div id="pro_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="pro_seo")?"block":"none"; ?>;">
  <div class="info"> Please provide the SEO contents for the product page that you wish to have. </div>
  <form id="form_page_seo">
    <table border="0" class="myform">
      <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="product_titletag" value="<?php echo stripslashes($row_pro['product_titletag']); ?>" class="mytextbox" /></td>
      </tr>
      <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="product_metakeywords" class="mytextarea"><?php echo stripslashes($row_pro['product_metakeywords']); ?></textarea></td>
      </tr>
      <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="product_metadescription" class="mytextarea"><?php echo stripslashes($row_pro['product_metadescription']); ?></textarea></td>
      </tr>
      <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;"><input type="button" value="Save" class="mybtn save_seo" />
          <div class="saving">Saving...</div>
          <div class="saved">Successfully Saved.</div></td>
      </tr>
    </table>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
  </form>
  <script>
	$(function(){
		$('.save_seo').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/product_seo_save.php',
				type: 'post',
				data: $('#form_page_seo').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).hide(function(){
							t.show();	
						});	
					});
					alertify.success('Successfully Saved.');
				}
			})
		});
	});
	</script> 
</div>
<!-- ###################################################   PRICE LIST START   ##################################################################################-->