<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$slideshow_id=$_REQUEST['id'];
$cat_url=$_POST['url'];


$parts = explode('/', $cat_url);
$p_alias=$parts[0];
$cat_alias=$parts[1];
$product_alias=$parts[2];


$row_parents=$cat->showCategoryFromAlias($p_alias);
$parent_id=$row_parents['cat_id'];
$row_cats=$cat->showCategoryFromAliasAndPid($cat_alias,$parent_id);
$cat_id=$row_cats['cat_id'];
$row_products=$pro->showPublishedProducts($cat_id);

?>
	         <select name="slideshow_link"  class="selecting_val myselectbox" style="width:160px;">
            	<option value="home" <?php if($cat_url=='home') echo "selected"; ?>>Home Page</option>
                <option value="about-us" <?php if($cat_url=='about-us') echo "selected"; ?> >About</option>
                <option value="textiles" <?php if($p_alias=='textiles') echo "selected"; ?>>Textiles</option>
                <option value="wallpapers" <?php if($p_alias=='wallpapers') echo "selected"; ?>>Wallpapers</option>
                <?php
				$decorative_p_id=3;
			    $row_firstcat=$cat->showFirstCategory($decorative_p_id);
				?>
                <option value="decorative-pieces/<?php echo $row_firstcat['cat_alias']; ?>" <?php if($p_alias=='decorative-pieces') echo "selected"; ?>>Decorative Pieces</option>
                <option value="terms-and-conditions" <?php if($cat_url=='terms-and-conditions') echo "selected"; ?> >Terms and Conditions</option>
                <option value="contact-us" <?php if($cat_url=='contact-us') echo "selected"; ?> >Contact</option>
                <option value="site-map" <?php if($cat_url=='site-map') echo "selected"; ?>>Site Map</option>
          </select>
            
            
		
			 <?php    
            $row_allcats=$cat->showAllCategories($parent_id);
            if(count($row_allcats))
            {
				?>
                <select name="slideshow_link"  class="selecting_nextval myselectbox" style="width:160px;">
       		<option value="<?php echo stripslashes($p_alias); ?>">Please select</option>
                <?php
                foreach($row_allcats as $row_eachcat)
                {
                  
                    ?>
                    <option value="<?php echo stripslashes($p_alias); ?>/<?php echo stripslashes($row_eachcat['cat_alias']); ?>" <?php if($row_eachcat['cat_alias']==$cat_alias){ echo "selected";} ?>><?php echo stripslashes($row_eachcat['cat_name']); ?></option>
                    <?php
                }
				?>
                	</select>
                <?php
            }
            ?>
	
	
        
			 <?php    
             if(count($row_products))
			 {
				 ?>
               <select name="slideshow_link"  class="selecting_nextval_colourways myselectbox" style="width:160px;">
       			<option value="<?php echo stripslashes($p_alias); ?>/<?php echo stripslashes($cat_alias); ?>">Please select</option>
                 <?php
				 foreach($row_products as $row_product)
				 {
					$dfault_col=$pro->getDefaultColourwaysImage($row_product['product_id']);
                    ?>
                    <option value="<?php echo stripslashes($p_alias); ?>/<?php echo stripslashes($cat_alias); ?>/<?php echo stripslashes($row_product['product_alias']); ?>/<?php echo $dfault_col['colourways_img_alias']; ?>" <?php if($product_alias==$row_product['product_alias']) echo "selected"; ?>><?php echo stripslashes($row_product['product_name']); ?></option>
                    <?php
                }
				?>
              </select>
                <?php
            }
            ?>
			 <?php  
			  $products=$pro->showProductFromAlias($product_alias);
			  $product_id=$products['product_id'];
			  $dfault_col=$pro->getDefaultColourwaysImage($product_id);
              $colourways_image_id=$pro->getColourwaysImage($product_id);
			  if($colourways_image_id)
			  {
				  ?>
                  <select name="slideshow_link"  class="myselectbox" style="width:160px;">
       			<option value="<?php echo stripslashes($p_alias); ?>/<?php echo stripslashes($cat_alias); ?>/<?php echo stripslashes($product_alias); ?>/<?php echo $dfault_col['colourways_img_alias']; ?>">Please select</option>
                  <?php
				 foreach($colourways_image_id as $row_slide)
				  {
					?>
                    <option value="<?php echo stripslashes($p_alias); ?>/<?php echo stripslashes($cat_alias); ?>/<?php echo stripslashes($product_alias); ?>/<?php echo stripslashes($row_slide['colourways_img_alias']); ?>"><?php echo stripslashes($row_slide['colourways_img_name']); ?></option>
                    <?php
                }
				?>
                </select>
                <?php
            }
            ?>
	
		

<script>
$(function(){
	$('.selecting_val').change(function(){
	//alert('hellow');
		var url=$(this).val();
		$.ajax({
			url: 'ajax/select_link.php?id=<?php echo $slideshow_id; ?>',
			type: 'post',
			data: { url: url },
			success: function(data){
				$('#internal_link').html(data);	
			}
		});
	});	   
});
</script>

<script>
$(function(){
	$('.selecting_nextval').change(function(){
	//alert('hellow');
		var url=$(this).val();
		$.ajax({
			url: 'ajax/select_nextlink.php?id=<?php echo $slideshow_id; ?>',
			type: 'post',
			data: { url: url },
			success: function(data){
				$('#internal_link').html(data);	
			}
		});
	});	   
});
</script>
<script>
$(function(){
	$('.selecting_nextval_colourways').change(function(){
	//alert('hellow');
		var url=$(this).val();
		$.ajax({
			url: 'ajax/selecting_nextval_colourways.php?id=<?php echo $slideshow_id; ?>',
			type: 'post',
			data: { url: url },
			success: function(data){
				$('#internal_link').html(data);	
			}
		});
	});	   
});
</script>


