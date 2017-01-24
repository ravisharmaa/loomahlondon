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

?>
<ul id="sorter" class="polaroid">
    <?php    
    $row_cats=$cat->showAllCategories($parent_id);
	if(count($row_cats))
	{
		foreach($row_cats as $row_cat)
		{
			?>
            <li id="sortdata_<?php echo $row_cat['cat_id']; ?>">
                <div class="polaroidimg">
                    <a href="login.php?p_id=manage_products&id=<?php echo $row_cat['cat_id']; ?>"><img src="../<?php echo CAT_IMG.$row_cat['cat_image']; ?>" width="200" height="150" border="0" /></a>
                </div>
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="cat_sn"><?php echo ++$cat_sn; ?></span>. <?php echo stripslashes($row_cat['cat_name']); ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="login.php?p_id=manage_products&id=<?php echo $row_cat['cat_id']; ?>"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="cat_del_link" rel="<?php echo $row_cat['cat_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                    
                    <div style="float:right;width:66px;padding-top:5px;">
                    	<label><input type="checkbox" id="checkbox-<?php echo $row_cat['cat_id']; ?>" class="publish_product" <?php if($row_cat['cat_status']) echo "checked"; ?> /> Publish</label>
					</div>
                    <div id="img-<?php echo $row_cat['cat_id']; ?>" style="float:right;width:30px;display:none;">
                    	<img src="images/loading.gif" width="20" height="20" border="0" />
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
	$("#sorter").sortable({ 
		opacity: 0.6, cursor: 'move', update: function(){
			var order=$(this).sortable('serialize'); 
			$.post("ajax/cat_sort.php", order, function(theResponse){
				var cat_sn=0;
				$('.cat_sn').each(function(){
					$(this).html(++cat_sn);
				});
			}); 															 
		}								  
	});
	$('.cat_del_link').click(function(){
		if(confirm("Are you sure that you wish to delete this category?")){
			var t=$(this);
			$.ajax({
				url: 'ajax/cat_delete.php',
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
			$('#img-'+id).show();
			var status=0;
			if($(this).is(':checked'))
				status=1;	
			$.ajax({
				url: 'ajax/designer_status.php',
				type: 'post',
				data: { id: id, status: status },
				success: function(){
					$('#img-'+id).hide();	
				}
			});
		});
});
</script>
   