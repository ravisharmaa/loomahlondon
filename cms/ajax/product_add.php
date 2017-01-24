<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['cat_id']))
{
	echo $product_id=$pro->addProduct();
	//$pro->addColourwaysAtStart($product_id);
	exit;
}

$cat_id=$_REQUEST['id'];
$row_cat=$cat->showCategory($cat_id);

$parent_id=$row_cat['parent_id'];
//echo $parent_id;
?>
<div class="container" style="margin:0;">
    <h1>Add Product</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the product name and its detail that you wish to add.
    </div>

    <form id="form_pro_add" name="main_image_add" enctype="multipart/form-data">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Product Name</td>
        <td class="formright"><input type="text" name="product_name" value="" class="mytextbox" /></td>
    </tr>
     <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="product_desc" class="mytextarea"></textarea></td>
    </tr>
    <?php if($parent_id=='1')
	{
	?>
    <input type="hidden" name="sold_by" value="metre" />
    <?php
	 }
	?>
     <?php if($parent_id=='2')
	{
	?>
    <input type="hidden" name="sold_by" value="roll" />
    <?php
	 }
	?>
     <?php if($parent_id=='3')
	{
	?>
    <input type="hidden" name="sold_by" value="piece" />
    <?php
	 }
	?>

   <?php /*?> <tr>
        <td class="formleft">Sold As</td>
        <td class="formright"> 
            <select name="sold_by" style="min-width:80px;">
                 <option style="padding:3px 6px;"  <?php if($parent_id=='1') echo "selected"; ?> value="metre">Per Metre</option>
                 <option style="padding:3px 6px;" <?php if($parent_id=='2') echo "selected"; ?> value="roll">Per Roll</option>
                  <option style="padding:3px 6px;" <?php if($parent_id=='3') echo "selected"; ?> value="piece">Per Piece</option>
             </select>
             
         </td>
      </tr><?php */?>
      <tr>
          <td class="formleft">&nbsp;</td>
              <td class="formright">Would you like to add a product with limited stock quantity?<br />
                  <input type="radio" name="min_stock" class="min_stock_yes" value="1"  /> Yes
                  
                   <input type="radio" name="min_stock" class="min_stock_no" value="0" checked="checked"  /> No
                   
                  <?php /* <input type="radio" name="alt_img_radio" class="colourways_no"  /> Without Colourways */?>
              </td>
          </tr>
      <tr style="display:none;" class="show_qty">
          <td class="formleft">Available QTY</td>
              <td class="formright"><input class="mytextbox"  style="width:60px;" min="0" type="number" name="qty" /></td>
          </tr>
    <tr>
          <td class="formleft">&nbsp;</td>
              <td class="formright">Would you like to add a product without colourways?<br />
                  <input type="radio" name="alt_img_radio" class="colourways_yes"  /> Yes
                  
                   <input type="radio" name="alt_img_radio" class="colourways_no" checked="checked"  /> No
                   
                  <?php /* <input type="radio" name="alt_img_radio" class="colourways_no"  /> Without Colourways */?>
              </td>
          </tr>
            
    </table>
        <script>
	$(function(){
		$('.min_stock_yes').click(function(){
		//alert('hellow');
		//$('.show_qty').hide();
		$('.show_qty').show();
		});
		$('.min_stock_no').click(function(){
		$('.show_qty').hide();
		//$('.min_stock_no').show();
		});
	});
	</script>
    <script>
	$(function(){
		$('.colourways_yes').click(function(){
		//alert('hellow');
		$('.upload_colourways_no').hide();
		$('.upload_colourways_yes').show();
		});
		$('.colourways_no').click(function(){
		$('.upload_colourways_yes').hide();
		$('.upload_colourways_no').show();
		});
	});
	</script>
   <?php /*  <script>
	$(function(){
		$('.colourways_yes').click(function(){
		//alert('hellow');
		$('.upload_colourways_no').hide();
		$('.upload_colourways_yes').show();
		});
		$('.colourways_no').click(function(){
		$('.upload_colourways_yes').hide();
		$('.upload_colourways_no').show();
		});
	});
	</script> */?>
    <table border="0" class="myform upload_colourways_yes" style="display:none;" >
    <tr>
    <td  class="formright"  colspan="2"> Please upload the product images
    </td>
    </tr>
        <tr>
        <td class="formleft">Thumbnail Image</td>
        <td class="formright"><input type="file" id="ptheimageth" name="ptheimageth" />
        <b>
        <br />The uploaded thumbnail image will appear on the category products page.
        <br />The dimension of this image should be <?php echo PRO_IMG_TH_W ?> px in width and <?php echo PRO_IMG_TH_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
        </b></td>
    </tr>
     <tr>
        <td class="formleft">Large Image</td>
        <td class="formright"><input type="file" id="ptheimagemd" name="ptheimagemd" />
        <b><br />Uploading large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
        <br />The dimensions of the image should be <?php echo PRO_IMG_W ?> px in width.
        <br />The height may vary with a maximum height of <?php echo PRO_IMG_H ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.</b></td>
    </tr>
    </table>
      
 <table border="0" class="myform" >
 <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save"  class="mybtn pro_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
  <?php /*  <table border="0" class="myform upload_colourways_yes" style="display:none">
    <tr>
          <td class="formleft">
         	 Colourways title
          </td>
          <td  class="formright">
               <input type="text" name="colourways_img_name"  class="mytextbox" style="width:200px;"  /><br /><br />
          </td>
    </tr>
    <tr>
        <td class="formleft">Thumbnail Image</td>
        <td class="formright"><input type="file" id="ctheimageth" name="ctheimageth" />
        <b>
        <br />The uploaded thumbnail image will appear on the category products page.
        <br />The dimension of this image should be <?php echo PRO_IMG_TH_W ?> px in width and <?php echo PRO_IMG_TH_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
        </b></td>
    </tr>
     <tr>
        <td class="formleft">Large Image</td>
        <td class="formright"><input type="file" id="ctheimagemd" name="ctheimagemd" />
        <b><br />Uploading large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
        <br />The dimensions of the image should be <?php echo PRO_IMG_W ?> px in width.
        <br />The height may vary with a maximum height of <?php echo PRO_IMG_H ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.</b></td>
    </tr>
 
    </table> */?>
      <input type="hidden" name="imagetype" value="2" />
    <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
    </form>
    
     <script>
	$(function(){
		$('.pro_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/product_add.php',
				type: 'post',
				data: $('#form_pro_add').serialize(),
				success: function(id){
					$("#ptheimageth").upload("ajax/product_image_upload.php?id="+id,function(res){
					},function(data) {
					});
					$("#ptheimagemd").upload("ajax/product_image_upload.php?id="+id,function(res){
						$(location).attr('href','login.php?p_id=manage_product&id='+id);	
					},function(data) {
					});
				
					
				}
			})
		});
	});
	</script>
  <?php /*?>     <script>
	$(function(){
		$('.pro_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/product_add.php',
				type: 'post',
				data: $('#form_pro_add').serialize(),
				success: function(id){
					$("#ctheimageth").upload("ajax/colourways_image_upload.php?id="+id,function(res){
					},function(data) {
					});
						$("#ctheimagemd").upload("ajax/colourways_image_upload.php?id="+id,function(res){
							
					},function(data) {
					});
					$("#ptheimageth").upload("ajax/product_image_upload.php?id="+id,function(res){
					},function(data) {
					});
						$("#ptheimagemd").upload("ajax/product_image_upload.php?id="+id,function(res){
						$(location).attr('href','login.php?p_id=manage_product&id='+id);	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
  <script>
	$(function(){
		$('.pro_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/product_add.php',
				type: 'post',
				data: $('#form_pro_add').serialize(),
				success: function(id){
				  $(location).attr('href','login.php?p_id=manage_product&id='+id);
				}
			})
		});
	});
	</script><?php */?>
</div>