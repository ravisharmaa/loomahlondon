<?php
session_start();
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$myroot="../../";
include_once($myroot."config/config.php");if(isset($_POST['product_id']))

if(isset($_POST['product_id']))
{
	$rfn->saveRefinedtagforproduct();
	exit;
}
$product_id=$_REQUEST['id'];
?>
<h2>Select the refined by tags for this item</h2>
<div class="clearboth"></div>
<div class="container" style="margin-top:10px;padding:0 10px 10px;">
	<div class="info">
    	Select the refined by tags that you wish to include for this item. 
        <br /><br />Click the 'Save' button at the foot when you are happy with your selection.
    </div>
    <form id="select_refined_by_tags">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
    <div>
    	<style>
		.tab_1{
			margin: 10px 0 0 0;
		}
		.toggle1{
			display: block;
			background: url(images/tgdown.png) no-repeat right #747d7d ;
			padding: 10px 20px;
			font: bold 18px/18px Arial, Helvetica, sans-serif;
			color: #FFF;
			text-decoration: none;
		}
		.toggle1:hover{
			background: url(images/tgup.png) no-repeat right #E30B5D !important;
		}

	.saving {
    background: #fff url("images/loading.gif") no-repeat scroll 5px 6px;
    border: 1px solid #ccc;
    color: #999;
    display: none;
    font: 18px Arial,Helvetica,sans-serif;
    padding: 6px 0 6px 35px;
    width: 80px;
}
 .mybtn {
    background: #3a3a3a none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    cursor: pointer;
    font: 18px Arial,Helvetica,sans-serif;
    padding: 6px 20px;
    text-decoration: none;
}
	</style>

		<script>
		$(function(){
			$('a.toggle1').click(function(){
				var t=$(this);
				var id=$(this).prop('rel');
				if($('#'+id).css('display')=="none"){
					$('.tabblock1').each(function(){
						if($(this).css('display')=="block"){
							$(this).slideUp();
							$('.toggle1').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});	
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
        <div class="clearboth"></div>
		<?php
        $row_refine_groups=$rfn->showRefineGroups();
		if(count($row_refine_groups))
		{
			foreach($row_refine_groups as $row_refine_group)
			{
				?>
                <div class="tab_1"><a href="JavaScript:void(0);" rel="cat_<?php echo $row_refine_group['refine_group_id']; ?>" class="toggle1"><?php echo $row_refine_group['refine_group_name']; ?></a></div>
                <div id="cat_<?php echo $row_refine_group['refine_group_id']; ?>" class="tabblock1" style="display:none;">
                    <ul id="mysorter" class="polaroid">
                        <?php
						$rgid=$row_refine_group['refine_group_id'];
						$row_products=$rfn->showRefineTags($rgid);
                        if(count($row_products))
                        {
                            foreach($row_products as $row_product)
                            {
								if($rfn->isRelated($product_id,$row_product['refine_tag_id'])!="checked")
								{
                   				
								?>
                                <li style="margin-top:15px; max-width: 218px;">
                                        <div class="polaroidlabel">
                                          <div class="tr">
                                              <div class="td">
                                                  <span class="refine_tag_sn"></span><input type="checkbox" name="refine_tag_id[<?php echo $row_product['refine_tag_id']; ?>][<?php echo $row_product['refine_tag_id']; ?>]"  /> <?php echo $row_product['refine_tag_name']; ?>
                                              </div>
                                          </div>        
                                      </div>
                                </li>
                                <?php
								}
                       
                            }
                        }
                        ?>
                    </ul>
                    <div class="clearboth"></div>
                </div>
                <?php
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
				url: 'ajax/refined_tags_save.php',
				type: 'post',
				data: $('#select_refined_by_tags').serialize(),
				success: function(data){
					$('.saving').hide();
					$.fancybox.close();	
				}
			})
		});
	});
	</script>
</div>