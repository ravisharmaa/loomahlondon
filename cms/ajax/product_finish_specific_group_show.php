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
	$finishes->saveSelectedFinishesForProduct();
	exit;
}
$product_id=$_REQUEST['id'];
?>
<h2>Select the available finishes for this item</h2>
<div class="clearboth"></div>
<div class="container" style="margin-top:10px;padding:0 10px 10px;">
	<form id="furniture_specific_group_add">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
    <div class="info">
    	Select the finishes that you wish to include for this item. 
        <br /><br />Click the 'Save' button at the foot when you are happy with your selection.

    </div>
    <div>
    	<style>
		.tab_1{
			margin: 10px 0 0 0;
		}
		.toggle1{
			display: block;
			background: url(images/tgdown.png) no-repeat right #747d7d ;
			padding: 10px 20px;
			font: bold 16px/18px Arial, Helvetica, sans-serif;
			
			color: #FFF;
			text-decoration: none;
	
  
		}
		.toggle1:hover{
			background: url(images/tgup.png) no-repeat right #E30B5D !important;
			
		}
		p{
		18px/20px Arial,Helvetica,sans-serif
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
    	<h3>Categories within finishes</h3>
		<?php
        $row_cats=$finishes->showFinishCategories();
		if(count($row_cats))
		{
			foreach($row_cats as $row_cat)
			{
				$row_products=$finishes->showProducts($row_cat['finishes_cat_id']);
				if(count($row_products))
				{
					?>
					<div class="tab_1"><a href="JavaScript:void(0);" rel="cat_<?php echo $row_cat['finishes_cat_id']; ?>" class="toggle1"><?php echo stripslashes($row_cat['finishes_cat_name']); ?></a></div>
					<div id="cat_<?php echo $row_cat['finishes_cat_id']; ?>" class="tabblock1" style="display:none;">
						<ul id="mysorter">
							<?php
                            foreach($row_products as $row_product)
                            {
                                if($finishes->isFinishProductInCatSelected($product_id,$row_cat['finishes_cat_id'],$row_product['product_id'])!="checked")
								{
									?>
									<li style="margin:0;">
										<div class='mybb' style="width:185px;">
											<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
												<img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="150" border="0" />
												<p style="text-align:center;line-height:20px; height:40px;color:#333; padding:5px 0;"><?php echo stripslashes($row_product['product_name']); ?></p>
											</div>
											<div class="finishes-btns" style="height:15px; width:153px;">
												<input type="checkbox" name="finish_product_id_by_cat[<?php echo $row_cat['finishes_cat_id']; ?>][<?php echo $row_product['product_id']; ?>]" />
											</div>
										</div>
									</li>
									<?php
								}
                            }
                            ?>
                        </ul>
                        <div class="clearboth"></div>
					</div>
					<?php
				}
			}
		}
		?>
        <br />
		<h3>Furniture specific groups</h3>
		<?php
        $row_groups=$finishes->showFinishSpecificGroups();
		if(count($row_groups))
		{
			foreach($row_groups as $row_group)
			{
				$row_products=$finishes->showProductsByGroup($row_group['finish_specific_group_id']);
				if(count($row_products))
				{
					?>
					<div class="tab_1"><a href="JavaScript:void(0);" rel="grp_<?php echo $row_group['finish_specific_group_id']; ?>" class="toggle1"><?php echo stripslashes($row_group['finish_specific_group_name']); ?></a></div>
					<div id="grp_<?php echo $row_group['finish_specific_group_id']; ?>" class="tabblock1" style="display:none;">
						<ul id="mysorter">
							<?php
                            foreach($row_products as $row_product)
                            {
                                if($finishes->isFinishProductInGroupSelected($product_id,$row_group['finish_specific_group_id'],$row_product['product_id'])!="checked")
								{
									?>
									<li style="margin:0;">
										<div class='mybb' style="width:185px;">
											<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
												<img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="150" border="0" />
												<p style="text-align:center;line-height:30px; height:30px;color:#333;"><?php echo stripslashes($row_product['product_name']); ?></p>
											</div>
											<div class="finishes-btns" style="height:15px; width:153px;">
												<input type="checkbox" name="finish_product_id[<?php echo $row_group['finish_specific_group_id']; ?>][<?php echo $row_product['product_id']; ?>]" />
											</div>
										</div>
									</li>
									<?php
								}
                            }
                            ?>
                        </ul>
                        <div class="clearboth"></div>
					</div>
					<?php
				}
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
				url: 'ajax/product_finish_specific_group_show.php',
				type: 'post',
				data: $('#furniture_specific_group_add').serialize(),
				success: function(data){
					$('.saving').hide();
					$.fancybox.close();	
				}
			})
		});
	});
	</script>
</div>