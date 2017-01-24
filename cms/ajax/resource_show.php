<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$resources_cat_id=$_REQUEST['id'];
$cat_sn=0;

?>
<ul id="sorter" class="polaroid">
    <?php   
	$x=0; 
    $row_resources=$blg->showResources($resources_cat_id);
	if(count($row_resources))
	{
		foreach($row_resources as $row_resource)
		{
		
			?>
            <li id="sortdata_<?php echo $row_resource['resources_cat_id']; ?>">
                <div class="polaroidimg">
                    <a href="ajax/resource_edit.php?id=<?php echo $row_resource['resources_id'] ?>" class="resource_add_link fancybox.ajax">
                    <?php
                     if(!empty($row_resource['resource_img']))
					 {
					 ?>
					 <img src="../<?php echo RESOURCE_IMG.$row_resource['resource_img']; ?>" width="200"  border="0" />
                     <?php
					 }
					 else
					 {
					 ?> <img src="../<?php echo ALTERNATIVE_IMG_SM; ?>replace-small.jpg" width="200"  border="0" />
                     <?php
					 }
					 ?>
                    </a>
                </div>
                <div class="polaroidlabel">
                    <div class="tr">
                    	<div class="td">
                        	<span class="cat_sn"><?php echo ++$cat_sn; ?></span>. <?php echo stripslashes($row_resource['resources_name']); ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="ajax/resource_edit.php?id=<?php echo $row_resource['resources_id'];?>" class="resource_add_link fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" class="resource_del_link" rel="<?php echo $row_resource['resources_id']; ?>"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                    
                    <div style="float:right;width:66px;padding-top:5px;">
                    	<label><input type="checkbox" id="checkbox-<?php echo $row_resource['resources_id']; ?>" class="publish_resource" <?php if($row_resource['resources_status']) echo "checked"; ?> /> Publish</label>
					</div>
                    <div id="img-<?php echo $row_resource['resources_id']; ?>" style="float:right;width:30px;display:none;">
                    	<img src="images/loading.gif" width="20" height="20" border="0" />
                </div>
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
			$.post("ajax/resource_sort.php", order, function(theResponse){
				var cat_sn=0;
				$('.cat_sn').each(function(){
					$(this).html(++cat_sn);
				});
			}); 															 
		}								  
	});
	$('.resource_del_link').click(function(){
		if(confirm("Are you sure that you wish to delete this resource?")){
			var t=$(this);
			$.ajax({
				url: 'ajax/resource_delete.php',
				type: 'post',
				data: { id: t.attr('rel') },
				success: function(data){
					t.parent().parent().hide();
				}
			});	
		}
	});
	
    $('.publish_resource').click(function(){
	var tt=$(this);
	var id=tt.attr('id').split('-')[1];
	$('#img-'+id).show();
	var status=0;
	if($(this).is(':checked'))
		status=1;	
	$.ajax({
		url: 'ajax/resource_status.php',
		type: 'post',
		data: { id: id, status: status },
		success: function(){
			$('#img-'+id).hide();	
		}
	});
});
});
</script>
   