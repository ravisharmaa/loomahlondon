<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
//$content_id=3;
$show_tab="cat_list";
//$row_content=$cnt->getFeaturedPageContent($content_id);

$parent_cat_id=$_REQUEST['id'];
$row_content=$cat->showCategory($parent_cat_id);


?>
<h1  style="width:500px;"><?php echo stripslashes($row_content['cat_name']); ?></h1>
<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo;<?php echo stripslashes($row_content['cat_name']); ?> 
</div>
<?php
if($parent_cat_id!=3)
{
?>
<div class="info">
    	Please overwrite the title and paragraph for the <?php echo strtolower(stripslashes($row_content['cat_name'])); ?> page that you wish to have.
    </div>
    <form id="form_page_content">
    <table border="0" class="myform">
     <tr>
       <!-- <td class="formleft" style="width:50%">Title</td>-->
        <td class="formright" colspan="2" style="text-align:center;"><input style="text-transform:uppercase;width:98%; text-align:center; font-size: 19px; font-weight: 100;letter-spacing: 0.5px;" type="text" name="cat_banner_title" value="<?php echo stripslashes($row_content['cat_banner_title']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
    <!--<td class="formleft" style="width:23%">Description</td>-->
        <td class="formright" colspan="2" >
      <textarea type="text" name="cat_banner_desc" style="width:99%; min-height:75px;  margin-right:20px;  padding:15px 5px; color: #2a2a2a;font-size: 16px;font-weight: normal;text-rendering: optimizelegibility; text-align:left" class="mytextbox"><?php echo stripslashes($row_content['cat_banner_desc']); ?></textarea>
        </td>
    </tr>
    
    <tr>
        <td class="formleft" style="border-right:0">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input style="float:right;" type="button" value="Save" class="mybtn save_content" />
        	<div class="saving" style="float:right;">Saving...</div>
            <div class="saved" style="float:right;">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="cat_id" value="<?php echo $parent_cat_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_content').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/parent_content_save.php',
				type: 'post',
				data: $('#form_page_content').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').fadeIn(function(){
							$(this).fadeOut(2000,function(){
								t.show();	
							});
						});	
					});
					alertify.success('Successfully Saved.');
				}
			})
		});
	});
	</script>
 <?php
 }
 ?>   
        
    <div class="info">
        Provided below are the collections that feature within the <?php echo strtolower(stripslashes($row_content['cat_name'])); ?>  page.
        <br /><br />
        Click the "Add a collection" button below if you wish to add a collection.
        <br /><br />
        Click on the image or pencil icon to manage its constituent products.
        <br /><br />
        In the unlikely event that you wish to delete a collection, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which collections are displayed, you can drag and drop to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/category_add.php?id=<?php echo $parent_cat_id;?>"  class="cat_add_link fancybox.ajax">Add a collection</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.cat_add_link').fancybox();	
	});
	</script>
    <div id="cat_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/category_show.php?id=<?php echo $parent_cat_id;?>',
				type: 'post',
				data: {},
				success: function(data){
					$('#cat_block').html(data);
				}
			});
		});
		</script>
	</div>
<div class="accordion"><a href="JavaScript:void(0);" rel="page_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="page_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE <?php echo strtoupper(stripslashes($row_content['cat_name'])); ?> PAGE</a></div>
<div id="page_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="page_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the <?php echo strtolower(stripslashes($row_content['cat_name'])); ?> page that you wish to have.
    </div>

    <form id="form_page_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="cat_titletag" value="<?php echo stripslashes($row_content['cat_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="cat_metakeywords" class="mytextarea"><?php echo stripslashes($row_content['cat_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="cat_metadescription" class="mytextarea"><?php echo stripslashes($row_content['cat_metadescription']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright">
        	<input type="button" value="Save" class="mybtn save_seo" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="cat_id" value="<?php echo $parent_cat_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_seo').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/cat_seo_save.php',
				type: 'post',
				data: $('#form_page_seo').serialize(),
				success: function(){
					$('.saving').fadeOut(function(){
						$('.saved').show().delay(1000).fadeOut(function(){
							t.show();	
						});	
					});
					alertify.success('Successfully Saved.');
				}
			})
		});
	});
	</script>
</div>