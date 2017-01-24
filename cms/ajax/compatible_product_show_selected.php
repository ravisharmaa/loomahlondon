<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
?>
<style>
#mysorter_cp{
	list-style: none;	
}
#mysorter_cp li{
	float: left;
	list-style: none;
	margin: 10px; 
}
</style>
<ul id='mysorter_cp'>
	<?php
	$row_compatibles=$pro->showCompatibleProducts($_POST['id']);
	if(count($row_compatibles))
	{
    	foreach($row_compatibles as $row_compatible)
		{
			$interested_product_id=$row_compatible['interested_product_id'];
			$row_compro=$pro->showProduct($interested_product_id);
			$alt_image_id=$row_compatible['alt_image_id'];
			$handle_image_id=$row_compatible['handle_image_id'];
			if($alt_image_id)
			{
				$row_altimg=$pro->availableImage($alt_image_id);
				$compro_image=SITE_URL.ALTERNATIVE_IMG_SM.$row_altimg['alt_image_sm'];
				$image_desc=stripslashes($row_compro['product_name'])."<br />".stripslashes($row_altimg['alt_img_name']);
			}
			else
			{
				$compro_image=SITE_URL.PRO_IMG_TH.$row_compro['product_image_sm'];	
				$image_desc=stripslashes($row_compro['product_name'])."<br />";
			
			}
			?>
        	<li id="recordsArray_<?php echo $row_compatible['product_compatible_id']; ?>" style="margin:0;">
                <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin:10px 5px 0 5px;">
                    <img src="<?php echo $compro_image; ?>" width="205" border="0" />
                </div>
                <div style="border:#DDD 1px solid;border-top:none;background:#EEE;padding:10px;margin:0 5px;">
                   	<p  style="font: 16px/20px Arial, Helvetica, sans-serif; height:40px; width:200px;"> <?php echo $image_desc; ?></p>
                </div>
                     <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin:0 5px;">
                    <a href="JavaScript:void(0);" rel="<?php echo $row_compatible['product_compatible_id']; ?>" class="delete_item"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                </div>
            </li>
        	<?php
		}
	}
    ?>
  
</ul>
<div class="clearboth"></div>
<script>
$(function(){
	$("#mysorter_cp").sortable({ opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
		$.post("ajax/sort_product_compatibles.php", order, function(theResponse){
			//$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
		}); 															 
	}								  
	});
		$('.delete_item').click(function(){
		if(confirm('Are you sure that you wish to remove this from compatible items?')){
			var t=$(this);
			$.ajax({
				url: 'ajax/compatible_product_remove.php',
				type: 'post',
				data: { id: t.attr('rel') },
				success: function(){
					t.parent().parent().hide();	
				}
			});
		}
	});
});
</script>
