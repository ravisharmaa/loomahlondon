<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");

?>    
        <table>
             <tr>
              <td class="formright colourways_image" colspan="2">
              <table class="">
              <tr>
              <td>
                 <?php
              $product_id=$_REQUEST['id'];
              $colourways_image_id=$pro->getColourwaysImage($product_id);
              if($colourways_image_id)
              {
                  ?>
                   <ul id='mysorter_alt'>
                     <?php
                  foreach($colourways_image_id as $colourways_images)
                  {
                      
                  ?>
              
                 <li id="recordsArray_<?php echo $colourways_images['colourways_image_id']; ?>" style="margin:0;">
                  <div class='mybb' style="position:relative;">
                    <div style="border:#DDD 1px solid; padding:10px 10px 5px 10px;margin: 5px 5px 0 5px;">
                       <a href="available_images.php?id=<?php echo $colourways_images['colourways_image_id']; ?>" class="available_images fancybox.iframe" ><img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$colourways_images['colourways_image_sm']; ?>" width="202" height="160px;"  border="0" /></a>  
                       <p style="text-align:center;line-height:20px;color:#333; padding:5px 0;">&nbsp;<?php echo stripslashes($colourways_images['colourways_img_name']); ?></p>
                       <div class="mybb" style="width:100%;">
                       
                         <a href="available_images.php?id=<?php echo $colourways_images['colourways_image_id']; ?>" class="available_images fancybox.iframe"><img src="images/icon_edit.png" width="26" height="26" border="0" /></a>
                        <a href="JavaScript:delRecord('login.php?p_id=manage_product&act=del_alt_img&alt_id=<?php echo $colourways_images['colourways_image_id']; ?>&id=<?php echo $_REQUEST['id']; ?>','Are you sure that you want to delete this products ?');" title="Delete"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
                           
                             <div style="float:right;width:66px;padding-top:5px;">
                    		<label><input style="margin-right:5px;" type="checkbox" id="checkbox-<?php echo $colourways_images['colourways_image_id']; ?>" class="publish_product" <?php if($colourways_images['default_colourways']) echo "checked"; ?> />Default</label>
							</div>
                            <div id="img-<?php echo $colourways_images['colourways_image_id']; ?>" style="float:right;width:30px;display:none;">
                                <img src="images/loading.gif" width="20" height="20" border="0" />
                            <div class="clear"></div>
                            </div>
                     </div>
                    </div>
                  </div>
                  </li>
                  
                  <?php
                      
                  }
                  ?>
                  </ul>
            
                  <?php
              }
              else
              {
                  ?>
                 <p> No colourways images have been added.</p>
                  <?php
              }
              
              ?>     
           </td>
              </tr>
              </table>
              
              <br />
              
           </td>
          </tr>
          
            </table>
            
<script>

$(function(){

		  $("#mysorter_alt").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			  var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			  $.post("ajax/colourways_img_sort.php", order, function(theResponse){
				  //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
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
