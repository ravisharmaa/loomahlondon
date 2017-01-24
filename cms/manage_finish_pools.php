<?php 
if(isset($_POST['submitted']) and $_POST['submitted']=="Save")
{
	$allcnt->updateContent();
	$show_tab=1;
}
$content_id=1;
$category=$allcnt->getContent($content_id);
?>
<h2>Pool within finishes</h2>
<h2 class="h2right"><a href="login.php?p_id=manage_finishes" class="add_btn">Back to finishes</a></h2>
<div class="clearboth"></div>
<div class="breadcrumb">You are here: <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_finishes">Finishes</a> &raquo; Pool within finishes</div>

<div>

    <div class="spacer10"></div>
    <div class="info">
        Provided below are the list of categories of finishes.
        <br />Click on the "Add new category" button above to add a new category.
        <br />Click on the pencil icon or the image to edit category.
        <br />Click on the cross icon to delete a category.
        <br />Drag and drop the block to the required position to arrange the order of appearance.
        <br />Images for categories are the images of their first product.
    </div>
	<div class="spacer10"></div>
    <a href="login.php?p_id=manage_finishes_category&act=add" class="add_btn" >Add new category</a>
    <div style="height:18px;"></div>
	<?php
   
    $row_cats=$allcnt->getCategories();
    ?>
	<div id="product_img_block" style="padding:10px 15px 20px 15px;">
		<ul id='mysorter'>
        	<?php
			$sn=0;
            foreach($row_cats as $row_cat)
            {
				$cat_id=$row_cat['finishes_cat_id'];
				$row_product=$finishespro->getFirstProduct($cat_id);
            	?>
            	<li id="recordsArray_<?php echo $row_cat['finishes_cat_id']; ?>" style="margin:0;">
                	<div class="mybb">
                    	<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
                        	<a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $row_cat['finishes_cat_id']; ?>" title="Manage Products"><img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="200"  border="0" /></a>
                          	<p style="text-align:center;line-height:30px;height:30px;color:#333;"><b><span class="sn"><?php echo ++$sn; ?></span>. <?php echo stripslashes($row_cat['finishes_cat_name']); ?></b></p>
                      	</div>
                      	<div class="mybb-btns">
                        	<a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $row_cat['finishes_cat_id']; ?>" title="Edit"><img src="images/icon_edit.png" width="26" height="26" border="0" /></a> 
                        	<a href="JavaScript:delRecord('login.php?p_id=manage_finishes_category&act=del&cat_id=<?php echo $row_cat['finishes_cat_id']; ?>','Are you sure that you want to delete this category?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
                   		</div>
                   	</div>
              	</li>	
            	<?php
            }
        	?>
		</ul>
		<div class="clearboth"></div>
	</div>
    <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
    <script>
    $(function(){
        $("#mysorter").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
            $.post("ajax/finishes_categories_sort.php", order, function(theResponse){
               
                            //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                        	var sn=0;
							$('.sn').each(function(){
								$(this).html(++sn);
							});
						
            }); 															 
        }								  
        });
    });
    </script>
</div>    

<div class="spacer20"></div>



