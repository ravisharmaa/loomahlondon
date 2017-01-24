<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$content_part_id=$_POST['id'];
$row_images=$cnt1->showContentPartGalleryImages($content_part_id);
if(count($row_images)>1)
{
	?>
	<div class="info" style="margin-top:0;">If you wish to change the order in which images are displayed, you can drag and drop an image to an alternative position.</div>
	<?php	
}
?>
<ul id='gallery_sorter' class="polaroid">
<?php
$sn_pi=0;
foreach($row_images as $row_image)
{
	?>
	<li id="gsortdata_<?php echo $row_image['content_part_image_id']; ?>" style="margin:0 7px 7px 0;">
        <div class="polaroidimg">
            <img src="<?php echo "../".CONTENT_IMG.$row_image['content_part_image']; ?>" width="200" height="150" border="0" style="margin-bottom:10px;" />
        </div>
		<div class="polaroidoption">
			<a href="JavaScript:void(0);" title="Delete" rel="<?php echo $row_image['content_part_image_id']; ?>" class="del_img"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
		</div>
	</li>								
	<?php
}
?>
</ul>
<script>
$(function(){
	$("#gallery_sorter").sortable({ opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
		$.post("ajax/content_part_galleryimage_sort.php", order, function(theResponse){
			//$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
		}); 															 
	}								  
	});
	$('.del_img').click(function(){
		if(confirm("Are you sure that you want to delete this image?")){
			var t=$(this);
			var id=t.attr('rel')
			$.ajax({
				type: "POST",
				url: 'ajax/content_part_galleryimage_delete.php',
				data: { id: id },
				success: function(data){
					t.parent().parent().hide();
				}   
			});	
		}
	});
});	
</script>