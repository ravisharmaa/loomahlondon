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
$row_order_qty=$pro->showOrderQty($product_id);

$row_colourways=$pro->getDefaultColourwaysImage($product_id);
$cat_id=$row_pro['cat_id'];
$row_cat=$cat->showCategory($cat_id);

$parent_id=$row_cat['parent_id'];
$row_parent=$cat->showCategory($parent_id);

$row_pro=$pro->getaProduct($product_id);
$getattribute=$pro->getAttribute($product_id);
$product_price=$pro->getaProductPrice($product_id);

$getmultidimensions=$pro->getMultidimensions($product_id);

?>
<style>
input:invalid{
    box-shadow:none;

}
</style>
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
	   case "multi_dimension":
			$pro->addMultiDimension();
			echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=multi_dimension'</script>";
			break;
		case "update_multi_dimension":
			$pro->updateMultiDimension($_POST['dimension_id']);
			echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=multi_dimension'</script>";
			break;
			
			
			
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
if(isset($_POST['save_alternative_img']) and $_POST['save_alternative_img']=="Save")
{
	$product_id=$_REQUEST['id'];
	$product=$pro->addAltImage();
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
	  
	  case "del_colourways_img":
	  $alt_id=$_REQUEST['alt_id'];
	  $id=$_REQUEST['id'];
	  $product=$pro->delColourwaysImage($alt_id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$product_id."&show_tab=colourways'</script>";
	  break;	
	  
	   case "del_alt_img":
	  $alt_id=$_REQUEST['alt_id'];
	  $id=$_REQUEST['id'];
	 // $product=$pro->delAltImageFromRelation($alt_id);
	  $product=$pro->delAltImage($alt_id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$id."&show_tab=colourways'</script>";
	  break;
	  
	  case "del_pro_lgimg":
	  $pro_id=$_REQUEST['id'];
	  $product=$pro->delProductImageLg($pro_id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$pro_id."&show_tab=product_images'</script>";
	  break;
	  case "del_pro_smimg":
	  $pro_id=$_REQUEST['id'];
	  $product=$pro->delProductImageSm($pro_id);
	  echo "<script language='javascript'>document.location='login.php?p_id=manage_product&id=".$pro_id."&show_tab=product_images'</script>";
	  break;
	}
}
		
?>
<h1><?php echo stripslashes($row_pro['product_name']); ?></h1>
<div class="goback"><a href="login.php?p_id=manage_products&id=<?php echo $cat_id; ?>">Back to <?php echo stripslashes($row_cat['cat_name']); ?></a></div>
<div class="clearboth"></div>
<div class="breadcrumb"> <a href="login.php">Dashboard</a> &raquo; 
	<?php if($row_parent['cat_id']==1){?><a href="login.php?p_id=manage_textiles&id=1"><?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
	<?php if($row_parent['cat_id']==2){?><a href="login.php?p_id=manage_wallpapers&id=2"><?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
    <?php if($row_parent['cat_id']==3){?><a href="login.php?p_id=manage_decorative_pieces&id=3"><?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
     &raquo; <a href="login.php?p_id=manage_products&id=<?php echo $cat_id; ?>"><?php echo stripslashes($row_cat['cat_name']); ?></a> &raquo; <?php echo stripslashes($row_pro['product_name']); ?> </div>
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
					else if(!empty($row_colourways['colourways_image_sm']))
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
					<?php if($row_parent['cat_id']==3){?> <b>Dimensions </b>: <?php echo stripslashes($row_pro['width']); ?><?php } else { ?><b>width </b>: <?php echo stripslashes($row_pro['width']); } ?>
               <br /><br />
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
      <?php
	  if($cat_id!=26){
		  ?>
      <tr>
      <?php  if($row_parent['cat_id']==3){?><td class="formleft">Dimensions</td><?php }else{ ?><td class="formleft">Width</td><?php } ?>
      
        
        <td class="formright"><textarea  name="width" class="mytextbox" style="height:24px; resize:none;" ><?php echo stripslashes($row_pro['width']); ?></textarea></td>
      </tr>
      <?php
	  }
	  else
	  {
	  ?>
      <input type="hidden" name="width" value="<?php echo stripslashes($row_pro['width']); ?>"  />
      <?php
	  }
	  ?>
        <tr>
        <td class="formleft">Repeat</td>
        <td class="formright"><textarea  name="pro_repeat" class="mytextbox" style="height:24px; resize:none;" ><?php echo stripslashes($row_pro['pro_repeat']); ?></textarea></td>
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
        <td class="formleft">Use</td>
        <td class="formright"><textarea name="pro_use" class="mytextbox" style="resize:none;"><?php echo stripslashes($row_pro['pro_use']); ?></textarea></td>
      </tr>
      <tr>
        <td class="formleft">Lead Time</td>
        <td class="formright"><textarea name="lead_time" class="mytextbox" style="resize:none;"><?php echo stripslashes($row_pro['lead_time']); ?></textarea></td>
      </tr>
      <?php
	  if($row_pro['min_stock']==1)
	  {
	  ?>
        <tr>
        <td class="formleft">Available QTY</td>
        <td class="formright"><input class="mytextbox"  style="width:60px;" min="0" type="number" name="qty" value="<?php echo stripslashes($row_pro['qty']); ?>" /></td>
        </tr>
        <?php
	  }
	  else
	  {
	  ?>
      <input class="mytextbox" type="hidden" name="qty" value="NULL" />
      <?php
	  }
	  ?>
      <tr>
        <td class="formleft">Sold As</td>
        <td class="formright"> 
            <select name="sold_by" style="min-width:80px;">
                 <option style="padding:3px 6px;"  <?php if($row_pro['sold_by']=='metre') echo "selected"; ?> value="metre">Per Metre</option>
                 <option style="padding:3px 6px;" <?php if($row_pro['sold_by']=='roll') echo "selected"; ?> value="roll">Per Roll</option>
                  <option style="padding:3px 6px;" <?php if($row_pro['sold_by']=='piece') echo "selected"; ?> value="piece">Per Piece</option>
             </select>
         </td>
      </tr>
      <?php
	  if($parent_id==2){
	  ?>
      <tr>
        <td class="formleft">Sold By</td>
        <td class="formright"><input type="text" name="sold_by_two" value="<?php echo stripslashes($row_pro['sold_by_two']); ?>" class="mytextbox"  /></td>
      </tr>
      <?php
	  }
	  else
	  {
	   ?>
       <input type="hidden" name="sold_by_two" value="" />
       <?php
	   }
	   ?>
       <?php if($row_pro['min_stock']==0)
	   {
		   ?>
      <tr>
         <td class="formleft">Purchase Order</td>
        <td class="formright">
        Minimum Order
       <input type="number" min="0" style="width:47px;"  name="min_purchase_order" value="<?php echo (float)stripslashes($row_order_qty['min_purchase_order']); ?>" class="mytextbox"  />      &nbsp; &nbsp; &nbsp; Increments Thereafter 
      <?php /*?> <input type="number" style="width:60px;"  name="purchase_order_increament" value="<?php echo (float)stripslashes($row_order_qty['purchase_order_increament']); ?>" class="mytextbox"  /><?php */?>
      <?php
	   if($row_pro['sold_by']=='metre'){
	  ?>

         <select name="purchase_order_increament" style="width:60px; height:30px;" class="mytextbox">
            <option style="padding:3px 6px;" <?php if(0.1==$row_order_qty['purchase_order_increament']) echo "selected"; ?> value="0.1">0.1</option>
            <option style="padding:3px 6px;" <?php if(0.2==$row_order_qty['purchase_order_increament']) echo "selected"; ?> value="0.2">0.2</option>
            <option style="padding:3px 6px;" <?php if(0.5==$row_order_qty['purchase_order_increament']) echo "selected"; ?> value="0.5">0.5</option>
        </select>
        <?php
	   }
	   else
	   {
	   ?>
       <select name="purchase_order_increament" style="width:60px; height:30px;" class="mytextbox">
            <option style="padding:3px 6px;"  value="1">1</option>
        </select>
        <?php
	   }
	   ?>
       <?php
	   if($row_order_qty['max_purchase_order']==0){
	   $max_purchase_order=99;
	   }
	   else{
		   $max_purchase_order=(float)stripslashes($row_order_qty['max_purchase_order']);
	   }
	   ?>
       
       &nbsp; &nbsp; &nbsp; Maximim Order
       <input type="number" min="0"  style="width:47px;"  name="max_purchase_order" value="<?php echo $max_purchase_order; ?>" class="mytextbox"  />
              
        </td>
        </tr>
        
        <tr>
        <td class="formleft">Sample Order</td>
        <td class="formright">
        Minimum Order
           <select name="min_sample_order" style="min-width:60px;  height:30px;">
		  <?php
             for ($x = 1; $x <= 6; $x ++)
			 {
            ?>
            <option style="padding:3px 6px;" <?php if($x==$row_order_qty['min_sample_order']) echo "selected"; ?> value="<?php  echo $x; ?>"><?php  echo $x; ?> </option>
			<?php
            }
            ?>
        </select>
            &nbsp; &nbsp; &nbsp; Increments Thereafter 
          <select name="sample_order_increament" style="min-width:60px; height:30px;">
		  <?php
             for ($x = 1; $x <= 6; $x ++)
			 {
            ?>
            <option style="padding:3px 6px;" <?php if($x==$row_order_qty['sample_order_increament']) echo "selected"; ?> value="<?php  echo $x; ?>"><?php  echo $x; ?> </option>
			<?php
            }
            ?>
        </select>
        &nbsp; &nbsp; &nbsp; Maximim Order
          <select name="max_sample_order" style="min-width:60px; height:30px;">
		  <?php
             for ($x = 1; $x <= 6; $x ++)
			 {
            ?>
            <option style="padding:3px 6px;" <?php if($x==$row_order_qty['max_sample_order']) echo "selected"; ?> value="<?php  echo $x; ?>"><?php  echo $x; ?> </option>
			<?php
            }
            ?>
        </select>
        
<?php /*?>          <input type="number" style="width:60px;"  name="min_sample_order" value="<?php echo (float)stripslashes($row_order_qty['min_sample_order']); ?>" class="mytextbox"  />
    &nbsp; &nbsp; &nbsp; Increments Thereafter 
        <input type="number" style="width:60px;"  name="sample_order_increament" value="<?php echo (float)stripslashes($row_order_qty['sample_order_increament']); ?>" class="mytextbox"  />
          &nbsp; &nbsp; &nbsp; Maximim Order
        <input type="number"  style="width:60px;"  name="max_sample_order" value="<?php echo (float)stripslashes($row_order_qty['max_sample_order']); ?>" class="mytextbox"  /><?php */?>
              
        </td>
        </tr>
        <?php
	   }
	   else
	   {
		?>
        <input type="hidden"  name="min_purchase_order" value="0" />
        <input type="hidden"  name="purchase_order_increament" value="1" />
        <input type="hidden" name="max_purchase_order" value="1" />
        <input type="hidden" name="min_sample_order" value="1" />
        <input type="hidden" name="sample_order_increament" value="1" />
        <input type="hidden" name="max_sample_order" value="6" />
        <?php
	   }
	   ?>
       
        <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="product_desc" class="myeditor" style="resize:none;"><?php echo stripslashes($row_pro['product_desc']); ?></textarea></td>
      </tr>
      <tr>
  
      <?php /*?>  
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
				//console.log('asdkjds');
						$('.saving_detail').fadeOut(function(){
							$('.saved_detail').show().delay(2000).hide(function(){
								t.show();
							});	
						});
						//window.location = "login.php?p_id=manage_product&id=<?php echo $product_id;?>&show_tab=pro_detail";
						alertify.success('Successfully Saved.');
				}
			
			})
		});
	});
	</script> 
</div>
<?php
if($row_pro['multi_dimension']==1)
{
?>
<!-- ###################################################  MULTI DIMENSION PRODUCTS  ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="multi_dimension" class="accordiontab">CLICK HERE TO ADD OR EDIT THE MULTI DIMENSIONS AND DELIVERY CHARGES FOR THIS PRODUCT</a></div>
<div id="multi_dimension" class="accordionblock" style="display:<?php echo (isset($show_tab) and ($show_tab=="multi_dimension" or $show_tab=="multi_dimension"))?"block":"none"; ?>;">
      <div id="multi_dimension_block" style="padding:10px 15px 20px 15px;">
          <form action="" method="post" enctype="multipart/form-data">
                  <table border="0" class="myform">
                    <?php
					if(count($getmultidimensions))
					{
					?>
                    
                      <tr>

                        <td class="formright" colspan="2">    
    
                                    <table class="myform">
                                    <tr>
                                     <td class="formright" rowspan="2">Dimension</td>
                                     <td class="formright" rowspan="2">Price </td>
                                     <td class="formright" colspan="2" style="text-align:center;">Australia</td>
                                     <td class="formright" colspan="2" style="text-align:center;">New Zealand</td>
                                     <td class="formcenter" rowspan="2">Action</td>
                                     </tr>
                                     <tr>
                                     <td class="formright" >1 or 2</td>
                                     <td class="formright">3 and above</td>
                                     <td class="formright">1 or 2 </td>
                                     <td class="formright">3 and above </td>
                                   
                                     
                                    </tr>
                                    <?php
									foreach($getmultidimensions as $getmultidimension)
									{
									?>
                                    <tr>
                                        <td class="formright">
                                            <?php /*?><input type="text" name="dimension" value="<?php echo $getmultidimension['dimension']; ?>"  /><?php */?>
                                            <?php echo $getmultidimension['dimension']; ?>
                                        </td>
                                        <td class="formright">
                                             <?php /*?> <input type="text" name="price" value="<?php echo $getmultidimension['price']; ?>"/><?php */?>
                                             <?php echo CURRENCY_SIGN; ?> <?php echo $getmultidimension['price']; ?>
                                        </td>
                                         <td class="formright">
                                             <?php /*?> <input type="text" name="delivery_price" value="<?php echo $getmultidimension['delivery_price']; ?>"  /><?php */?>
                                              <?php echo CURRENCY_SIGN; ?> <?php echo $getmultidimension['delivery_price']; ?>
                                        </td>
                                         <td class="formright">
                                             <?php /*?> <input type="text" name="delivery_price" value="<?php echo $getmultidimension['delivery_price']; ?>"  /><?php */?>
                                              <?php echo CURRENCY_SIGN; ?> <?php echo $getmultidimension['delivery_price_more_than_three']; ?>
                                        </td>
                                         <td class="formright">
                                             <?php /*?> <input type="text" name="delivery_price" value="<?php echo $getmultidimension['delivery_price']; ?>"  /><?php */?>
                                              <?php echo CURRENCY_SIGN_NZ; ?> <?php echo $getmultidimension['delivery_price_nz']; ?>
                                        </td>
                                         <td class="formright">
                                             <?php /*?> <input type="text" name="delivery_price" value="<?php echo $getmultidimension['delivery_price']; ?>"  /><?php */?>
                                              <?php echo CURRENCY_SIGN_NZ; ?> <?php echo $getmultidimension['delivery_price_nz_more_than_three']; ?>
                                        </td>
                                        <td class="formcenter">
                                           	<a href="ajax/dimension_edit.php?id=<?php echo $getmultidimension['dimension_id']; ?>" title="Edit" class="dimension_edit fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="dimension_delete" rel="<?php echo $getmultidimension['dimension_id']; ?>" title="Delete"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                   
                                        </td>
                                    </tr>
                                    <?php
									}
									?>
                                    <script>
									$(function(){
										$('.dimension_edit').fancybox({
											beforeClose: function(){
												$.ajax({
													url: 'ajax/blog_show.php',
													type: 'post',
													data: {},
													success: function(data){
														$('#blog_block').html(data);
													}
												});	
											}
										});
										$('.dimension_delete').click(function(){
											   if(confirm("Are you sure that you wish to delete this dimension?")){
												var t=$(this);
												$.ajax({
													url: 'ajax/dimension_delete.php',
													type: 'post',
													data: { id: t.attr('rel') },
													success: function(data){
														t.parent().parent().hide();
													}
												});	
											}
										});
									});
									</script>
                                    </table>
        
                            </td>
                        </tr>
					<?php
                    }
                    ?>
                
                    <tr>
                        <td colspan="2" class="formright">
                        <b>If you wish to add a new dimension, please provide it's price and delivery price below and click the "Save" button.</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="formleft" style="width:440px;">Dimension</td>
                        <td  class="formright"><input  style="width:136px;"  id='dimension' type="text" name="dimension" class="mytextbox"  /></td>
                    </tr>
                    <tr>
                        <td class="formleft" >Price </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="price" type="text"  name="price" class="mytextbox"></td>
                    </tr>
                     <tr>
                        <td class="formleft">1 or 2 (Australia) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="delivery_price" type="text" name="delivery_price" class="mytextbox"/></td>
                    </tr>
                       <tr>
                        <td class="formleft">3 and above (Australia) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN; ?> <input style="width:100px;" id="delivery_price_more_than_three" type="text" name="delivery_price_more_than_three" class="mytextbox"/></td>
                    </tr>
                       <tr>
                        <td class="formleft">1 or 2(New Zealand) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN_NZ; ?> <input style="width:100px;" id="delivery_price_nz" type="text" name="delivery_price_nz" class="mytextbox"/></td>
                    </tr>
                       <tr>
                        <td class="formleft">3 and above (New Zealand) </td>
                        <td class="formright"><?php echo CURRENCY_SIGN_NZ; ?> <input style="width:100px;" id="delivery_price_nz_more_than_three" type="text" name="delivery_price_nz_more_than_three" class="mytextbox"/></td>
                    </tr>
					
        
                  <tr>
                      <td class="formleft">&nbsp;</td>
                      <td class="formright"><input type="submit" value="Save" class="mybtn" /></td>
                  </tr>
          </table>
          <input type="hidden" name="product_id" value="<?php echo stripslashes($row_pro['product_id']); ?>" />
           <input type="hidden" name="submitted" value="multi_dimension" />
          
          </form>
          		
         
          
          
          <div class="clearboth"></div>
      </div>
  </div>
<!-- ###################################################  MULTI DIMENSION PRODUCTS  ##################################################################################-->
<?php
}
?>
<!-- ###################################################  Roomset IMAGES  START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="product_images" class="accordiontab">CLICK HERE TO EDIT THE PRODUCT IMAGES</a></div>
<div id="product_images" class="accordionblock" style="display:<?php echo (isset($show_tab) and ($show_tab=="available_image" or $show_tab=="product_images"))?"block":"none"; ?>;">
<?php /*?><div class="info">
Note:
</div><?php */?>
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
                    <div style="border:#DDD 1px solid;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:150px">
                      <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_pro['product_image_sm']; ?>" width="150" border="0" />
                      <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_pro_smimg&id=<?php echo $row_pro['product_id']; ?>','Are you sure that you want to delete this image ?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" style="padding-top:10px;" /></a>
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
                      <br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and  <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                     
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
                    <div style="border:#DDD 1px solid;padding:10px 10px 10px 10px;margin: 10px 5px 10px 5px; width:200px">
                      <img src="<?php echo SITE_URL.PRO_IMG.$row_pro['product_image_lg']; ?>" width="200" border="0" />
                      <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_pro_lgimg&id=<?php echo $row_pro['product_id']; ?>','Are you sure that you want to delete this image ?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" style="padding-top:10px;" /></a>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td class="formleft">Replace large image</td>
                  <td class="formright">
                      <input type="file" name="theimagemd" />
                
                      <b><br />The uploaded large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
                       <br />The dimensions of this image should be <?php echo PRO_IMG_TH_W;?> px in width and  <?php echo PRO_IMG_TH_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                     <br />If you decide to upload a new image, it will replace the existing one.
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
                      <br />The dimensions of this image should be <?php echo PRO_IMG_W;?> px in width and  <?php echo PRO_IMG_H;?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality. 
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
 <!-- ###################################################   Roomset IMAGES  END   ##################################################################################-->

    <div class="accordion"><a href="JavaScript:void(0);" rel="colourways" class="accordiontab">CLICK HERE TO ADD OR EDIT COLOURWAYS FOR THIS PRODUCT</a></div>
	<div id="colourways" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="colourways")?"block":"none"; ?>;">        
       <div class="myadd" style="margin-top:10px; margin-left:10px;">
    	<a href="ajax/colourways_add.php?id=<?php echo $product_id; ?>" class="colourways_add_link fancybox.ajax">Add new colourway</a>
    </div>
    	<div class="clearboth"></div>
    	<script>
	$(function(){
		$('.colourways_add_link').fancybox();
	});
	</script>              
  
          <script>
	$(function(){
		$('.scroll_add_link').fancybox({
			'beforeClose': function(){
				$.ajax({
					url: 'ajax/colourways_show.php',
					type: 'post',
					data: {},
					success: function(data){
						$('#scroll_block').html(data);
					}
				});	
			}
		});
	});
	</script>
    <div id="scroll_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/colourways_show.php?id=<?php echo $product_id; ?>',
				type: 'post',
				data: {},
				success: function(data){
					$('#scroll_block').html(data);
				}
			});
		});
		</script>

</div>
 
     

          </div>

 <!-- ###################################################   DOWNLOADABLE DOCUMENTS START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="downloadablefiles" class="accordiontab">CLICK HERE TO MANAGE CUSTOM COLOURS PDF FILE</a></div>
<div id="downloadablefiles" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="downloadablefiles")?"block":"none"; ?>;">

  <form action="" method="post" enctype="multipart/form-data">
    <table border="0" class="myform">
      <tr>
        <td colspan="2" class="formright"><b>If you wish to upload a Custom Colours PDF file for this product, please browse to your folders and select the file that you wish to upload. 
          When you are ready to do so please click the save button below. </b></td>
      </tr>
      <?php
  if(!empty($row_pro["product_pdf_file"]))
  {
	  ?>
      <tr>
        <td class="formleft">PDF file</td>
        <td class="formright"><div style="float:left;border:#DDD 1px solid;background: url(images/icons/att.png) 10px no-repeat #EEE;padding:15px 0 15px 40px;width:450px;"> <a href="<?php echo SITE_URL.DOCUMENTS.$row_pro['product_pdf_file']; ?>" class="downloadlink" target="_blank"><?php echo $row_pro["product_pdf_file"];?></a> </div>
          <div style="float:left;border:#DDD 1px solid;background:#EEE;padding:14px;"> <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_pdf_file&id=<?php echo $_REQUEST['id']; ?>','Are you sure that you want to delete this file?');" title="Delete"><img src="images/icon_delete.png" width="27" height="27" border="0" /></a> </div>
          <div class="clearboth"></div>
          <b>If you wish to remove the PDF file from this product, click on the cross icon above.</b></td>
      </tr>
      <tr>
        <td class="formleft">Replace PDF file</td>
        <td class="formright"><input type="file" name="product_pdf_file" /></td>
      </tr>
      <?php 
  }
  else
  {
	  ?>
      <tr>
        <td class="formleft">PDF file</td>
        <td class="formright"><input type="file" name="product_pdf_file" /></td>
      </tr>
      <?php
  }
  ?>
<?php /*?>      <tr>
        <td colspan="2" class="formright"><b>If you wish to upload a DWG file for this product, please browse to your folders and select the file that you wish to upload. 
          When you are ready to do so please click the Save below. Please note that if you do not upload a file, there will be no indication of CAD or DWG on the main website. </b></td>
      </tr>
      <?php
  if(!empty($row_pro["product_cad_file"]))
  {
	  ?>
      <tr>
        <td class="formleft">CAD file</td>
        <td class="formright"><div style="float:left;border:#DDD 1px solid;background: url(images/icons/att.png) 10px no-repeat #EEE;padding:15px 0 15px 40px;width:450px;"> <a href="<?php echo SITE_URL.DOCUMENTS.$row_pro['product_cad_file']; ?>" class="downloadlink" target="_blank"><?php echo $row_pro["product_cad_file"];?></a> </div>
          <div style="float:left;border:#DDD 1px solid;background:#EEE;padding:14px;"> <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_cad_file&id=<?php echo $_REQUEST['id']; ?>','Are you sure that you want to delete this file?');" title="Delete"><img src="images/icon_delete.png" width="27" height="27" border="0" /></a> </div>
          <div class="clearboth"></div>
          <b>If you wish to remove the cad file from this product, click on the cross icon above.</b></td>
      </tr>
      <tr>
        <td class="formleft">Replace CAD file</td>
        <td class="formright"><input type="file" name="product_cad_file" />
          <b><br />
          Uploading new file will replace the existing one.</b></td>
      </tr>
      <?php 
  }
  else
  {
	  ?>
      <tr>
        <td class="formleft">CAD file</td>
        <td class="formright"><input type="file" name="product_cad_file" />
          <b><br />
          If you wish to upload a CAD file for this product, please browse.</b></td>
      </tr>
      <?php
  }
  ?><?php */?>
      <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright"><input type="submit" value="Save" class="mybtn" /></td>
      </tr>
    </table>
    <input type="hidden" name="product_id" id="product_id" value="<?php echo stripslashes($_REQUEST['id']); ?>" />
    <input type="hidden" name="submitted" value="downloadablefiles" />
  </form>
</div>
<!-- ###################################################   DOWNLOADABLE DOCUMENTS END    ##################################################################################-->
<?php
if($row_pro['multi_dimension']==0)
{
?>
<!-- ###################################################   PRICE START   ##################################################################################-->
<div class="accordion"><a href="JavaScript:void(0);" rel="price_list" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="price") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO ADD OR EDIT PRICE FOR THIS ITEM</a></div>
  <div id="price_list" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="price_list")?"block":"none"; ?>;">
  <div class="info"> Please provide the price for this item that you wish to have. </div>
  <form id="form_page_price">
    <table border="0" class="myform">
   
      <tr>
        <td class="formleft" >Price per <?php if(!empty($row_pro['sold_by'])){ echo $row_pro['sold_by']; }else{ echo 'metre'; } ?></td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input class="mytextbox" type="text" style="width:100px;" name="price_per_meter" value="<?php echo stripslashes($product_price['price_per_meter']); ?>" /></td>
      </tr>
        <tr>
        <td class="formleft">Sample price</td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input type="text"  style="width:100px;" name="sample_price" value="<?php echo stripslashes($product_price['sample_price']); ?>" class="mytextbox" /></td>
      </tr>
      <?php /*?>
      <tr>
       <td class="formleft">Delivery price</td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input type="text"  style="width:100px;" name="delivery_price" value="<?php echo stripslashes($product_price['delivery_price']); ?>" class="mytextbox" /></td>
      </tr>
          <tr>
       <td class="formleft">Delivery price for three and more (Australia) </td>
        <td class="formright"><?php echo CURRENCY_SIGN; ?><input type="text"  style="width:100px;" name="delivery_price_more_than_three" value="<?php echo stripslashes($product_price['delivery_price_more_than_three']); ?>" class="mytextbox" /></td>
      </tr>
      <tr>
       <td class="formleft" >Delivery price less than three (New Zealand) </td>
        <td class="formright"><?php echo CURRENCY_SIGN_NZ; ?><input type="text"  style="width:100px;" name="delivery_price_nz" value="<?php echo stripslashes($product_price['delivery_price_nz']); ?>" class="mytextbox" /></td>
      </tr>
         <tr>
       <td class="formleft">Delivery price for three and more (New Zealand) </td>
        <td class="formright"><?php echo CURRENCY_SIGN_NZ; ?><input type="text"  style="width:100px;" name="delivery_price_nz_more_than_three" value="<?php echo stripslashes($product_price['delivery_price_nz_more_than_three']); ?>" class="mytextbox" /></td>
      </tr><?php */?>
      <input type="hidden" name="delivery_price" value="<?php echo stripslashes($product_price['delivery_price']); ?>" />
<input type="hidden" name="delivery_price_more_than_three" value="<?php echo stripslashes($product_price['delivery_price_more_than_three']); ?>" />
<input type="hidden" name="delivery_price_nz" value="<?php echo stripslashes($product_price['delivery_price_nz']); ?>" />
<input type="hidden" name="delivery_price_nz_more_than_three" value="<?php echo stripslashes($product_price['delivery_price_nz_more_than_three']); ?>" />

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
<?php
}
?>
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