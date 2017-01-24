<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$cat_id=$_POST['id'];
$row_cat=$cat->showCategory($cat_id);
$parent_id=$row_cat['parent_id'];

$row_pros=$pro->showProducts($cat_id);
if(count($row_pros))
{
	?>
	<ul id="sorter" class="polaroid">
		<?php
		$pro_sn=0;
		$i=0;
		foreach($row_pros as $row_pro)
		{
		$product_id=$row_pro['product_id'];
		$row_colourways=$pro->getDefaultColourwaysImage($product_id);
			?>
			<li id="sortdata_<?php echo $row_pro['product_id']; ?>">
				<div class="polaroidimg">
					<a href="login.php?p_id=manage_product&id=<?php echo $row_pro['product_id']; ?>">
                     <?php 
					  if(!empty($row_pro['product_image_sm']))
					 {
					 ?>
					 <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_pro['product_image_sm']; ?>" width="200" border="0" />
                     <?php
					 }
					 
					 else if(!empty($row_colourways['colourways_image_sm']))
					 {
					 ?>
					 <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_colourways['colourways_image_sm']; ?>" width="200"  border="0" />
                     <?php
					 }
					 else
					 {
					 ?> <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM; ?>replace-small.jpg" width="200" border="0" />
                     <?php
					 }
					 ?>
                     </a>
				</div>
				<div class="polaroidlabel">
					<div class="tr">
                    	<div class="td">
                        	<span class="pro_sn"><?php echo ++$pro_sn; ?></span>. <?php echo stripslashes($row_pro['product_name']); ?>
						</div>
                	</div>        
                </div>
				<div class="polaroidoption">
					<a href="login.php?p_id=manage_product&id=<?php echo $row_pro['product_id']; ?>"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
					<a href="JavaScript:void(0);" class="pro_del_link" rel="<?php echo $row_pro['product_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
				
                 <div style="float:right;width:66px;padding-top:5px;">
                    	<label><input type="checkbox" id="checkbox-<?php echo $row_pro['product_id']; ?>" class="publish_product" <?php if($row_pro['product_status']) echo "checked"; ?> /> Publish</label>
					</div>
                    <?php
					if($parent_id==3){
					?>
                    <div style="float:right;width:66px;padding-top:5px;">
                    	<label><input type="checkbox" id="checkbox-<?php echo $row_pro['product_id']; ?>" class="mark_as_sold" <?php if($row_pro['mark_as_sold']) echo "checked"; ?> /> Sold</label>
					</div>
                    <?php
					}
					?>
         <div id="img-<?php echo $row_pro['product_id']; ?>" style="float:right;width:30px;display:none;">
                    	<img src="images/loading.gif" width="20" height="20" border="0" />
                    
                    <div class="clear"></div>
                    </div>
                    </div>
			</li>
			<?php
			$i++;
			if($i%4==0){
			?>
            <div class="clearboth"></div>
            <?php
			
			}
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<script>
    $(function(){
        $("#sorter").sortable({ 
            opacity: 0.6, cursor: 'move', update: function(){
                var order=$(this).sortable('serialize'); 
                $.post("ajax/product_sort.php", order, function(theResponse){
                    var pro_sn=0;
					$('.pro_sn').each(function(){
						$(this).html(++pro_sn);
					});
                }); 															 
            }								  
        });
        $('.pro_del_link').click(function(){
            if(confirm("Are you sure that you wish to delete this product?")){
                var t=$(this);
                $.ajax({
                    url: 'ajax/product_delete.php',
                    type: 'post',
                    data: { id: t.attr('rel') },
                    success: function(data){
                        t.parent().parent().hide();
                    }
                });	
            }
        });
		
		$('.publish_product').click(function(){
			var tt=$(this);
			var id=tt.attr('id').split('-')[1];
			//$('#img-'+id).show();
			var status=0;
			if($(this).is(':checked'))
				status=1;	
			$.ajax({
				url: 'ajax/product_status.php',
				type: 'post',
				data: { id: id, status: status },
				success: function(){
					$('#img-'+id).hide();
					alertify.success('Successfully Saved.');	
				}
			});
		});
		$('.mark_as_sold').click(function(){
			var tt=$(this);
			var id=tt.attr('id').split('-')[1];
			//$('#img-'+id).show();
			var status=0;
			if($(this).is(':checked'))
				status=1;	
			$.ajax({
				url: 'ajax/mark_as_sold.php',
				type: 'post',
				data: { id: id, status: status },
				success: function(){
					$('#img-'+id).hide();
					alertify.success('Successfully Saved.');	
				}
			});
		});
    });
	
    </script>
    <?php
}
else
{
	?>
    <div class="unavailable">No products are available. If you wish to add a product, click the "Add a product" button above.</div>
    <?php
}
?>