<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");
if(isset($_POST['furniture_specific_group_name']))
{
	$finishes->editFinishSpecificGroups();
	exit;
}
$finish_specific_group_id=$_REQUEST['id'];
$row_finish_specific_group=$finishes->showFinishSpecificGroup($finish_specific_group_id);

?>
<h2>Edit finishes specific group</h2>
<div class="clearboth"></div>
<div class="container" style="margin-top:10px;padding:0 10px 10px;">
	<div class="info">Provide a name for the finishes specific group that you wish to update.</div>
    <form id="furniture_specific_group_edit">
    <input type="hidden" name="finish_specific_group_id" value="<?php echo $finish_specific_group_id; ?>" />
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Finishes specific group</td>
        <td class="formright"><input type="text" name="furniture_specific_group_name" class="mytextbox" value="<?php echo stripslashes($row_finish_specific_group['finish_specific_group_name']); ?>" /></td>
    </tr>
    </table>
    <div class="info">Select the finishes that you wish to include within this finishes specific group.</div>
    <div>
    	<style>
		.tab_1{
			margin: 10px 0 0 0;
		}
		.toggle{
			display: block;
			background: url(images/tgdown.png) no-repeat right #747d7d ;
			padding: 10px 20px;
			font: bold 16px Arial, Helvetica, sans-serif;
			color: #FFF;
			text-decoration: none;
		}
		.toggle:hover{
			background: url(images/tgup.png) no-repeat right #E30B5D !important;
		}
		</style> 
		<script>
		$(function(){
			$('a.toggle').click(function(){
				var t=$(this);
				var id=$(this).prop('rel');
				if($('#'+id).css('display')=="none"){
					$('.tabblock').each(function(){
						if($(this).css('display')=="block"){
							$(this).slideUp();
							$('.toggle').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});	
						}
					});
					$('#'+id).slideDown();
					t.css({'background':'url(images/tgup.png) no-repeat right #E30B5D'});
				}
				else{
					$('#'+id).slideUp();
					t.css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});
				}
			});	   
		});
		</script>
    	<?php
        $row_cats=$finishes->showFinishCategories();
		if(count($row_cats))
		{
			foreach($row_cats as $row_cat)
			{
				$row_products=$finishes->showProducts($row_cat['finishes_cat_id']);
				if(count($row_products))
				{
					?>
					<div class="tab_1"><a href="JavaScript:void(0);" rel="cat_<?php echo $row_cat['finishes_cat_id']; ?>" class="toggle"><?php echo stripslashes($row_cat['finishes_cat_name']); ?></a></div>
					<div id="cat_<?php echo $row_cat['finishes_cat_id']; ?>" class="tabblock" style="display:none;">
						<ul id="mysorter">
							<?php
                            foreach($row_products as $row_product)
                            {
                                //$finishes_id=$row_product['product_id'];
                                //$finishes_count=$pro->isAvailableFinishes($pro_id,$finishes_id);
                                //$count_product=count($finishes_count); 
                                ?>
                                <li style="margin:0;">
                                    <div class='mybb' style="width:185px;">
                                        <div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
                                            <img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="150" border="0" />
                                            <p style="text-align:center;line-height:30px; height:30px;color:#333;"><?php echo stripslashes($row_product['product_name']); ?></p>
                                        </div>
                                        <div class="finishes-btns" style="height:25px; width:153px;">
                                            <input type="checkbox" name="finish_product_id[]" value="<?php echo $row_product['product_id']; ?>" <?php echo $finishes->isFinishProductInGroup($finish_specific_group_id,$row_product['product_id']); ?> />
                                        </div>
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
			}
		}
		?>
	</div>
    <div style="margin-top:10px;">
    	<input type="button" id="saveit" class="mybtn" value="Save" />
    	<div class="saving">Saving...</div>    
    </div>
    </form>
    <script>
	$(function(){
		$('#saveit').click(function(){
			$(this).hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/finish_specific_group_edit.php',
				type: 'post',
				data: $('#furniture_specific_group_edit').serialize(),
				success: function(data){
					$.fancybox.close();	
				}
			})
		});
	});
	</script>
</div>