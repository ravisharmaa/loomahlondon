<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$product_id=$_POST['id'];
$row_groups=$rfn->showRefineGroups();
if(count($row_groups))
{
	$k=0;
	foreach($row_groups as $row_group)
	{
		$k++;
		$refine_group_id=$row_group['refine_group_id'];
		$refine_tags=$rfn->showRefineTagGroupId($refine_group_id);
		$c=0;
		foreach($refine_tags as $refine_tag)
		{
			$c+=$rfn->selectRefineTagInRelationTable($product_id,$refine_tag['refine_tag_id']);
		}
		if($c>0)
		{
			?>
			<div style="float:left;width:179px;border:#CCC 1px solid; margin-top:10px;  <?php if($k!=5){?>margin-right:10px;<?php }?>" >
   		        <h3 style="padding: 10px;"><?php echo $row_group['refine_group_name']; ?></h3>
            	<?php
				foreach($refine_tags as $refine_tag)
				{
					if($rfn->selectRefineTagInRelationTable($product_id,$refine_tag['refine_tag_id']))
					{
						?>
                        <div style="border-top:#CCC 1px solid;padding:10px;"><span><?php echo $refine_tag['refine_tag_name']; ?></span><span style="float:right"><a href="JavaScript:void(0);" rel="<?php echo $refine_tag['refine_tag_id']; ?>" class="delete_refine_tag"><img src="images/icon_delete.png" width="22" height="22" border="0" /></a></span></div>
                        <?php
					}
				}
				?>
        	</div>    
        	<?php	
		}
		
	}
}
?>
<div class="clearboth"></div>
<script>
$(function(){
		$('.delete_refine_tag').click(function(){
		if(confirm('Are you sure that you wish to remove this refined tag?')){
			var t=$(this);
			$.ajax({
				url: 'ajax/refined_tags_remove.php',
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
