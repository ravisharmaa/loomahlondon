<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
$casestudy_id=$_REQUEST['id'];
$row_parts=$csd->showCaseStudyParts($casestudy_id);
if(count($row_parts))
{
	?>
    <div id="sorter">
		<?php
        foreach($row_parts as $row_part)
        {
            ?>
            <div id="sortdata_<?php echo $row_part['casestudy_part_id']; ?>" class="content_paras">
                <div class="btn_options">
                    <div style="float:left;width:580px;">
                        <h4>Block Type: <?php echo $row_part['casestudy_part_type']; ?></h4>
                    </div>
                    <div style="float:right;width:80px;text-align:right;">
                        <a href="ajax/casestudy_part_edit.php?id=<?php echo $row_part['casestudy_part_id']; ?>" class="edit_part fancybox.ajax"><img src="images/icon_edit.png" width="26" height="26" border="0" /></a>
                        <a href="JavaScript:void(0);" rel="<?php echo $row_part['casestudy_part_id']; ?>" class="del_part"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
                    </div>
                    <div class="clearboth"></div>
                </div>
                <?php
                if($row_part['casestudy_part_type']=="Title")
                {
                    ?>
                    <h3 style="text-align:<?php echo stripslashes($row_part['casestudy_part_data3']); ?>"><?php echo stripslashes($row_part['casestudy_part_data1']); ?></h3>
                    <?php
                }
                else if($row_part['casestudy_part_type']=="Text")
                {
                    echo stripslashes($row_part['casestudy_part_data1']);
                }
                else if($row_part['casestudy_part_type']=="Image")
                {
                	?>
                    <div style="text-align:<?php echo stripslashes($row_part['casestudy_part_data3']); ?>">
                    	<a href="../<?php echo CASESTUDY_IMG.$row_part['casestudy_part_data2']; ?>" class="fancybox"><img src="../<?php echo CASESTUDY_IMG.$row_part['casestudy_part_data2']; ?>" border="0" style="max-width:100%" /></a></div>
                    </div>
					<?php
                }
				else if($row_part['casestudy_part_type']=="TextImage")
                {
					if($row_part['casestudy_part_data3']=="bottom")
					{
                	?>
                         <div>
                         <?php echo stripslashes($row_part['casestudy_part_data1']); ?>
                    	<a href="../<?php echo CASESTUDY_IMG.$row_part['casestudy_part_data2']; ?>" class="fancybox"><img src="../<?php echo CASESTUDY_IMG.$row_part['casestudy_part_data2']; ?>" border="0" align="<?php echo stripslashes($row_part['casestudy_part_data3']); ?>" style="max-width:920px;margin: 0 10px 10px 10px;" /></a>
                        <div class="clearboth"></div>    
                    </div>
                    <?php
					}
					else{
					?>
                    <div>
                    	<a href="../<?php echo CASESTUDY_IMG.$row_part['casestudy_part_data2']; ?>" class="fancybox"><img src="../<?php echo CASESTUDY_IMG.$row_part['casestudy_part_data2']; ?>" border="0" align="<?php echo stripslashes($row_part['casestudy_part_data3']); ?>" <?php if($row_part['casestudy_part_data3']=="top"){?> style="max-width:920px;margin:10px;"<?php } else {?>style="max-width:240px;margin:10px;" <?php } ?>  /></a>
                    	<?php echo stripslashes($row_part['casestudy_part_data1']); ?>
                        <div class="clearboth"></div>    
                    </div>
					<?php
					}
                }
				else if($row_part['casestudy_part_type']=="Gallery")
                {
                	?>
                    <div>
                    	<?php
						$casestudy_part_id=$row_part['casestudy_part_id'];
                        $row_images=$csd->showCaseStudyPartGalleryImages($casestudy_part_id);
                        ?>
						<ul class="polaroid" style="margin:0;padding:8px;">
                        <?php
                        $sn_pi=0;
                        foreach($row_images as $row_image)
                        {
                            ?>
                            <li style="margin:0 7px 7px 0;">
                                <div class="polaroidimg" style="border:none;">
                                    <a href="../<?php echo CASESTUDY_IMG.$row_image['casestudy_part_image']; ?>" class="fancybox" rel="gal<?php echo $casestudy_part_id; ?>"><img src="<?php echo "../".CASESTUDY_IMG.$row_image['casestudy_part_image']; ?>" width="200" height="150" border="0" style="margin-bottom:10px;" /></a>
                                </div>
                            </li>								
                            <?php
                        }
                        ?>
                        </ul>
                        <div class="clearboth"></div>    
                    </div>
					<?php
                }
				else if($row_part['casestudy_part_type']=="Link")
                {
                    ?>
                    <div style="padding:10px 10px;">
						<?php
                        if($row_part['casestudy_part_data2']=="E")
                        {
                            ?>
                            <a href="<?php echo stripslashes($row_part['casestudy_part_data4']); ?>" target="_blank"><?php echo stripslashes($row_part['casestudy_part_data1']); ?></a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="<?php echo SITE_URL.stripslashes($row_part['casestudy_part_data3']); ?>" target="_blank"><?php echo stripslashes($row_part['casestudy_part_data1']); ?></a>
                            <?php
                        }
						?>
                	</div>
                    <?php        
                }
				else if($row_part['casestudy_part_type']=="File")
                {
                    ?>
                    <div style="padding:10px 10px;">
						<a href="<?php echo "../".CASESTUDY_FILE.$row_part['casestudy_part_data2']; ?>" target="_blank"><?php echo stripslashes($row_part['casestudy_part_data1']); ?></a>
                    </div>
                    <?php        
                }
                else if($row_part['casestudy_part_type']=="Video")
                {
                    ?>
                    <h3><?php echo $row_part['casestudy_part_data1']; ?></h3>
                    <div style="padding:10px 10px;">
						<a href='http://www.youtube.com/embed/<?php echo $row_part['casestudy_part_data5']; ?>?autoplay=1&rel=0' class="youtube_video fancybox.iframe">
						<img src="http://img.youtube.com/vi/<?php echo stripslashes($row_part['casestudy_part_data5']); ?>/0.jpg" style="width:200px;padding:5px;border:#CCC 1px solid;" />
                       	</a>
                    </div>
                    <?php        
                }
				else if($row_part['casestudy_part_type']=="FAQ")
                {
                    ?>
                    <h3><?php echo stripslashes($row_part['casestudy_part_data1']); ?></h3>
                    <p style="margin-top:0;"><?php echo stripslashes($row_part['casestudy_part_data2']); ?></p>
                    <?php        
                }
                ?>
            </div>
            <?php
        }
		?>
	</div> 	       
	<?php
}
else
{
	?>
    
    <?php	
}
?>
<script>
$(function(){
	$('.fancybox').fancybox();
	$("#sorter").sortable({ 
		opacity: 0.6, cursor: 'move', update: function(){
			var order=$(this).sortable('serialize'); 
			$.post("ajax/casestudy_part_sort.php", order, function(theResponse){
				
			}); 															 
		}								  
	});
	$('.edit_part').fancybox({
		'beforeClose': function(){
			$.ajax({
				type: 'post',
				url: 'ajax/casestudy_part_show.php',
				data: { id: '<?php echo $casestudy_id; ?>' },
				success: function(data){
					$('#casestudy_paragraph_block').html(data);
					//$('.saving').hide();
				}   
			});	
		}						
	});		   
	$('.del_part').click(function(){
		if(confirm("Are you sure that you wish to delete this?")){
			var t=$(this);
			$.ajax({
				type: "POST",
				url: 'ajax/casestudy_part_delete.php',
				data: { id: t.attr('rel') },
				success: function(data){
					t.parent().parent().parent().hide();
				}   
			});	
		}
	});
});	
</script>