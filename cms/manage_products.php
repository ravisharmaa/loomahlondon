<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$content_id=2;
$show_tab="pro_list";
$cat_id=$_REQUEST['id'];
$row_cat=$cat->showCategory($cat_id);
$parent_id=$row_cat['parent_id'];
$row_parent=$cat->showCategory($parent_id);

?>
<h1><?php echo stripslashes($row_cat['cat_name']); ?></h1>
<div class="goback" style="width:330px;">
	<?php if($row_parent['cat_id']==1){?><a href="login.php?p_id=manage_textiles&id=1">Back to <?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
	<?php if($row_parent['cat_id']==2){?><a href="login.php?p_id=manage_wallpapers&id=2">Back to <?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
    <?php if($row_parent['cat_id']==3){?><a href="login.php?p_id=manage_decorative_pieces&id=3">Back to <?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?></div>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo;
    <?php if($row_parent['cat_id']==1){?><a href="login.php?p_id=manage_textiles&id=1"><?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
	<?php if($row_parent['cat_id']==2){?><a href="login.php?p_id=manage_wallpapers&id=2"><?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
    <?php if($row_parent['cat_id']==3){?><a href="login.php?p_id=manage_decorative_pieces&id=3"><?php echo stripslashes($row_parent['cat_name']); ?></a><?php }?>
	
	 &raquo; <?php echo stripslashes($row_cat['cat_name']); ?> 
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="cat_detail" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="cat_detail") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE DETAILS OF <?php echo strtoupper(stripslashes($row_cat['cat_name'])); ?></a></div>
<div id="cat_detail" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="cat_detail")?"block":"none"; ?>;">
	<div class="info">
        Provide the title, description and its image that you wish to update.
    </div>
    <form id="form_cat_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="cat_name" value="<?php echo stripslashes($row_cat['cat_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="cat_desc" class="myeditor"><?php echo stripslashes($row_cat['cat_desc']); ?></textarea></td>
    </tr>
    
    <?php
	if(empty($row_cat['cat_image']))
	{
		?>
        <tr>
            <td class="formleft">Upload Thumbnail Image</td>
            <td class="formright"><input type="file" id="cat_images" name="cat_image" value="" />
            <b class="line_height"><br />The uploaded image will appear on the <?php echo strtolower(stripslashes($row_parent['cat_banner_title'])); ?> page.
            <br /> <br />The dimension of this image should be <?php echo CAT_IMG_W ?> px in width and <?php echo CAT_IMG_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
                        </b>
            
            </td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Thumbnail Image</td>
            <td class="formright showimgage"><img src="../<?php echo CAT_IMG.$row_cat['cat_image']; ?>" width="200" /></td>
        </tr>
		<tr>
            <td class="formleft">Replace Thumbnail Image</td>
            <td class="formright"><input type="file" id="cat_images" name="cat_image" />
             <b class="line_height"><br />The uploaded image will appear on the <?php echo strtolower(stripslashes($row_parent['cat_banner_title'])); ?> page.
            <br /><br />The dimension of this image should be <?php echo CAT_IMG_W ?> px in width and <?php echo CAT_IMG_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
            <br /><br />If you decide to upload a new image, it will replace the existing one. 
            </b></td>
        </tr>
        
		<?php
	}
	?>
    <?php /*?>  <tr>
        <td class="formleft">Photo Credit</td>
        <td class="formright"><input type="text" name="photo_credit" value="<?php echo $row_cat['photo_credit']; ?>" class="mytextbox" /></td>
    </tr><?php */?>
    <input type="hidden" name="photo_credit" value="" class="mytextbox" />
    <?php
	if($parent_id!=3){
	?>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">Would you like to add small order fee?
        &nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk_small_order_fee" value="1" <?php if($row_cat['chk_small_order_fee']==1){ echo "checked";} ?> class="chb yes" />&nbsp;&nbsp; Yes
          &nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk_small_order_fee" value="0" <?php if($row_cat['chk_small_order_fee']==0){ echo "checked";} ?> class="chb no" />&nbsp;&nbsp; No
        </td>
    </tr>

   	 <tr  class="myform hide"  <?php if($row_cat['chk_small_order_fee']==0){?> style="display:none" <?php }?>>
        <td class="formleft">For Quantities Under</td>
        <td class="formright"><input type="number" min="0" name="small_order_qty" class="mytextbox" style="width:100px;" value="<?php echo $row_cat['small_order_qty'];  ?>"/>metres
        </td>
    </tr>
     <tr  class="myform hide" <?php if($row_cat['chk_small_order_fee']==0){?> style="display:none" <?php }?>>
        <td class="formleft">Small Order Fee (<?php echo CURRENCY_SIGN;?>)</td>
        <td class="formright"><input type="text" min="0" name="small_order_fee" class="mytextbox" style="width:100px;" value="<?php echo $row_cat['small_order_fee'];  ?>"/>
        </td>
    </tr>
    <?php
	}
	?>

    
    
	<tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn cat_edit" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
        
        
        
    </tr>
    
    
    </table>
 

	
	
     <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
    </form>
    <script>
	
	$(".chb").change(function() {
    $(".chb").prop('checked', false);
    $(this).prop('checked', true);
});

	$(".yes").click(function(){
		$(".hide").show();
		
	});
	$(".no").click(function(){
		$(".hide").hide();
		
	});
	
	</script>
</div>
    <script>
	$(function(){
		$('.cat_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/cat_edit.php',
				type: 'post',
				data: $('#form_cat_edit').serialize(),
				success: function(){
					$("#cat_images").upload("ajax/cat_image_upload.php?id=<?php echo $cat_id; ?>",function(res){
						$('.saving').fadeOut(function(){
							$('.saved').fadeIn(function(){
								$(this).fadeOut(function(){
									t.show();
								});
							});
						});
						
						$.ajax({
							url: 'ajax/show_change_img_cat.php?id=<?php echo $cat_id; ?>',
							type: 'post',
							data: $('#form_page_content').serialize(),
							success: function(data){
								$('.showimgage').html(data);
							}
						});
					},function(data){
					alertify.success('Successfully Saved.');
					});
				}
			})
		});
	});
	</script>
<div class="accordion"><a href="JavaScript:void(0);" rel="slide_show" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="slide_show") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE IMAGES OF <?php echo strtoupper(stripslashes($row_cat['cat_name'])); ?> FOR THE SLIDESHOW</a></div>
<div id="slide_show" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="slide_show")?"block":"none"; ?>;">
	<div class="info">
        Provided below are the slide images that feature within the <?php echo stripslashes($row_cat['cat_name']); ?> page.
        <br /><br />
        Click the "Add a slide image" button below if you wish to add a slide image.
        <br /><br />
          In the unlikely event that you wish to delete a slide image, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which slide images are displayed, you can drag and drop a slide image to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/designer_slideimage_add.php?id=<?php echo $cat_id; ?>" class="slide_add_link fancybox.ajax">Add a slide image</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.slide_add_link').fancybox({
			'beforeClose': function(){
				$.ajax({
					url: 'ajax/designer_slideimage_show.php?id=<?php echo $cat_id; ?>',
					type: 'post',
					data: {},
					success: function(data){
						$('#slideshow_block').html(data);
					}
				});	
			}
		});
	});
	</script>
    <div id="slideshow_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/designer_slideimage_show.php?id=<?php echo $cat_id; ?>',
				type: 'post',
				data: {},
				success: function(data){
					$('#slideshow_block').html(data);
					
				}
			});
		});
		</script>
	</div>
</div>
<div class="accordion"><a href="JavaScript:void(0);" rel="pro_list" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="pro_list") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO MANAGE THE PRODUCTS WITHIN THE <?php echo strtoupper(stripslashes($row_cat['cat_name'])); ?></a></div>
<div id="pro_list" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="pro_list")?"block":"none"; ?>;">
	<div class="info">
        Provided below are the products that feature within the <?php echo strtolower(stripslashes($row_cat['cat_name'])); ?> products page.
        <br /><br />
        Click the "Add a product" button below if you wish to add a product.
        <br /><br />
        Click on the image or pencil icon to edit its detail.
        <br /><br />
        In the unlikely event that you wish to delete a product, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which products are displayed, you can drag and drop a product to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/product_add.php?id=<?php echo $cat_id; ?>" class="product_add_link fancybox.ajax">Add a product</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.product_add_link').fancybox();
	});
	</script>
    <div id="pro_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/product_show.php',
				type: 'post',
				data: { id: '<?php echo $cat_id; ?>' },
				success: function(data){
					$('#pro_block').html(data);
				}
			});
		});
		</script>
	</div>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="cat_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="cat_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE <?php echo strtoupper(stripslashes($row_cat['cat_name'])); ?> PAGE</a></div>
<div id="cat_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="cat_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the <?php echo strtolower(stripslashes($row_cat['cat_name'])); ?> page that you wish to have.
    </div>
    <form id="form_page_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="cat_titletag" value="<?php echo stripslashes($row_cat['cat_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="cat_metakeywords" class="mytextarea"><?php echo stripslashes($row_cat['cat_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="cat_metadescription" class="mytextarea"><?php echo stripslashes($row_cat['cat_metadescription']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_seo" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_seo').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/cat_seo_save.php',
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