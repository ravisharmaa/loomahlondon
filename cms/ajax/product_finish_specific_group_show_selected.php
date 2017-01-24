<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$product_id=$_REQUEST['id'];
if($finishes->countFinishCats($product_id))
{
	?>
	<h3 style="font:bold 16px/30px Arial, Helvetica, sans-serif">Categories within finishes</h3>
	<?php
	$row_cats=$finishes->showFinishCategories();
	if(count($row_cats))
	{
		foreach($row_cats as $row_cat)
		{
			$row_products=$finishes->showSelectedProductsByCat($product_id,$row_cat['finishes_cat_id']);
			if($finishes->countSelectedProductsByCat($product_id,$row_cat['finishes_cat_id']))
			{
				?>
				<div style="border:#DDD 1px solid;margin-bottom:10px;padding:5px 0 10px 5px;">
					<h3 style="margin-left:5px;"><?php echo stripslashes($row_cat['finishes_cat_name']); ?></h3>
					<ul id="mysorter" class="mysorterc_<?php echo $row_cat['finishes_cat_id']; ?>">
						<?php
						foreach($row_products as $row_product)
						{
							?>
							<li id="recordsArray<?php echo $row_cat['finishes_cat_id']; ?>_<?php echo $row_product['finish_cat_selected_product_id']; ?>" style="margin:0;">
								<div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin: 10px 5px 0 5px;">
									<img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="200" height="200" border="0" />
                                </div>
                                <div style="border-left:#DDD 1px solid;border-right:#DDD 1px solid;background:#EEE;padding:10px;margin:0 5px;line-height:20px; color:#333;width:198px;">
									<p  style="font: 16px/20px Arial, Helvetica, sans-serif"><?php echo stripslashes($row_product['product_name']); ?></p>
                                </div>
                                <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin: 0 5px;">
									<a href="JavaScript:void(0);" rel="<?php echo $row_product['finish_cat_selected_product_id']; ?>" class="remove_citem"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
					<div class="clearboth"></div>
					<script>
					 $(function(){
						$('.remove_citem').click(function(){
							var t=$(this);
							if(confirm('Are you sure that you wish to remove this item?')){
								$.ajax({
									url: 'ajax/product_finish_cat_item_remove.php',
									type: 'post',
									data: { id: t.attr('rel') },
									success: function(){
										t.parent().parent().hide();
									}
								}); 
							}
						});
						$(".mysorterc_<?php echo $row_cat['finishes_cat_id']; ?>").sortable({
							opacity: 0.6,
							cursor: 'move',
							update: function(){
								var order = $(this).sortable("serialize")+'&action=updateRecordsListings&id=<?php echo $row_cat['finishes_cat_id']; ?>'; 
								$.post("ajax/product_finish_cat_sort_selected.php", order, function(theResponse){
									//$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
								});
							}								  
						});
					});
					</script>
				</div>    
				<?php
			}
		}
	}
}
if($finishes->countFinishSpecificGroups($product_id))
{
	?>
    <h3 style="font:bold 16px/30px Arial, Helvetica, sans-serif">Finishes specific groups</h3>
    <?php
    $row_groups=$finishes->showFinishSpecificGroups();
    if(count($row_groups))
    {
        foreach($row_groups as $row_group)
        {
            $row_products=$finishes->showSelectedProductsByGroup($product_id,$row_group['finish_specific_group_id']);
            if($finishes->countSelectedProductsByGroup($product_id,$row_group['finish_specific_group_id']))
            {
                ?>
                <div style="border:#DDD 1px solid;margin-bottom:10px;padding:5px 0 10px 5px;">
                    <h4 style="margin-left:5px;"><?php echo stripslashes($row_group['finish_specific_group_name']); ?></h4>
                    <ul id="mysorter" class="mysorter_<?php echo $row_group['finish_specific_group_id']; ?>">
                        <?php
                        foreach($row_products as $row_product)
                        {
                            ?>
                            <li id="recordsArray<?php echo $row_group['finish_specific_group_id']; ?>_<?php echo $row_product['finish_specific_group_selected_product_id']; ?>" style="margin:0;">
                                <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin: 10px 5px 0 5px;">
                                    <img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="200" border="0" />
                                </div>
                                <div style="border-left:#DDD 1px solid;border-right:#DDD 1px solid;background:#EEE;padding:10px;margin:0 5px;line-height:20px; color:#333;width:198px;">
                                <p  style="font: 16px/20px Arial, Helvetica, sans-serif"><?php echo stripslashes($row_product['product_name']); ?></p>
                                </div>
                                <div style="border:#DDD 1px solid;background:#EEE;padding:10px;margin: 0 5px;">
									<a href="JavaScript:void(0);" rel="<?php echo $row_product['finish_specific_group_selected_product_id']; ?>" class="remove_gitem"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
								</div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div class="clearboth"></div>
                    <script>
                     $(function(){
                        
						$('.remove_gitem').click(function(){
							var t=$(this);
							if(confirm('Are you sure that you wish to remove this item?')){
								$.ajax({
									url: 'ajax/product_finish_group_item_remove.php',
									type: 'post',
									data: { id: t.attr('rel') },
									success: function(){
										t.parent().parent().hide();
									}
								}); 
							}
						});
						
						
						$(".mysorter_<?php echo $row_group['finish_specific_group_id']; ?>").sortable({
                            opacity: 0.6,
                            cursor: 'move',
                            update: function(){
                                var order = $(this).sortable("serialize")+'&action=updateRecordsListings&id=<?php echo $row_group['finish_specific_group_id']; ?>'; 
                                $.post("ajax/product_finish_specific_group_sort_selected.php", order, function(theResponse){
                                    //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                                });
                            }								  
                        });
                    });
                    </script>
                </div>    
                <?php
            }
        }
    }
}
?>