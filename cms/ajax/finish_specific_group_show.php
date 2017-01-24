<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$row_finish_specific_groups=$finishes->showFinishSpecificGroups();
if(count($row_finish_specific_groups))
{
	?>
	<ul id='mysorter'>
		<?php
		$sn=0;
		foreach($row_finish_specific_groups as $row_finish_specific_group)
		{
			?>
			<li id="recordsArray_<?php echo $row_finish_specific_group['finish_specific_group_id']; ?>" style="margin:0;">
				<div class="mybb">
					<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
						<a href="ajax/finish_specific_group_edit.php?id=<?php echo $row_finish_specific_group['finish_specific_group_id']; ?>" class="edit_group fancybox.ajax"><img src="images/specific_group_image.jpg" width="200" border="0" /></a>
						<p style="text-align:center;line-height:30px;height:30px;color:#333;"><b><span class="sn"><?php echo ++$sn; ?></span>. <?php echo stripslashes($row_finish_specific_group['finish_specific_group_name']); ?></b></p>
					</div>
					<div class="mybb-btns">
						<a href="ajax/finish_specific_group_edit.php?id=<?php echo $row_finish_specific_group['finish_specific_group_id']; ?>" title="Edit" class="edit_group fancybox.ajax"><img src="images/icon_edit.png" width="26" height="26" border="0" /></a> 
						<a href="JavaScript:void(0);" title="Delete" rel="<?php echo $row_finish_specific_group['finish_specific_group_id']; ?>" class="delete_group"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
					</div>
				</div>
			</li>	
			<?php
		}
		?>
	</ul>
	<div class="clearboth"></div>
	<?php
}
else
{
	?>
	<p>Currently there is no any group available. Click on the "Add new specific group" button above to create a new group.</p>	
	<?php
}
?>
<script>
$(function(){
	$("#mysorter").sortable({
		opacity: 0.6, cursor: 'move', update: function(){
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
            $.post("ajax/finish_specific_group_sort.php", order, function(theResponse){
            	//$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
                var sn=0;
				$('.sn').each(function(){
					$(this).html(++sn);
				});
			}); 															 
    	}								  
    });
        
    $('.edit_group').fancybox({
		beforeClose: function(){
			$.ajax({
				url: 'ajax/finish_specific_group_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#finish_specific_group_block').html(data);	
				}
			});			
		}
	});
	
	$('.delete_group').click(function(){
		if(confirm('Are you sure that you wish to delete this finishes specific group?\nBy deleting this, all the group links links will be removed from finishes details.')){
			var t=$(this);
			$.ajax({
				url: 'ajax/finish_specific_group_delete.php',
				type: 'post',
				data: { id:t.attr('rel') },
				success: function(data){
					t.parent().parent().hide();	
				}
			});	
		}
	});
});
</script>