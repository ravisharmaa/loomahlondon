<h2>Furniture specific groups</h2>
<h2 class="h2right"><a href="login.php?p_id=manage_finishes" class="add_btn">Back to finishes</a></h2>
<div class="clearboth"></div>
<div class="breadcrumb">You are here: <a href="login.php">Dashboard</a> &raquo; <a href="login.php?p_id=manage_finishes">Finishes</a> &raquo; Furniture specific groups</div>

<div>
	<div class="info">
        Provided below are the list of specific groups for finishes.
        <br />Click on the "Add new furniture specific group" button below to create a new group.
        <br />Click on the pencil icon to edit the name of the group.
        <br />Click on the image to manage finishes for the group from the pool.
        <br />Click on the cross icon to delete a group.
        <br />Drag and drop the image to the required position to arrange the order of appearance.
        <br />Images for groups are the images of their first finish.
    </div>
	<script>
	$(function(){
		$('.add_new_group').fancybox({
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
	});
	</script>
    <a href="ajax/finish_specific_group_add.php" class="add_btn add_new_group fancybox.ajax">Add new furniture specific group</a>
    <div class="spacer10"></div>
    <div id="finish_specific_group_block" style="border:#CCC 1px solid; padding:10px 15px 20px 15px;">
		<script>
        $(function(){
			$.ajax({
				url: 'ajax/finish_specific_group_show.php',
				type: 'post',
				data: {},
				success: function(data){
					$('#finish_specific_group_block').html(data);	
				}
			});	
		});
        </script>
	</div>
</div>