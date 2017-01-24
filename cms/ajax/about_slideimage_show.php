<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$content_id=6;
?>
<ul id="sorter" class="polaroid">
    <?php    
    $row_slides=$cnt->showSlideImages($content_id);
	if(count($row_slides))
	{
		$sn_slide=0;
		foreach($row_slides as $row_slide)
		{
			?>
            <li id="sortdata_<?php echo $row_slide['slideshow_id']; ?>">
                <div class="polaroidimg">
                    <a href="ajax/about_slideimage_edit.php?id=<?php echo $row_slide['slideshow_id']; ?>" class="slide_edit_link fancybox.ajax"><img src="../<?php echo SLIDE_IMG.$row_slide['slideshow_image']; ?>" width="200"  border="0" /></a>
                </div>
                <div class="polaroidlabel">
                	<div class="tr">
                    	<div class="td">
							<span class="sn_slide"><?php echo ++$sn_slide; ?></span>. <?php echo $row_slide['slideshow_title']; ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="ajax/about_slideimage_edit.php?id=<?php echo $row_slide['slideshow_id']; ?>" class="slide_edit_link fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a>
                    <a href="JavaScript:void(0);" rel="<?php echo $row_slide['slideshow_id']; ?>" class="slide_del_link"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
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
			$.post("ajax/home_slideimage_sort.php", order, function(theResponse){
				var sn_slide=0;
				$('.sn_slide').each(function(){
					$(this).html(++sn_slide);
				});
			}); 															 
		}								  
	});
	$('.slide_edit_link').fancybox({
        'beforeClose': function(){
			$.ajax({
				url: 'ajax/about_slideimage_show.php',
				type: 'get',
				data: {},
				success: function(data){
					$('#slideshow_block').html(data);
				}
			});	
        }
    });
	$('.slide_del_link').click(function(){
		if(confirm('Are you sure that you wish to delete this slide image?')){
			var t=$(this);
			$.ajax({
				url: 'ajax/home_slideimage_del.php',
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
   