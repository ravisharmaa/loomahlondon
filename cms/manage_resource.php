<?php
if($_SESSION['nicolalawrence_admin']['admin_login']!=md5($_SESSION['nicolalawrence_admin']['admin_password'].session_id()))
{
	header("location:index.php");
	exit;
}
$resources_cat_id=$_REQUEST['id'];
$row_cat=$blg->showResourcesCategory($resources_cat_id);
?>
<h1><?php echo stripslashes($row_cat['resources_cat_name']); ?></h1>
<div class="goback" style="width:330px;">
<a href="login.php?p_id=manage_resources">Back to Resources</a>
</div>

<div class="clearboth"></div>
<div class="breadcrumb">
	<a href="login.php">Dashboard</a> &raquo;<a href="login.php?p_id=manage_resources"> Resources</a>

	
	 &raquo; <?php echo stripslashes($row_cat['resources_cat_name']); ?> 
</div>


<div class="info">
    	Please overwrite the title for the resources page that you wish to have.
    </div>
    <form id="form_page_content">
    <table border="0" class="myform">

    <tr>
   <td class="formleft" style="width:23%">Title</td>
        <td class="formright" colspan="2" width="100%"  >
      <input type="text" name="resources_cat_name"  style=" padding:5px; width:505px;" class="mytextbox" value="<?php echo stripslashes($row_cat['resources_cat_name']); ?>">
 
        	<input style="float:right;" type="button" value="Save" class="mybtn save_content" />
        	<div class="saving" style="float:right;">Saving...</div>
            <div class="saved" style="float:right;">Successfully Saved.</div>
        </td>
    </tr>
 

    </table>
    <input type="hidden" name="resources_cat_id" value="<?php echo $resources_cat_id; ?>" />
    </form>
    <script>
	$(function(){
		$('.save_content').click(function(){
			var t=$(this);
			t.hide();
			$('.saving').show();
			$.ajax({
				url: 'ajax/resources_cat_edit.php',
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
    

	<div class="info">
        Provided below are the resources that feature within the <?php echo strtolower(stripslashes($row_cat['resources_cat_name'])); ?> .
        <br /><br />
        Click the "Add a resource" button below if you wish to add a resource.
        <br /><br />
        Click on the image or pencil icon to edit its detail.
        <br /><br />
        In the unlikely event that you wish to delete a resource, click on the cross icon associated with it. You will be shown a warning alert should you wish to do this.
        <br /><br />
        If you wish to change the order in which resources are displayed, you can drag and drop a resourc to an alternative position.
    </div>
    <div class="myadd">
    	<a href="ajax/resource_add.php?id=<?php echo $resources_cat_id; ?>" class="resource_add_link fancybox.ajax">Add a resource</a>
    </div>
    <div class="clearboth"></div>
	<script>
	$(function(){
		$('.resource_add_link').fancybox();
	});
	</script>
    <div id="pro_block">
    	<div class="pleasewait">Please wait...</div>
		<script>
		$(function(){
			$.ajax({
				url: 'ajax/resource_show.php',
				type: 'post',
				data: { id: '<?php echo $resources_cat_id; ?>' },
				success: function(data){
					$('#pro_block').html(data);
				}
			});
		});
		</script>
	</div>

<?php /*?>
<div class="accordion"><a href="JavaScript:void(0);" rel="cat_seo" class="accordiontab" <?php if(isset($show_tab) and $show_tab=="cat_seo") echo "style='background: url(images/tgup.png) no-repeat right #E30B5D;'"; ?>>CLICK HERE TO EDIT SEO FOR THE <?php echo strtoupper(stripslashes($row_cat['resources_cat_name'])); ?> PAGE</a></div>
<div id="cat_seo" class="accordionblock" style="display:<?php echo (isset($show_tab) and $show_tab=="cat_seo")?"block":"none"; ?>;">
	<div class="info">
    	Please provide the SEO contents for the <?php echo strtolower(stripslashes($row_cat['resources_cat_name'])); ?> page that you wish to have.
    </div>
    <form id="form_page_seo">
    <table border="0" class="myform">
    <tr>
        <td class="formleft">Title tag</td>
        <td class="formright"><input type="text" name="cat_titletag" value="<?php echo stripslashes($row_cat['cat_titletag']); ?>" class="mytextbox" /></td>
    </tr>
    <tr>
        <td class="formleft">Meta keywords</td>
        <td class="formright"><textarea name="cat_metakeywords" class="mytextarea"><?php echo stripslashes($row_cat['cat_metakeywords']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">Meta description</td>
        <td class="formright"><textarea name="cat_metadescription" class="mytextarea"><?php echo stripslashes($row_cat['cat_metadescription']); ?></textarea></td>
    </tr>
    <tr>
        <td class="formleft">&nbsp;</td>
        <td class="formright" style="height:36px;">
        	<input type="button" value="Save" class="mybtn save_seo" />
        	<div class="saving">Saving...</div>
            <div class="saved">Successfully Saved.</div>
        </td>
    </tr>
    </table>
    <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
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
						$('.saved').show().delay(1000).hide(function(){
							t.show();	
						});	
					});
				}
			})
		});
	});
	</script>
</div><?php */?>