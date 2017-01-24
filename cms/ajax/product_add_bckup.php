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
	echo $pro->addProduct();
	exit;
}
$cat_id=$_REQUEST['id'];
?>
<div class="container" style="margin:0;">
    <h1>Add Product</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the product name and its detail that you wish to add.
    </div>
    		  <script language="javascript">
          function form_validate(){
          if(document.main_image_add.theimageth.value==""){
          alert("Please upload the thumbnail image")
          return false;
          }
          if(document.main_image_add.theimagemd.value==""){
          alert("Please upload the large image")
          return false;
          }
          }
          </script>
    <form id="form_pro_add" name="main_image_add" onsubmit="return form_validate();" enctype="multipart/form-data">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Product Name</td>
        <td class="formright"><input type="text" name="product_name" value="" class="mytextbox" /></td>
    </tr>
     <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="product_desc" class="mytextarea"></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Roomset Thumbnail Image</td>
        <td class="formright"><input type="file" id="theimageth" name="theimageth" />
        <b>
        <br />The uploaded thumbnail image will appear on the category products page.
        <br />The dimension of this image should be <?php echo PRO_IMG_TH_W ?> px in width and <?php echo PRO_IMG_TH_H ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.
        </b></td>
    </tr>
     <tr>
        <td class="formleft">Roomset Large Image</td>
        <td class="formright"><input type="file" id="theimagemd" name="theimagemd" />
        <b><br />Uploading large image will appear on the product detail page. These also used for the magnified view and the enlarged image when clicked.
        <br />The dimensions of the image should be <?php echo PRO_IMG_W ?> px in width.
        <br />The height may vary with a maximum height of <?php echo PRO_IMG_H ?> px. For example a wider (landscape shaped) product may not required as much height as a square shaped product or portrait shaped product.</b></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn pro_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
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
					$("#theimageth").upload("ajax/product_image_upload.php?id="+id,function(res){
					},function(data) {
					});
						$("#theimagemd").upload("ajax/product_image_upload.php?id="+id,function(res){
						$(location).attr('href','login.php?p_id=manage_product&id='+id);	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
</div>