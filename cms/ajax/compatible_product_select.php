<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['product_id']))
{
	$pro->saveSelectedFinishesForProduct();
	exit;
}
$product_id=$_REQUEST['id'];
?>
<h2>Select the compatible products for this item</h2>
<div class="clearboth"></div>
<div class="container" style="margin-top:10px;padding:0 10px 10px;">
	<div class="info">
    	Select the compatible products that you wish to include for this item. 
        <br /><br />Click the 'Save' button at the foot when you are happy with your selection.
    </div>
    <form id="select_compatible_product">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
    <div>
    	<style>
		.tab_1{
			margin: 10px 0 0 0;
		}
		.toggle1{
			display: block;
			background: url(images/tgdown.png) no-repeat right #747d7d ;
			padding: 10px 20px;
			font: bold 18px/18px Arial, Helvetica, sans-serif;
			color: #FFF;
			text-decoration: none;
		}
		.toggle1:hover{
			background: url(images/tgup.png) no-repeat right #E30B5D !important;
		}

	.saving {
    background: #fff url("images/loading.gif") no-repeat scroll 5px 6px;
    border: 1px solid #ccc;
    color: #999;
    display: none;
    font: 18px Arial,Helvetica,sans-serif;
    padding: 6px 0 6px 35px;
    width: 80px;
}
 .mybtn {
    background: #3a3a3a none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    cursor: pointer;
    font: 18px Arial,Helvetica,sans-serif;
    padding: 6px 20px;
    text-decoration: none;
}
	</style>

		<script>
		$(function(){
			$('a.toggle1').click(function(){
				var t=$(this);
				var id=$(this).prop('rel');
				if($('#'+id).css('display')=="none"){
					$('.tabblock1').each(function(){
						if($(this).css('display')=="block"){
							$(this).slideUp();
							$('.toggle1').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});	
						}
					});
					$('#'+id).slideDown();
					t.css({'background':'url(images/tgup.png) no-repeat right #E30B5D'});
				}
				else{
					$('#'+id).slideUp();
					t.css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});
				}
			});	   
		});
		</script>
        <div class="clearboth"></div>
		<?php
        $row_cats=$pro->showCategories(0);
		if(count($row_cats))
		{
			foreach($row_cats as $row_cat)
			{
				?>
                <div class="tab_1"><a href="JavaScript:void(0);" rel="cat_<?php echo $row_cat['cat_id']; ?>" class="toggle1"><?php echo stripslashes($row_cat['cat_name']); ?></a></div>
                <div id="cat_<?php echo $row_cat['cat_id']; ?>" class="tabblock1" style="display:none;">
                    <ul id="mysorter">
                        <?php
                        $row_products=$pro->showProducts($row_cat['cat_id']);
                        if(count($row_products))
                        {
                            foreach($row_products as $row_product)
                            {
                   				if($pro->isCompatible($product_id,$row_product['product_id'],0)!="checked")
								{
								?>
                                <li style="margin:0;">
                                    <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin:10px 5px 0 5px;">
                                        <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_product['product_image_sm']; ?>" width="200" border="0" />
                                    </div>
                                    <div style="border:#DDD 1px solid;border-top:none;background:#EEE;padding:10px;margin:0 5px;">
                                        <table>
                                        <tr>
                                        	<td width="20" style=" vertical-align:top; padding-top:3px;"><input type="checkbox" name="interested_product_id[<?php echo $row_product['product_id']; ?>][0]"  /></td>
                                            <td>
                                            		<p  style=" height:40px; font:16px Arial, Helvetica, sans-serif"><?php echo stripslashes($row_product['product_name']); ?></p>
                                    		
                                            </td>
                                       	</tr>
                                        </table>     
                                    </div>
                                </li>
                                <?php
								}
                                $row_images=$pro->availableImages($row_product['product_id']);
                                if(count($row_images))
                                {
                                    foreach($row_images as $row_image)
                                    {
										if($pro->isCompatible($product_id,$row_product['product_id'],$row_image['alt_image_id'])!="checked")
										{
                                        ?>
                                        <li style="margin:0;">
                                            <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin:10px 5px 0 5px;">
                                                <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_image['alt_image_sm']; ?>" width="200" border="0" />
                                            </div>
                                            <div style="border:#DDD 1px solid;border-top:none;background:#EEE;padding:10px;margin:0 5px;">
                                                <table>
                                                <tr>
                                                	<td width="20" style=" vertical-align:top; padding-top:3px;"><input type="checkbox" name="interested_product_id[<?php echo $row_product['product_id']; ?>][<?php echo $row_image['alt_image_id']; ?>]" value="<?php echo $row_image['alt_image_id']; ?>"/></td>
                                                    <td>
                                                    	<p  style="font: 16px Arial, Helvetica, sans-serif"><?php echo substr(stripslashes($row_product['product_name']),0,20); ?></p>
                                    			   </td>
                                               	</tr>
                                                <tr>
                                                 <td>&nbsp;</td>
                                                    <td>
                                                     	<p  style="font: 16px Arial, Helvetica, sans-serif"><?php echo substr(stripslashes($row_image['alt_img_name']),0,20); ?></p>
                                                  </td>
                                                </tr>
                                                </table>     
                                            </div>
                                        </li>
                                        <?php
										}
                                    }
                                }
                            }
                        }
                        ?>
                    </ul>
                    <div class="clearboth"></div>
                </div>
                <?php
			}
		}
        ?>
    </div>
    <div style="margin-top:10px;">
    	<input type="button" id="saveit" class="mybtn" value="Save" />
    	<div class="saving">Saving...</div>    
    </div>
    </form>
    <script>
	$(function(){
		$('#saveit').click(function(){
			$(this).hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/compatible_product_save.php',
				type: 'post',
				data: $('#select_compatible_product').serialize(),
				success: function(data){
					$('.saving').hide();
					$.fancybox.close();	
				}
			})
		});
	});
	</script>
</div>