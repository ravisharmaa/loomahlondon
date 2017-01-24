<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");

$parent_id=$_REQUEST['id'];
$row_content=$cat->showCategory($parent_id);
if(isset($_POST['cat_id']))
{
	echo $cat->addCategory();
	exit;
}

?>
<div class="container" style="margin:0;">
    <h1>Add a collection</h1>
    <div class="clearboth"></div>
    <div class="info">
        Provide the <?php echo strtolower(stripslashes($row_content['cat_banner_title'])); ?> name and its image that you wish to add.
    </div>
    <form id="form_cat_add">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Name</td>
        <td class="formright"><input type="text" name="cat_name" value="" class="mytextbox" /></td>
    </tr>
   <tr>
        <td class="formleft">Description</td>
        <td class="formright"><textarea name="cat_desc" class="mytextarea"></textarea></td>
    </tr>
   
    <tr>
        <td class="formleft">Upload Thumbnail Image</td>
        <td class="formright"><input type="file" id="cat_image" name="cat_image" />
        <br /><b>The uploaded image will appear on the <?php echo strtolower(stripslashes($row_content['cat_banner_title'])); ?> page.
        <br />The dimension of this image should be <?php echo CAT_IMG_W; ?> px in width and <?php echo CAT_IMG_H; ?> px in height. Please note that if the dimensions of the image are different than suggested the image will either appear as squashed or compromised in quality.</b>
        </td>
    </tr>
    <?php
	if($parent_id!=3){
	?>
     <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">Would you like to add small order fee?
        &nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk_small_order_fee" value="1" class="chb yes" />&nbsp;&nbsp; Yes
          &nbsp;&nbsp;&nbsp;<input type="checkbox" name="chk_small_order_fee" value="0" checked class="chb no" />&nbsp;&nbsp; No
        </td>
    </tr>

    <tr  class="myform hide" style="display:none">
        <td class="formleft">For Quantities Under</td>
        <td class="formright"><input type="number" min="0" name="small_order_qty" class="mytextbox" style="width:100px;" />metres
        </td>
    </tr>
     <tr  class="myform hide"  style="display:none" >
        <td class="formleft">Small Order Fee (<?php echo CURRENCY_SIGN;?>)</td>
        <td class="formright"><input type="text" min="0" name="small_order_fee" class="mytextbox" style="width:100px;" />
        </td>
    </tr>
<?php
	}
	?>
 
    
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn cat_add" />
        	<div class="saving">Saving...</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="cat_id" value="<?php echo $parent_id; ?>" />
    </form>
    <script>
	$(".chb").change(function() {
		var checked = $(this).is(':checked');
		$(".chb").prop('checked',false);
		if(checked) {
			$(this).prop('checked',true);
		}
	});
	$(".yes").click(function(){
		$(".hide").show();
		
	});
	$(".no").click(function(){
		$(".hide").hide();
		
	});
	
	</script>
    <script>
	$(function(){
		$('.cat_add').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/category_add.php?id=<?php echo $parent_id; ?>',
				type: 'post',
				data: $('#form_cat_add').serialize(),
				success: function(id){
					$("#cat_image").upload("ajax/category_image_upload.php?id="+id,function(res){
						$(location).attr('href','login.php?p_id=manage_products&id='+id);	
					},function(data) {
					});
				}
			})
		});
	});
	</script>
</div>