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


   					 <?php 
					  $product_id=$_REQUEST['id'];
					  $row_pro=$pro->getaProduct($product_id);
					  $row_colourways=$pro->getDefaultColourwaysImage($product_id);
					  if(!empty($row_pro['product_image_sm']))
					 {
					 ?>
					 <img src="<?php echo SITE_URL.PRO_IMG_TH.$row_pro['product_image_sm']; ?>" width="300" border="0" />
                     <?php
					 }
					else if(!empty($row_colourways['colourways_image_sm']))
					 {
					 ?>
					 <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM.$row_colourways['colourways_image_sm']; ?>" width="300" border="0" />
                     <?php
					 }
					 else
					 {
					 ?> <img src="<?php echo SITE_URL.ALTERNATIVE_IMG_SM; ?>replace-small.jpg" width="300" border="0" />
                     <?php
					 }
					 ?>
  			

    <script>
                    $(function(){
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
                          
                              
                        
                        <br />