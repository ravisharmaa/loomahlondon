<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
 error_reporting(0);
 $myroot="../";
include_once($myroot."config/config.php");
?>
<ul id="mysorter_alt" class="polaroid colourways_image" >
    <?php 
	  $sn_slide=0;
	  $product_id=$_REQUEST['id'];
	  $colourways_image_id=$pro->getColourwaysImage($product_id);
	  if($colourways_image_id)
	  {
		 foreach($colourways_image_id as $row_slide)
		  {
			?>
            <li id="recordsArray_<?php echo $row_slide['colourways_image_id']; ?>" style="width:214px;">
                <div class="polaroidimg" style="text-align: center; height:160px;">
                    <a href="ajax/colourways_edit.php?id=<?php echo $row_slide['colourways_image_id']; ?>" class="scroll_edit_link fancybox.ajax" style="display: block; position: relative; top: 50%; transform: translateY(-50%);">
                    <img  src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_slide['colourways_image_sm']; ?>" width="194px" height="160px" border="0" style="margin:5px 0; vertical-align:bottom;" /></a>
                </div>
                <div class="polaroidlabel" style="margin-bottom:0 auto;">
                	<div class="tr">
                    	<div class="td">
							<span class="sn_slide"><?php echo ++$sn_slide; ?></span>. <?php echo $row_slide['colourways_img_name']; ?>
                		</div>
                	</div>        
                </div>
                <div class="polaroidoption">
                    <a href="ajax/colourways_edit.php?id=<?php echo $row_slide['colourways_image_id']; ?>" class="scroll_edit_link fancybox.ajax"><img src="images/icon_edit.png" width="24" height="24" border="0" /></a><?php /*?>
                    <a href="JavaScript:void(0);" rel="<?php echo $row_slide['colourways_image_id']; ?>" class="scroll_del_link"><?php */?>
                    <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_colourways_img&alt_id=<?php echo $row_slide['colourways_image_id']; ?>&id=<?php echo $_REQUEST['id']; ?>','Are you sure that you want to delete this colourway ?');" title="Delete"><img src="images/icon_delete.png" width="24" height="24" border="0" /></a>
                     <div style="float:right;width:66px;padding-top:5px;">
                    		<label><input style="margin-right:5px;" type="checkbox" id="checkbox-<?php echo $row_slide['colourways_image_id']; ?>" class="publish_product" <?php if($row_slide['default_colourways']) echo "checked"; ?> />Default</label>
							</div>
                            <div id="img-<?php echo $row_slide['colourways_image_id']; ?>" style="float:right;width:30px;display:none;">
                                <img src="images/loading.gif" width="20" height="20" border="0" />
                            <div class="clear"></div>
                            </div>
                </div>
            </li>
			<?php
		}
	}
	else
	{
		?><div class="polaroidimg">
       <h3> No colourways images are available.</h3>
        </div>
        
        <?php
	}
	?>
</ul>
<div class="clearboth"></div>
<script>
          $(function(){
              $("#mysorter_alt").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                  var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
                  $.post("ajax/colourways_img_sort.php", order, function(theResponse){
                      //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
					  var sn_slide=0;
					  $('.sn_slide').each(function(){
					  $(this).html(++sn_slide);
					  });
                  }); 															 
              }								  
              });
			$('.publish_product').click(function(){
			//alert($(this).val() + ' ' + (this.checked ? 'checked' : 'unchecked'));
		
					var tt=$(this);
					var id=tt.attr('id').split('-')[1];
					$('#img-'+id).show();
					var status=0;
					if($(this).is(':checked'))
						status=1;	
						if(!$(this).is(':checked'))
						{
						alert("Please select atleast one default colourways");
						status=1;                        	
					   }
					$.ajax({
						url: 'ajax/colourways_status.php?product_id=<?php echo $product_id; ?>',
						type: 'post',
						data: { id: id, status: status },
						success: function(){
							$('#img-'+id).hide();	
						}
					});
					  $.ajax({
                              url: 'show_additional_images.php',
                              type: 'post',
                              data: { id: '<?php echo $_REQUEST['id']; ?>' },
                                  success: function(data){
                                      $('.colourways_image').html(data);
									  
                                   }
                               });
					  $.ajax({
                              url: 'show_main_image.php',
                              type: 'post',
                              data: { id: '<?php echo $_REQUEST['id']; ?>' },
                                  success: function(data){
                                      $('.main_img').html(data);
									  
                                   }
                               });
				});
          });
          </script>
<script>
$(function(){
	
	$('.scroll_edit_link').fancybox({
        'beforeClose': function(){
			$.ajax({
				url: 'ajax/colourways_show.php?id=<?php echo $product_id;?>',
				type: 'get',
				data: {},
				success: function(data){
					$('#scroll_block').html(data);
				}
			});	
        }
    });
	$('.scroll_del_link').click(function(){
		if(confirm('Are you sure that you wish to delete this image?')){
			var t=$(this);
			$.ajax({
				url: 'ajax/home_scrolling_link_del.php',
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
   