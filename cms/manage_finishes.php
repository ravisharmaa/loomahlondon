<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
} 
if(isset($_POST['submitted']) and $_POST['submitted']=="Save")
{
	$cnt->updateContent();
	$show_tab=1;
}
$content_id=5;
$content=$cnt->getPageContent($content_id);
$content_seo=$cnt->getPageSEO($content_id);
?>
<h2>Finishes</h2>
<div class="clearboth"></div>
<div class="breadcrumb">You are here: <a href="login.php">Dashboard</a> &raquo; Finishes</div>
<style>
.tab_1{
	margin: 10px 0 0 0;
}
.toggle3{
	display: block;
	background: url(images/tgdown.png) no-repeat right #747d7d ;
	padding: 10px 20px;
	font: bold 16px Arial, Helvetica, sans-serif;
	color: #FFF;
	text-decoration: none;
}
.toggle3:hover{
	background: url(images/tgup.png) no-repeat right #E30B5D !important;
}
</style> 
<script>
$(function(){
	$('a.toggle3').click(function(){
		var t=$(this);
		var id=$(this).prop('rel');
		if($('#'+id).css('display')=="none"){
			$('.tabblock3').each(function(){
				if($(this).css('display')=="block"){
					$(this).slideUp();
					$('.toggle3').css({'background':'url(images/tgdown.png) no-repeat right #747d7d '});	
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
	if(isset($show_tab) and $show_tab==1)
	{
		?>
        <div class="ok">Provided information has been successfully updated for the finishes page.</div>
        <?php
	}
	
	?>
<?php /*?><div class="tab_1"><a href="JavaScript:void(0);" rel="finishes_content" class="toggle3">CLICK HERE TO MANAGE THE HEAD PARAGRAPH AND SEO FOR THE FINISHES PAGE</a></div>
<div id="finishes_content" class="tabblock3" style="display:none;">
	
   <div class="info">Provide the head paragraph and SEO that you wish to have.</div>
   
    <form action="" method="post" enctype="multipart/form-data">
    <table border="0" class="myform">
    <tr>
        <td colspan="2" class="formright"><b>Title and Head Paragraph</b></td>
    </tr>
    <tr>
        <td class="formleft">Title</td>
        <td class="formright"><input type="text" name="content_title" class="mytextbox" value="<?php echo stripslashes($content['content_title']); ?>" /></td>
    </tr>
    <tr>
        <td class="formleft">Paragraph</td>
        <td class="formright"><textarea name="content_desc" rows="4" class="myeditor"><?php echo stripslashes($content['content_desc']); ?></textarea>
        <b>Provided text appears as the paragraph on the top of the page.</b>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="formright"><b>Search engine optimisation</b></td>
    </tr>
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="content_titletag" class="mytextbox" value="<?php echo stripslashes($content_seo['content_titletag']); ?>" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="content_metakeywords" class="mytextarea"><?php echo stripslashes($content_seo['content_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="content_metadescription" class="mytextarea"><?php echo stripslashes($content_seo['content_metadescription']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright"><input type="submit" name="submitted" value="Save" class="mybtn" /></td>
    </tr>
    </table>
    <input type="hidden" name="content_id" id="content_id" value="<?php echo stripslashes($content['content_id']); ?>" />
    <input type="hidden" name="parent_id" id="parent_id" value="<?php echo stripslashes($content['parent_id']); ?>" />
    </form>
</div><?php */?>

<div class="tab_1"><a href="JavaScript:void(0);" rel="furniture_specific_groups" class="toggle3">CLICK HERE TO MANAGE FINISHES SPECIFIC GROUPS</a></div>
<div id="furniture_specific_groups" class="tabblock3" style="display:none;" >
	<style>
	.clearboth{
		clear: both;	
	}
	
	</style>
    
    <div>
	<div class="info">
        Provided below is the list of specific groups within finishes.
        <br /><br />Click the "Add new specific group" button below if you wish to add a finishes specific group.
        <br /><br />Click on the image or pencil icon of a finishes specific group to manage its constituent finishes.
        <br /><br />In the unlikely event that you wish to delete a finishes specific group, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />If you wish to change the order in which finishes specific groups are displayed, you can drag and drop a finishes specific group to an alternative position.
        
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
    <div class="myadd">
    <a href="ajax/finish_specific_group_add.php" class="add_new_group fancybox.ajax">Add new specific group</a>
    </div>
    <div class="clearboth"></div>
    <div id="finish_specific_group_block" style="border:#CCC 1px solid; padding:10px 15px 20px 15px; margin-top:5px;">
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
    
    <div class="clearboth"></div>
</div>


<?php /*?><div class="tab_1"><a href="JavaScript:void(0);" rel="finishes_categories" class="toggle3">CLICK HERE TO MANAGE FINISHES</a></div><?php */?>
<div id="finishes_categories"   >
	<style>
	.clearboth{
		clear: both;	
	}
	
	</style>
    
    <div>
    <div class="info">
        Provided below is the list of categories within finishes.
        <br /><br />Click the "Add new category" button below if you wish to add a content.
        <br /><br />Click on the image or pencil icon of a content to manage its constituent finishes.
        <br /><br />In the unlikely event that you wish to delete a content, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />If you wish to change the order in which categories are displayed, you can drag and drop a content to an alternative position.
        <br /><br />Please note that the images shown below which represent a content are taken from product in sequence (within the content).
    </div>
    <div class="myadd">
    <a href="login.php?p_id=manage_finishes_category&act=add">Add new category</a>
    </div>
    <div class="clearboth"></div>
   	<?php
      $row_cats=$finishes->getFinishesCategory();
    ?>
	<div id="product_img_block" style="margin-top:5px" >
		<ul id='mysorter'>
        	<?php
			$sn=0;
            foreach($row_cats as $row_cat)
            {
				$cat_id=$row_cat['finishes_cat_id'];
				$row_product=$finishes->getFirstProduct($cat_id);
            	?>
            	<li id="recordsArray_<?php echo $row_cat['finishes_cat_id']; ?>" style="margin:0;">
                	<div class="mybb">
                    	<div style="border:#DDD 1px solid;background:#EEE;padding:10px 10px 5px 10px;margin: 10px 5px 0 5px;">
                        	<a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $row_cat['finishes_cat_id']; ?>" title="Manage Products"><img src="<?php echo SITE_URL.FINISHES_IMG_MD.$row_product['main_image_md']; ?>" width="200"  border="0" /></a>
                          	<p style="line-height:30px;height:30px;color:#333;"><b><span class="sn"><?php echo ++$sn; ?></span>. <?php echo stripslashes($row_cat['finishes_cat_name']); ?></b></p>
                      	</div>
                      	<div class="mybb-btns">
                        	<a href="login.php?p_id=manage_finishes_products&cat_id=<?php echo $row_cat['finishes_cat_id']; ?>" title="Edit"><img src="images/icon_edit.png" width="26" height="26" border="0" /></a><a href="JavaScript:void(0);" rel="<?php echo $row_cat['finishes_cat_id']; ?>" class="delete_item"><img src="images/icon_delete.png" width="26" height="26" border="0" /></a>
                   		</div>
                   	</div>
              	</li>	
            	<?php
            }
        	?>
		</ul>
		<div class="clearboth"></div>
	</div>
    <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
    <script>
    $(function(){
        $("#mysorter").sortable({ opacity: 0.6, cursor: 'move', update: function() {
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
            $.post("ajax/finishes_categories_sort.php", order, function(theResponse){
				  //$("#sorted_msg").html(theResponse).fadeIn('slow').delay(3000).fadeOut('slow');
				  var sn=0;
				  $('.sn').each(function(){
					  $(this).html(++sn);
				  });
            }); 															 
        }								  
        });
		$('.delete_item').click(function(){
		if(confirm('Are you sure that you wish to remove this finishes category?')){
			var t=$(this);
			$.ajax({
				url: 'ajax/finishes_category_remove.php',
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
</div>
    
    <div class="clearboth"></div>
</div>
