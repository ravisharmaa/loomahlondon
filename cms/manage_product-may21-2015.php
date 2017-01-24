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
$cat_id=$row_pro['cat_id'];
$row_cat=$cat->showCategory($cat_id);
?>
<h1><?php echo stripslashes($row_pro['product_name']); ?></h1>
<div class="goback"><a href="login.php?p_id=manage_products&id=<?php echo $cat_id; ?>">Back to <?php echo stripslashes($row_cat['cat_name']); ?></a></div>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_cats">Mirror Gallery</a> &raquo; <a href="login.php?p_id=manage_products&id=<?php echo $cat_id; ?>"><?php echo stripslashes($row_cat['cat_name']); ?></a> &raquo; <?php echo stripslashes($row_pro['product_name']); ?>
</div>

<div class="accordion"><a href="JavaScript:void(0);" rel="pro_detail" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="pro_detail") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT THE PRODUCT DETAIL</a></div>
<div id="pro_detail" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="pro_detail")?"block":"none"; ?>;">
	<div class="info">
        Provide the product name and its detail that you wish to update.
    </div>
    <form id="form_product_edit">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Product Name</td>
        <td class="formright"><input type="text" name="product_name" value="<?php echo stripslashes($row_pro['product_name']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Product Reference</td>
        <td class="formright"><input type="text" name="product_code" value="<?php echo stripslashes($row_pro['product_code']); ?>" class="mytextbox" style="width:100px;" /></td>
    </tr>
    <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="product_desc" class="mytextarea"><?php echo stripslashes($row_pro['product_desc']); ?></textarea></td>
    </tr>
    <?php
	if(empty($row_pro['product_image']))
	{
		?>
        <tr>
            <td class="formleft">Upload Image</td>
            <td class="formright"><input type="file" id="product_image" name="product_image" value="" /></td>
        </tr>
		<?php
	}
	else
	{
		?>
    	<tr>
            <td class="formleft">Image</td>
            <td class="formright"><img src="../<?php echo PRO_IMG.$row_pro['product_image']; ?>" width="200" /></td>
        </tr>
		<tr>
            <td class="formleft"></td>
            <td class="formright"><input type="file" id="product_image" name="product_image" /></td>
        </tr>
		<?php
	}
	?>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn product_edit" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.product_edit').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/product_edit.php',
				type: 'post',
				data: $('#form_product_edit').serialize(),
				success: function(){
					$("#product_image").upload("ajax/product_image_upload.php?id=<?php echo $product_id; ?>",function(res){
						$('.saving').fadeOut(function(){
							$('.saved').show().delay(1000).hide(function(){
								t.show();	
							});	
						});
					},function(data) {
					});
				}
			})
		});
	});
	</script>
</div>


<div class="accordion"><a href="JavaScript:void(0);" rel="pro_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="pro_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE PRODUCT PAGE</a></div>
<div id="pro_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="pro_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the product page that you wish to have.
    </div>
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
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_seo" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
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
				}
			})
		});
	});
	</script>
</div>