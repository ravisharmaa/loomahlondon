<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$parent_id=0;
$cat_sn=0;
$row_cats=$cat->showFeaturedCategories($parent_id);
if(count($row_cats))
{
	?>
	<ul id="featured_sorter" class="polaroid">
    	<?php    
    	foreach($row_cats as $row_cat)
		{
			?>
            <li id="featured_sortdata_<?php echo $row_cat['cat_id']; ?>">
                <div class="polaroidimg">
                    <a href="login.php?p_id=manage_products&id=<?php echo $row_cat['cat_id']; ?>"><img src="../<?php echo CAT_IMG.$row_cat['cat_image']; ?>" width="200" height="150" border="0" /></a>
                </div>
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="feaured_cat_sn"><?php echo ++$cat_sn; ?></span>. <?php echo $row_cat['cat_name']; ?>
                		</div>
                    </div>
                </div>
                <div class="polaroidoption">
                    <a href="JavaScript:void(0);" class="featured_cat_del" rel="<?php echo $row_cat['cat_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                </div>
            </li>
			<?php
		}
	?>
	</ul>
    <div class="clearboth"></div>
    <script>
	$(function(){
		$("#featured_sorter").sortable({ 
			opacity: 0.6, cursor: 'move', update: function(){
				var order=$(this).sortable('serialize'); 
				$.post("ajax/featured_cat_sort.php", order, function(theResponse){
					var feaured_cat_sn=0;
					$('.feaured_cat_sn').each(function(){
						$(this).html(++feaured_cat_sn);
					});
				}); 															 
			}								  
		});
		$('.featured_cat_del').click(function(){
			if(confirm("Are you sure that you wish to remove this category from featured frames?")){
				var t=$(this);
				$.ajax({
					url: 'ajax/featured_cat_delete.php',
					type: 'post',
					data: { id: t.attr('rel') },
					success: function(data){
						t.parent().parent().hide();
					}
				});	
			}
		});
	});
	</script>
	<?php
}
else
{
	?>
    <div class="unavailable">No categories are available as featured frames. If you wish to add, click the "Select a category" button above.</div>
    <?php	
}
?>